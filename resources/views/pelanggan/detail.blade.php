@extends('layouts.pelanggan')

@section('content')

<div class="container py-5">
    <div class="row">
        <div class="col-md-6">
            @if($produk->upload_foto)
                <img src="{{ asset('storage/'.$produk->upload_foto) }}" class="img-fluid rounded shadow">
            @else
                <img src="https://via.placeholder.com/600x700" class="img-fluid rounded shadow">
            @endif
        </div>
        <div class="col-md-6">
            <span class="badge bg-secondary">
                {{ $produk->kategori->nama_kategori }}
            </span>

            <h2 class="mt-3 fw-bold"> {{ $produk->nama_baju }}</h2>
            <h3 class="text-warning fw-bold">
                Rp {{ number_format($produk->harga,0,',','.') }}
            </h3>
            <hr>
            <p>
                <strong>Stok :</strong>
                {{ $produk->stokTerakhir->stok_akhir ?? 0 }}
            </p>
            @if(isset($produk->deskripsi))
                <p>{{ $produk->deskripsi }}</p>
            @endif
            <div class="row mt-4">
<!-- 
                <div class="col-md-4">
                    <label>Jumlah</label>
                    <input type="number" class="form-control" value="1" min="1" max="{{ $produk->stokTerakhir->stok_akhir ?? 1 }}">
                </div>
            </div> -->

            <form action="{{ route('pelanggan.cart.add', $produk->id) }}" method="POST">
                @csrf
                <div class="row mt-4">
                    <div class="col-md-4">
                        <label class="form-label">Jumlah</label>
                        <input type="number" name="qty" class="form-control" value="1" min="1" max="{{ $produk->stokTerakhir->stok_akhir ?? 1 }}" required>
                    </div>
                </div>
                <button class="btn btn-dark btn-lg mt-4">
                    <i class="fa-solid fa-cart-shopping"></i>
                    Tambah ke Keranjang
                </button>
            </form>
        </div>
    </div>
</div>

@endsection