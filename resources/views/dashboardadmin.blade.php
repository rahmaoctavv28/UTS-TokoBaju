@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <h2 class="mb-4 fw-bold">
        Dashboard Admin
    </h2>

    <div class="row">
        <!-- Total Produk -->
        <div class="col-md-3 mb-3">
            <div class="card shadow border-start border-5 border-primary text-black">
                <div class="card-body">
                    <h5>Total Produk</h5>
                    <h1>{{ $totalProduk }}</h1>

                    <a href="{{ route('produk.index') }}"
                        class="btn btn-outline-primary btn-sm mt-3">
                        Lihat Produk
                    </a>
                </div>
            </div>
        </div>
        <!-- Data Stok -->
        <div class="col-md-3 mb-3">
            <div class="card shadow border-start border-5 border-success text-black">
                <div class="card-body">
                    <h5>Data Stok</h5>
                    <h1>{{ $totalStok }}</h1>
                    <a href="{{ route('stok.admin') }}"
                        class="btn btn-outline-success btn-sm mt-3">
                        Lihat Stok
                    </a>
                </div>
            </div>
        </div>
        <!-- Total Pesanan -->
        <div class="col-md-3 mb-3">
            <div class="card shadow border-start border-5 border-warning text-black">
                <div class="card-body">
                    <h5>Total Pesanan</h5>
                    <h1>{{ $totalPesanan }}</h1>
                    <a href="{{ route('pesanan.index') }}"
                        class="btn btn-outline-warning btn-sm mt-3">
                        Lihat Pesanan
                    </a>
                </div>
            </div>
        </div>
        <!-- Pendapatan -->
        <div class="col-md-3 mb-3">
            <div class="card shadow border-start border-5 border-danger text-black">
                <div class="card-body">
                    <h5>Total Pendapatan</h5>
                    <h1>
                        Rp {{ number_format($totalPendapatan,0,',','.') }}
                    </h1>
                    <a href="{{ route('transaksi.index') }}"
                        class="btn btn-outline-warning btn-sm mt-3">
                        Detail
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <!-- Grafik -->
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header shadow border-start border-3 border-danger">
                    <b><h2>Grafik Penjualan</h2></b>
                </div>
                <div class="card-body">
                    <canvas id="grafikPenjualan" height="120"></canvas>
                </div>
            </div>
        </div>

        <!-- Notifikasi -->
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header shadow border-start border-3 border-warning">
                    <b><h2>Notifikasi</h2></b>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                🔔 <strong>Pesanan Baru</strong>
                            </span>
                            <span class="badge bg-primary rounded-pill">
                                {{ $jumlahPesanan }}
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                ✅ <strong>Transaksi Berhasil</strong>
                            </span>
                            <span class="badge bg-success rounded-pill">
                                {{ $jumlahTransaksi }}
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span class="text-danger">
                                ⚠ <strong>Stok Menipis</strong>
                            </span>
                            <span class="badge bg-danger rounded-pill">
                                {{ $jumlahStokMenipis }}
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <!-- Produk Terlaris -->
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header shadow border-start border-3 border-success">
                    <b><h3>P🏆 Produk Terlaris</h3></b>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Terjual</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($produkTerlaris as $item)
                            <tr>
                                <td>{{ $item->nama_baju }}</td>
                                <td>{{ $item->total_terjual }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center">
                                    Belum ada transaksi
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Stok Menipis -->
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header shadow border-start border-3 border-primary">
                    <b><h3>Stok Menipis</h3></b>
                </div>
                <div class="card-body">
                    @forelse($stokMenipis as $produk)
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <span>{{ $produk->nama_baju }}</span>
                            <span class="badge bg-danger">
                                {{ $produk->stok }}
                            </span>
                        </div>
                    @empty
                        <div class="text-center">
                            Semua stok aman
                        </div>
                    @endforelse
                       </div>
                        </div>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection