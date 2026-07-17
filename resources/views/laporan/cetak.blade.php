@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow border-0">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-printer-fill"></i>
                        Cetak Laporan
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('laporan.preview') }}"method="GET">
                        <div class="mb-4">
                            <label class="fw-bold">Jenis Laporan</label>
                            <select name="jenis" class="form-select">
                                <option value="transaksi">Laporan Transaksi</option>
                                <option value="pesanan">Laporan Pesanan Online</option>
                                <option value="pendapatan">Laporan Pendapatan</option>
                                <option value="produk">Produk Terlaris</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Tanggal Awal</label>
                                <input type="date" name="tanggal_awal" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label>Tanggal Akhir</label>
                                <input type="date" name="tanggal_akhir" class="form-control">
                            </div>
                        </div>
                        <hr>
                        <div class="text-end">
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-info me-2">
                                <i class="bi bi-eye"></i> Preview
                                </button>
                                </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection