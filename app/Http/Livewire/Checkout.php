<?php

namespace App\Http\Livewire;

use App\Order;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class Checkout extends Component
{
    public $formCheckout;
    public $snapToken;
    public $total_harga, $nohp, $alamat;
    protected $listeners = [
        'emptyKeranjang' => 'emptyKeranjangHandler'
    ];

    public function mount()
    {
        $this->formCheckout = true;

        if (!Auth::user()) {
            return redirect()->route('login');
        }

        $this->nohp = Auth::user()->nohp;
        $this->alamat = Auth::user()->alamat;

        $order = Order::where('user_id', Auth::user()->id)->where('status', 0)->first();

        if (!empty($order)) {
            $this->total_harga = $order->total_harga;
        } else {
            return redirect()->route('home');
        }

        $this->generateSnapToken();
    }

    public function checkout()
    {
        $this->validate([
            'nohp' => 'required',
            'alamat' => 'required'
        ]);

        $user = User::where('id', Auth::user()->id)->first();
        $user->nohp = $this->nohp;
        $user->alamat = $this->alamat;
        $user->update();

        $this->generateSnapToken();
    }

    private function generateSnapToken()
    {
        $order = Order::where('user_id', Auth::user()->id)->where('status', 0)->first();

        // Generate a unique order_id using UUID
        $uniqueOrderId = $order->id . '-' . Str::uuid()->toString();

        $payload = [
            'transaction_details' => [
                'order_id' => $uniqueOrderId,
                'gross_amount' => $this->total_harga,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => $this->nohp,
                'shipping_address' => $this->alamat,
            ]
        ];

        \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');

        $this->snapToken = \Midtrans\Snap::getSnapToken($payload);
    }

    public function render()
    {
        return view('livewire.checkout', [
            'snapToken' => $this->snapToken,
        ]);
    }

    public function emptyKeranjangHandler()
    {
        // Mengubah status pesanan menjadi 'selesai'
        $orders = Order::where('user_id', Auth::user()->id)->where('status', 0)->get();
        foreach ($orders as $order) {
            $order->status = 1; // 1 = selesai
            $order->save();
        }
        
        $this->emit('keranjangClear');
        $this->emit('redirectToHistory');
    }
}
