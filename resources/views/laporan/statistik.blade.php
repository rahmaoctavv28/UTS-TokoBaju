@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <h3 class="fw-bold mb-4">
        <i class="bi bi-speedometer2"></i>
        Dashboard Statistik
    </h3>
    <div class="row g-4">
        <div class="col-md-3">
            <div class="card shadow border-start border-5 border-primary">
                <div class="card-body text-center">
                    <i class="bi bi-receipt fs-1 text-primary"></i>
                    <h6 class="mt-2">Total Transaksi</h6>
                    <h3>{{ $totalTransaksi }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow border-start border-5 border-success">
                <div class="card-body text-center">
                    <i class="bi bi-phone fs-1 text-success"></i>
                    <h6 class="mt-2">Online</h6>
                    <h3>{{ $totalOnline }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow border-start border-5 border-warning">
                <div class="card-body text-center">
                    <i class="bi bi-shop fs-1 text-warning"></i>
                    <h6 class="mt-2">Kasir</h6>
                    <h3>{{ $totalKasir }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow border-start border-5 border-danger">
                <div class="card-body text-center">
                    <i class="bi bi-box-seam fs-1 text-danger"></i>
                    <h6 class="mt-2">Stok Menipis</h6>
                    <h3>{{ $stokMenipis }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-4 mt-2">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    Pendapatan
                </div>
                <div class="card-body">
                    <h5>
                        Hari Ini
                    </h5>
                    <h3 class="text-success">
                        Rp {{ number_format($pendapatanHariIni,0,',','.') }}
                    </h3>
                    <hr>
                    <h5>
                        Bulan Ini
                    </h5>
                    <h3 class="text-primary">
                        Rp {{ number_format($pendapatanBulanIni,0,',','.') }}
                    </h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    Ringkasan Produk
                </div>
                <div class="card-body">
                    <h5>Total Produk Terjual</h5>
                    <h3>{{ $produkTerjual }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow mt-4">
        <div class="card-header bg-dark text-white">
            5 Produk Terlaris
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Total Terjual</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($produkTerlaris as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->total }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection