@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <h2 class="mb-4 fw-bold">
        Dashboard Admin
    </h2>

    <div class="row">
        <!-- Total Produk -->
        <div class="col-md-3 mb-3">
            <div class="card shadow border-0 bg-primary text-white">
                <div class="card-body">
                    <h5>Total Produk</h5>
                    <h2>{{ $totalProduk }}</h2>

                    <a href="{{ route('produk.index') }}"
                        class="btn btn-light btn-sm mt-3">
                        Lihat Produk
                    </a>
                </div>
            </div>
        </div>
        <!-- Data Stok -->
        <div class="col-md-3 mb-3">
            <div class="card shadow border-0 bg-success text-white">
                <div class="card-body">
                    <h5>Data Stok</h5>
                    <h2>{{ $totalStok }}</h2>
                    <a href="{{ route('stok.index') }}"
                        class="btn btn-light btn-sm mt-3">
                        Lihat Stok
                    </a>
                </div>
            </div>
        </div>
        <!-- Total Pesanan -->
        <div class="col-md-3 mb-3">
            <div class="card shadow border-0 bg-warning text-dark">
                <div class="card-body">
                    <h5>Total Pesanan</h5>
                    <h2>{{ $totalPesanan }}</h2>

                    <a href="{{ route('pesanan.index') }}"
                        class="btn btn-dark btn-sm mt-3">
                        Lihat Pesanan
                    </a>
                </div>
            </div>
        </div>
        <!-- Pendapatan -->
        <div class="col-md-3 mb-3">
            <div class="card shadow border-0 bg-danger text-white">
                <div class="card-body">
                    <h5>Total Pendapatan</h5>

                    <h3>
                        Rp {{ number_format($totalPendapatan,0,',','.') }}
                    </h3>

                    <a href="{{ route('pendapatan.index') }}"
                        class="btn btn-light btn-sm mt-3">
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
                <div class="card-header">
                    <b>Grafik Penjualan</b>
                </div>
                <div class="card-body">
                    <canvas id="grafikPenjualan" height="120"></canvas>
                </div>
            </div>
        </div>

        <!-- Notifikasi -->
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header">
                    <b>Notifikasi</b>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            🔔 Pesanan Baru
                        </li>
                        <li class="list-group-item">
                            ✅ Transaksi Berhasil
                        </li>
                        <li class="list-group-item text-danger">
                            ⚠ Stok Menipis
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
                <div class="card-header">
                    <b>Produk Terlaris</b>
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
                <div class="card-header">
                    <b>Stok Menipis</b>
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