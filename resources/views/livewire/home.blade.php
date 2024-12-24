<div class="container">
    {{-- BANNER --}}
    <div class="banner">
        <img src="{{ url('assets/slider/poster.png') }}" alt="">
    </div>

    {{-- PILIH NEGARA --}}
    <section class="pilih-negara mt-4">
        <h3><strong>Pilih Negara</strong></h3>
        <div class="row mt-4">
            @foreach($coffes as $coffe)
            <div class="col-md-3">
                <a href="{{ route('products.coffe', $coffe->id) }}">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <img src="{{ url('assets/negara') }}/{{ $coffe->gambar }}" class="img-fluid">
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </section>

    {{-- PILIH PRODUCT --}}
    <section class="product mt-5 mb-5">
        <h3>
            <strong>Best Products</strong>
            <a href="{{ route('products') }}" class="btn elegant-btn float-right"><i class="fas fa-eye"></i> Lihat Semua </a>
        </h3>
        <div class="row mt-4">
            @foreach($products as $product)
            <div class="col-md-3">
                <div class="card h-100">
                    <div class="card-body text-center d-flex flex-column">
                        <img src="{{ url('assets/kopi') }}/{{ $product->gambar }}" class="img-fluid mb-2">
                        <div class="mt-auto">
                            <h5><strong>{{ $product->nama }}</strong></h5>
                            <h5>Rp. {{ number_format($product->harga) }}</h5>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <a href="{{ route('products.detail', $product->id) }}" class="btn btn-dark btn-block"><i class="fas fa-eye"></i> Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>
