<div class="container">
    <div class="row mt-4 mb-2">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-dark">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('keranjang') }}" class="text-dark">Keranjang</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Check Out</li>
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
            <a href="{{ route('keranjang') }}" class="btn btn-sm btn-dark"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col">
            <h4>Informasi Pembayaran</h4>
            <hr>
            <p>"Harap segera melakukan pembayaran untuk memastikan pesanan Anda diproses tepat waktu. Pastikan Alamat Dan Nomor Hp Kamu Benar *.< " Nominal Pesanan Kamu  : <strong>Rp. {{ number_format($total_harga) }}</strong></p>
        </div>
        <div class="col">
            <h4>Informasi Pengiriman</h4>
            <hr>
            <form wire:submit.prevent="checkout">
                <div class="form-group">
                    <label for="">No. HP</label>
                    <input id="nohp" type="text" class="form-control @error('nohp') is-invalid @enderror" wire:model="nohp" value="{{ old('nohp') }}" autocomplete="name" autofocus>
                    @error('nohp')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Alamat</label>
                    <textarea wire:model="alamat" class="form-control @error('nama') is-invalid @enderror"></textarea>
                    @error('alamat')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </form>
            <button wire:click="$emit('payment', '{{ $snapToken }}')" class="btn btn-success mt-2">Payment</button>
            <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
            <script>
                window.livewire.on('payment', function (snapToken) {
                    snap.pay(snapToken, {
                        onSuccess: function (result) {
                            window.livewire.emit('emptyKeranjang');
                        },
                        onPending: function (result) {
                            location.reload();
                        },
                        onError: function (result) {
                            location.reload();
                        }
                    });
                });

                window.livewire.on('redirectToHistory', function () {
                    window.location.href = "/history";
                });
            </script>
        </div>
    </div>
</div>
