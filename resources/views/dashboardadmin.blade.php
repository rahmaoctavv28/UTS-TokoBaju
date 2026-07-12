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
                    <ul class="list-group">
                        <li class="list-group-item">
                            <h3>🔔 Pesanan Baru</h3>
                        </li>
                        <li class="list-group-item">
                            <h3>✅ Transaksi Berhasil</h3>
                        </li>
                        <li class="list-group-item text-danger">
                            <h3>⚠ Stok Menipis</h3>
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
                    <b><h3>Produk Terlaris</h3></b>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Produk</th>
                            <th>Terjual</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($produkTerlaris as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_produk }}</td>
                                <td>{{ $item->total }}</td>
                            </tr>
                        @endforeach
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
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Stok</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($stokMenipis as $stok)
                            <tr>
                                <td>{{ $stok->nama_produk }}</td>
                                <td>
                                    <span class="badge bg-danger">
                                        {{ $stok->stok }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection