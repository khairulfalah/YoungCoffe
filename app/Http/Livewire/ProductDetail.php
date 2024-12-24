<?php

namespace App\Http\Livewire;

use App\DetailOrder;
use App\Order;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductDetail extends Component
{
    public $product, $nama, $jumlah_pesanan, $quotes;

    public function mount($id)
    {
        $productDetail = Product::find($id);

        if ($productDetail) {
            $this->product = $productDetail;
        }
    }

    public function masukanKeranjang()
    {
        $this->validate([
            'jumlah_pesanan' => 'required'
        ]);

        //validasi jika belum login
        if (!Auth::user()) {
            return redirect()->route('login');
        }

        //Menghitung Total Harga
        $total_harga = $this->jumlah_pesanan * $this->product->harga;
        if (!empty($this->nama) && isset($this->product->harga_bucket)) {
            $total_harga += $this->product->harga_bucket;
        }

        //Menggecek apakah user punya data pesanan utama yang statusnya 0
        $order = Order::where('user_id', Auth::user()->id)->where('status', 0)->first();

        //Menyimpan / Update pesanan utama
        if (empty($order)) {
            $order = Order::create([
                'user_id' => Auth::user()->id,
                'total_harga' => $total_harga,
                'status' => 0,
                'kode_unik' => mt_rand(100, 999),
            ]);
            $order->kode_pemesanan = 'YC-' . $order->id;
            $order->update();
        } else {
            $order->total_harga += $total_harga;
            $order->update();
        }

        //Menyimpan pesanan Detail
        DetailOrder::create([
            'product_id' => $this->product->id,
            'pesanan_id' => $order->id,
            'jumlah_pesanan' => $this->jumlah_pesanan,
            'bucket' => $this->nama ? true : false,
            'nama' => $this->nama,
            'quotes' => $this->quotes, // Gunakan $this->quotes
            'total_harga' => $total_harga
        ]);

        $this->emit('masukKeranjang');

        session()->flash('message', 'Sukses Masuk Keranjang');

        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.product-detail');
    }
}
