<?php

namespace App\Http\Livewire;

use App\DetailOrder;
use App\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Keranjang extends Component
{
    protected $listeners = [
        'keranjangClear' => 'updateKeranjang',
        'emptyKeranjang' => 'emptyKeranjangHandler'
    ];
    
    public $order;
    public $detail_orders = [];

    public function destroy($id)
    {
        $detail_order = DetailOrder::find($id);
        if (!empty($detail_order)) {
            $order = Order::where('id', $detail_order->pesanan_id)->first();
            $jumlah_pesanan_detail = DetailOrder::where('pesanan_id', $order->id)->count();
            if ($jumlah_pesanan_detail == 1) {
                $order->delete();
            } else {
                $order->total_harga -= $detail_order->total_harga; // Mengurangi total harga
                $order->update();
            }

            $detail_order->delete();
        }

        $this->emit('masukKeranjang');

        session()->flash('message', 'Pesanan Dihapus');
        $this->mount(); // Memuat ulang data keranjang
    }

    public function updateKeranjang()
    {
        $this->mount();
    }

    public function mount()
    {
        if (Auth::user()) {
            $this->order = Order::where('user_id', Auth::user()->id)->where('status', 0)->first();
            if ($this->order) {
                $this->detail_orders = DetailOrder::where('pesanan_id', $this->order->id)->get();
            }
        }
    }

    public function emptyKeranjangHandler()
    {
        if ($this->order) {
            // Menghapus detail pesanan tetapi tidak menghapus pesanan utama
            DetailOrder::where('pesanan_id', $this->order->id)->delete();
            $this->order->status = 1; // 1 = selesai
            $this->order->save();
            $this->order = null;
            $this->detail_orders = [];
        }
        
        session()->flash('message', 'Keranjang telah dikosongkan setelah pembayaran sukses.');
    }

    public function render()
    {
        return view('livewire.keranjang', [
            'order' => $this->order,
            'detail_orders' => $this->detail_orders
        ]);
    }
}
?>
