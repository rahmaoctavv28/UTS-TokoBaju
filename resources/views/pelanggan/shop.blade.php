@extends('layouts.pelanggan')

@section('content')

<style>

.hero{

    background:linear-gradient(rgba(0,0,0,.25),rgba(0,0,0,.25)),
    url('{{ asset("images/banner.jpg") }}');

    background-size:cover;
    background-position:center;

    height:550px;

    display:flex;

    align-items:center;

}

.hero h1{

    font-size:60px;

    font-weight:bold;

    color:white;

}

.hero p{

    font-size:22px;

    color:white;

}

.btn-shop{

    background:#b88a44;

    color:white;

    border:none;

    padding:15px 40px;

    font-size:18px;

    border-radius:40px;

}

.btn-shop:hover{

    background:#9c7337;

    color:white;

}

.product-card{

    transition:.3s;

    border-radius:15px;

    overflow:hidden;

}

.product-card:hover{

    transform:translateY(-10px);

    box-shadow:0 15px 35px rgba(0,0,0,.15);

}

.product-image{

    height:300px;

    object-fit:cover;

}

.product-card h5{

    font-weight:600;

}

.product-card .btn{

    border-radius:30px;

}

html{
    scroll-behavior: smooth;
}

body{
    background:#f8f5ef;
    font-family:'Poppins',sans-serif;
    padding-top:80px;
}

#produk{
    scroll-margin-top:120px;
}

</style>

<div class="hero">
    <div class="container">
        <h1>THE CURATED <br> HOME & WARDROBE </h1>
        <p>Temukan koleksi fashion terbaik dengan kualitas premium.</p>
        <a href="#produk" class="btn btn-shop">Belanja Sekarang</a>
    </div>
</div>
<section id="produk" class="py-5">
<div class="container">
    <h2 class="text-center fw-bold mb-5">Produk Terbaru</h2>
    <div class="row">
        @foreach($produks as $produk)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card product-card h-100 shadow-sm border-0">
                @if($produk->upload_foto)
                <img src="{{ asset('storage/'.$produk->upload_foto) }}" class="card-img-top product-image">
                @else
                <img src="https://via.placeholder.com/400x450" class="card-img-top product-image">
                @endif
                <div class="card-body">
                    <small class="text-muted">
                        {{ $produk->kategori->nama_kategori ?? '-' }}
                    </small>
                    <h5 class="mt-2">{{ $produk->nama_baju }}</h5>
                    <h4 class="text-warning fw-bold">Rp {{ number_format($produk->harga,0,',','.') }}</h4>
                    <p class="text-secondary">Stok : {{ $produk->stokTerakhir->stok_akhir ?? 0 }}</p>
                    <div class="d-flex gap-2 mt-3">
                        <!-- Tombol Wishlist -->
                        <button type="button" class="btn btn-outline-danger rounded-pill px-3 wishlist-btn" data-id="{{ $produk->id }}">
                            <i class="fa-regular fa-heart"></i>
                        </button>
                        <!-- Tombol Detail -->
                        <a href="{{ route('pelanggan.detail',$produk->id) }}" class="btn btn-dark rounded-pill flex-grow-1">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
</section>
@endsection