@extends('layouts.pelanggan')

@section('content')

<div class="container py-5">
    <h2 class="text-center fw-bold mb-4">
        Wishlist Saya
    </h2>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        @forelse($wishlists as $wishlist)
            @php
                $produk = $wishlist->produk;
            @endphp
            <div class="col-md-3 mb-4">
                <div class="card shadow border-0 h-100">
                    <img src="{{ asset('storage/'.$produk->upload_foto) }}" class="card-img-top" style="height:250px;object-fit:cover;">
                    <div class="card-body">
                        <h5>{{ $produk->nama_baju }}</h5>
                        <p class="text-success fw-bold">
                            Rp {{ number_format($produk->harga,0,',','.') }}
                        </p>
                        <a href="{{ route('pelanggan.detail',$produk->id) }}"class="btn btn-outline-dark w-100 mb-2">
                            Lihat Produk
                        </a>
                        <form action="{{ route('pelanggan.cart.add',$produk->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="qty" value="1">
                            <button class="btn btn-success w-100 mb-2">
                                Masukkan Keranjang
                            </button>
                        </form>
                        <form action="{{ route('pelanggan.wishlist.remove',$wishlist->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger w-100">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    Wishlist masih kosong.
                </div>
            </div>
        @endforelse
    </div>
</div>

@endsection