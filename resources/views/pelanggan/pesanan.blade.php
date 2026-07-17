@extends('layouts.pelanggan')

@section('content')

<div class="container py-5">
    <h2 class="mb-4">Pesanan Saya</h2>
    @forelse($pesanans as $pesanan)
    <div class="card shadow-sm mb-4 border-0 rounded-4">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div>
                <h5>Pesanan #{{ $pesanan->id }}</h5>
                <p class="text-muted">{{ $pesanan->created_at->format('d M Y H:i') }}</p>
                </div>
            <div>
            @if($pesanan->status=="Lunas")
            <span class="badge bg-success">Lunas</span>
            @else
            <span class="badge bg-warning text-dark">Menunggu Pembayaran</span>
            @endif
        </div>
        <div>
            @if($pesanan->status == 'Menunggu Konfirmasi')
                <span class="badge bg-secondary">
                    Menunggu Konfirmasi
                </span>
            @elseif($pesanan->status == 'Diproses')
                <span class="badge bg-warning text-dark">
                    Diproses
                </span>
            @elseif($pesanan->status == 'Dikirim')
                <span class="badge bg-primary">
                    Dikirim
                </span>
            @elseif($pesanan->status == 'Selesai')
                <span class="badge bg-success">
                    Selesai
                </span>
            @elseif($pesanan->status == 'Dibatalkan')
                <span class="badge bg-danger">
                    Dibatalkan
                </span>
            @else
                <span class="badge bg-secondary">
                    {{ $pesanan->status }}
                </span>
            @endif
            </div>
    </div>
    <hr>
    <h4>Rp {{ number_format($pesanan->total_harga,0,',','.') }}</h4>
    @if($pesanan->transaksi)
    <p>
    Metode :
    {{ $pesanan->transaksi->metode_pembayaran }}</p>
    <p>
    Kode :
    {{ $pesanan->transaksi->kode_transaksi }}</p>
    @endif

    <div class="text-end mt-3">
    <a href="{{ route('pelanggan.pesanan.detail',$pesanan->id) }}"
       class="btn btn-outline-primary">

        <i class="fa fa-eye"></i>
        Lihat Pesanan

    </a>
</div>
</div>
</div>
@empty
<div class="alert alert-info">Belum ada pesanan.</div>
    @endforelse
</div>
@endsection