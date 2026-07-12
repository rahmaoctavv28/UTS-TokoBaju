@extends('layouts.pelanggan')

@section('content')

<div class="container py-5">
    <h2 class="fw-bold mb-4">Cari Produk</h2>
    <form method="GET" action="{{ route('pelanggan.search') }}">
        <div class="row">
            <div class="col-md-5">
                <input type="text" class="form-control" name="keyword" placeholder="Cari nama produk..." value="{{ request('keyword') }}">
            </div>
            <div class="col-md-4">
                <select class="form-select" name="kategori">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ request('kategori')==$kategori->id?'selected':'' }} > {{ $kategori->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <button class="btn btn-dark w-100">
                    Cari Produk
                </button>
            </div>
        </div>
    </form>
    <hr class="my-5">
    <div class="row">
        @forelse($produks as $produk)
            <div class="col-md-3 mb-4">
                <div class="card shadow border-0 h-100">
                    <img src="{{ asset('storage/'.$produk->upload_foto) }}" class="card-img-top" style="height:250px;object-fit:cover;">
                    <div class="card-body">
                        <h5>{{ $produk->nama_baju }}</h5>
                        <small>{{ $produk->kategori->nama_kategori }}</small>
                        <h5 class="text-success mt-2">Rp {{ number_format($produk->harga,0,',','.') }}</h5>
                        <a href="{{ route('pelanggan.detail',$produk->id) }}" class="btn btn-outline-dark w-100 mt-3">Lihat Produk</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    Produk tidak ditemukan.
                </div>
            </div>
        @endforelse
    </div>
</div>

@endsection