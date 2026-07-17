@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="mb-4">
        <h2 class="fw-bold">
            <i class="bi bi-bar-chart-fill text-primary"></i>
            Dashboard Laporan
        </h2>

        <p class="text-muted">
            Pilih menu laporan yang ingin Anda lihat.
        </p>
    </div>

    <div class="row g-4">

        <!-- Dashboard Statistik -->
        <div class="col-md-4">
            <a href="{{ route('laporan.statistik') }}"
                class="text-decoration-none">

                <div class="card shadow border-0 h-100 dashboard-card">

                    <div class="card-body text-center">

                        <i class="bi bi-speedometer2 display-3 text-primary"></i>

                        <h4 class="mt-3 fw-bold">
                            Dashboard Statistik
                        </h4>

                        <p class="text-muted">
                            Ringkasan transaksi, pendapatan, produk terlaris,
                            dan aktivitas toko.
                        </p>

                    </div>

                </div>

            </a>
        </div>

        <!-- Transaksi -->

        <div class="col-md-4">

            <a href="{{ route('laporan.transaksi') }}"
                class="text-decoration-none">

                <div class="card shadow border-0 h-100 dashboard-card">

                    <div class="card-body text-center">

                        <i class="bi bi-cash-stack display-3 text-success"></i>

                        <h4 class="mt-3 fw-bold">

                            Laporan Transaksi

                        </h4>

                        <p class="text-muted">

                            Seluruh transaksi Online dan Kasir.

                        </p>

                    </div>

                </div>

            </a>

        </div>

        <!-- Pesanan -->

        <div class="col-md-4">

            <a href="{{ route('laporan.pesanan') }}"
                class="text-decoration-none">

                <div class="card shadow border-0 h-100 dashboard-card">

                    <div class="card-body text-center">

                        <i class="bi bi-cart-check display-3 text-warning"></i>

                        <h4 class="mt-3 fw-bold">

                            Pesanan Online

                        </h4>

                        <p class="text-muted">

                            Semua pesanan pelanggan.

                        </p>

                    </div>

                </div>

            </a>

        </div>

        <!-- Pendapatan -->

        <div class="col-md-4">

            <a href="{{ route('laporan.pendapatan') }}"
                class="text-decoration-none">

                <div class="card shadow border-0 h-100 dashboard-card">

                    <div class="card-body text-center">

                        <i class="bi bi-wallet2 display-3 text-danger"></i>

                        <h4 class="mt-3 fw-bold">

                            Laporan Pendapatan

                        </h4>

                        <p class="text-muted">

                            Pendapatan harian, bulanan dan tahunan.

                        </p>

                    </div>

                </div>

            </a>

        </div>

        <!-- Grafik -->

        <div class="col-md-4">

            <a href="{{ route('laporan.grafik') }}"
                class="text-decoration-none">

                <div class="card shadow border-0 h-100 dashboard-card">

                    <div class="card-body text-center">

                        <i class="bi bi-graph-up-arrow display-3 text-info"></i>

                        <h4 class="mt-3 fw-bold">

                            Grafik Penjualan

                        </h4>

                        <p class="text-muted">

                            Grafik penjualan dan pendapatan.

                        </p>

                    </div>

                </div>

            </a>

        </div>

        <!-- Cetak -->

        <div class="col-md-4">

            <a href="{{ route('laporan.cetak') }}"
                class="text-decoration-none">

                <div class="card shadow border-0 h-100 dashboard-card">

                    <div class="card-body text-center">

                        <i class="bi bi-printer display-3 text-secondary"></i>

                        <h4 class="mt-3 fw-bold">

                            Cetak Laporan

                        </h4>

                        <p class="text-muted">

                            Cetak laporan transaksi dan pendapatan.

                        </p>

                    </div>

                </div>

            </a>

        </div>

    </div>

</div>

<style>

.dashboard-card{

    transition:.3s;

    border-radius:20px;

}

.dashboard-card:hover{

    transform:translateY(-8px);

    box-shadow:0 15px 30px rgba(0,0,0,.2);

}

.dashboard-card i{

    transition:.3s;

}

.dashboard-card:hover i{

    transform:scale(1.15);

}

</style>

@endsection