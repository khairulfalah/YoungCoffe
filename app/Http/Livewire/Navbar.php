<?php

namespace App\Http\Livewire;

use App\Coffe;
use App\DetailOrder;
use App\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Navbar extends Component
{
    public $jumlah = 0;

    protected $listeners = [
        'masukKeranjang' => 'updateKeranjang'
    ];

    public function updateKeranjang()
    {
        if(Auth::user()) {
            $pesanan = Order::where('user_id', Auth::user()->id)->where('status', 0)->first();
            if ($pesanan) {
                $this->jumlah = DetailOrder::where('pesanan_id', $pesanan->id)->count();
            }else {
                $this->jumlah = 0;
            }
        }   
    }

    public function mount()
    {
        if(Auth::user()) {
            $pesanan = Order::where('user_id', Auth::user()->id)->where('status', 0)->first();
            if ($pesanan) {
                $this->jumlah = DetailOrder::where('pesanan_id', $pesanan->id)->count();
            }else {
                $this->jumlah = 0;
            }
        }
        
    }

    public function render()
    {
        return view('livewire.navbar', [
            'coffes' => Coffe::all(),
            'jumlah_pesanan' => $this->jumlah,
        ]);
    }
}
