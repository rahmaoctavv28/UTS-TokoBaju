@extends('layouts.pelanggan')

@section('content')

<!-- @if(session('success'))

<div class="alert alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif -->

<div class="container py-5">
    <h2 class="text-center fw-bold mb-5">Keranjang Belanja</h2>
    @if(count($cart))
        @php $total = 0; @endphp
        @foreach($cart as $item)
            @php
                $subtotal = $item['harga'] * $item['qty'];
                $total += $subtotal;
            @endphp
            <div class="card shadow-sm border-0 rounded-4 mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-2 text-center">
                            @if($item['gambar'])
                                <img src="{{ asset('storage/'.$item['gambar']) }}" class="img-fluid rounded" style="height:120px;object-fit:cover;">
                            @endif
                        </div>
                        <div class="col-md-4">
                            <h5 class="fw-bold">{{ $item['nama'] }}</h5>
                            <small class="text-muted">Harga Satuan</small>
                            <h6 class="text-warning">
                                Rp {{ number_format($item['harga'],0,',','.') }}
                            </h6>
                        </div>
                        <div class="col-md-2 text-center">
                           <div class="d-flex justify-content-center align-items-center">
                                <form action="{{ route('pelanggan.cart.decrease',$item['id']) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-outline-dark qty-btn">-</button>
                                </form>
                                <span class="mx-3 fw-bold fs-5">
                                    {{ $item['qty'] }}
                                </span>
                                <form action="{{ route('pelanggan.cart.increase',$item['id']) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-outline-dark qty-btn">+</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-3 text-end">
                            <h5 class="fw-bold">
                                Rp {{ number_format($subtotal,0,',','.') }}
                            </h5>
                        </div>
                        <div class="col-md-1 text-center">
                           <form action="{{ route('pelanggan.cart.remove',$item['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger rounded-circle" onclick="return confirm('Hapus produk dari keranjang?')">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="row mt-5">
            <div class="col-md-6">
                <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary btn-lg">
                    ← Kembali Belanja
                </a>
            </div>

            <div class="col-md-6 text-end">
                <h3>
                    Total :
                    <span class="text-success">
                        Rp {{ number_format($total,0,',','.') }}
                    </span>
                </h3>
                <a href="{{ route('pelanggan.checkout') }}" class="btn btn-success btn-lg mt-2">
                    Selesaikan Pesanan</a>
            </div>
        </div>
    @else
        <div class="alert alert-warning text-center">
            Keranjang masih kosong.
        </div>
    @endif
</div>

@endsection