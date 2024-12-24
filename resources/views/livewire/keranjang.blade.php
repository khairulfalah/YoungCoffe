<div class="container">
    <div class="row mt-4 mb-2">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-dark">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Keranjang</li>
                </ol>
              </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if(session()->has('message'))
            <div class="alert alert-danger">
                {{ session('message') }}
            </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <td>No.</td>
                            <td>Gambar</td>
                            <td>Keterangan</td>
                            <td>Bucket</td>
                            <td>Jumlah</td>
                            <td>Harga</td>
                            <td><strong>Total Harga</strong></td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                    @forelse ($detail_orders as $detail_order)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>
                            <img src="{{ url('assets/kopi') }}/{{ $detail_order->product->gambar }}" class="img-fluid" width="200">
                        </td>
                        <td>
                            {{ $detail_order->product->nama }}
                        </td>
                        <td>
                            @if($detail_order->bucket)
                                Nama : {{ $detail_order->nama }} <br>
                                Quotes : {{ $detail_order->quotes }}
                            @else 
                                - 
                            @endif
                        </td>
                        <td>{{ $detail_order->jumlah_pesanan }}</td>
                        <td>Rp. {{ number_format($detail_order->product->harga) }}</td>
                        <td><strong>Rp. {{ number_format($detail_order->total_harga) }}</strong></td>
                        <td>
                            <i wire:click="destroy({{ $detail_order->id }})" class="fas fa-trash text-danger"></i>
                        </td>
                    </tr>
                        @empty
                            <tr>
                                <td colspan="7">Data Kosong</td>
                            </tr>
                        @endforelse
                        
                        @if(!empty($order))
                        <tr>
                            <td colspan="6" align="right"><strong>Total Harga :</strong></td>
                            <td align="right"><strong>Rp. {{ number_format($order->total_harga) }}</strong></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="6" align="right"><strong>Kode Unik :</strong></td>
                            <td align="right"><strong> {{ number_format($order->kode_unik) }}</strong></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="6" align="right"><strong>Total Yang Harus Dibayar :</strong></td>
                            <td align="right"><strong>Rp. {{ number_format($order->total_harga) }}</strong></td>
                            <td></td>
                        </tr>
                        <td colspan="6"></td>
                        <td colspan="2">
                            <a href="{{ route('checkout') }}" class="btn btn-success btn-blok">
                                <i class="fas fa-arrow-right"></i> Check Out
                            </a>
                        </td>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
