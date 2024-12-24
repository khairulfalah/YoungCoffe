<div class="container">
    <div class="row mt-4 mb-2">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-dark">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">History</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif
        </div>
    </div>

    <div class="row mt-4">
        <div class="col">
            <div class="table-responsive">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <td>No.</td>
                            <td>Tanggal Pesan</td>
                            <td>Kode Pemesanan</td>
                            <td>Pesanan</td>
                            <td>Status</td>
                            <td><strong>Total Harga</strong></td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        @forelse ($orders as $order)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>{{ $order->kode_pemesanan }}</td>
                            <td>
                                <?php $detail_orders = \App\DetailOrder::where('pesanan_id', $order->id)->get(); ?>
                                @foreach ($detail_orders as $detail_order)
                                <img src="{{ url('assets/kopi') }}/{{ $detail_order->product->gambar }}"
                                    class="img-fluid" width="50">
                                {{ $detail_order->product->nama }}
                                <br>
                                @endforeach
                            </td>
                            <td>
                                @if($order->status == 1)
                                Lunas
                                @else
                                Belum Lunas
                                @endif
                            </td>
                            <td><strong>Rp. {{ number_format($order->total_harga) }}</strong></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">Data Kosong</td>
                        </tr>
                        @endforelse


                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-body">
                    <p align="center"><strong> Terima Kasih Telah Berbelanja Di Yong Coffe ,Enjoy Your Coffe </strong></p>
                </div>
            </div>
        </div>
    </div>
</div>