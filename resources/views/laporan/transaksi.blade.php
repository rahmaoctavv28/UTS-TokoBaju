```blade
@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- Judul -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold">
                <i class="bi bi-cash-stack text-success"></i>
                Laporan Transaksi
            </h3>
            <p class="text-muted mb-0">
                Menampilkan seluruh transaksi Online dan Kasir.
            </p>
        </div>
    </div>

    <!-- Filter -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-success text-white">
            <b>Filter Transaksi</b>
        </div>

        <div class="card-body">

            <form action="{{ route('laporan.transaksi') }}" method="GET">

                <div class="row g-3">

                    <div class="col-md-2">
                        <label>Tanggal Awal</label>
                        <input type="date"
                               name="tanggal_awal"
                               value="{{ request('tanggal_awal') }}"
                               class="form-control">
                    </div>

                    <div class="col-md-2">
                        <label>Tanggal Akhir</label>
                        <input type="date"
                               name="tanggal_akhir"
                               value="{{ request('tanggal_akhir') }}"
                               class="form-control">
                    </div>

                    <div class="col-md-2">
                        <label>Jenis</label>

                        <select name="jenis"
                                class="form-select">

                            <option value="">Semua</option>

                            <option value="Online"
                                {{ request('jenis')=='Online' ? 'selected' : '' }}>
                                Online
                            </option>

                            <option value="Kasir"
                                {{ request('jenis')=='Kasir' ? 'selected' : '' }}>
                                Kasir
                            </option>

                        </select>

                    </div>

                    <div class="col-md-2">
                        <label>Metode</label>

                        <select name="metode"
                                class="form-select">

                            <option value="">Semua</option>

                            <option value="Cash"
                                {{ request('metode')=='Cash' ? 'selected' : '' }}>
                                Cash
                            </option>

                            <option value="Transfer"
                                {{ request('metode')=='Transfer' ? 'selected' : '' }}>
                                Transfer
                            </option>

                            <option value="QRIS"
                                {{ request('metode')=='QRIS' ? 'selected' : '' }}>
                                QRIS
                            </option>

                        </select>

                    </div>

                    <div class="col-md-2">
                        <label>Cari</label>

                        <input type="text"
                               name="keyword"
                               class="form-control"
                               placeholder="Kode Transaksi"
                               value="{{ request('keyword') }}">
                    </div>

                    <div class="col-md-2 d-flex align-items-end">

                        <button class="btn btn-success me-2">
                            <i class="bi bi-search"></i>
                            Filter
                        </button>

                        <a href="{{ route('laporan.transaksi') }}"
                           class="btn btn-secondary">

                            Reset

                        </a>

                    </div>

                </div>

            </form>

        </div>
    </div>

    <!-- Ringkasan -->
    <div class="row mb-4">

        <div class="col-md-3">

            <div class="card border-start border-5 border-primary shadow">

                <div class="card-body text-center">

                    <i class="bi bi-receipt fs-1 text-primary"></i>

                    <h6 class="mt-2">Total Transaksi</h6>

                    <h3>{{ $transaksi->total() }}</h3>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card border-start border-5 border-success shadow">

                <div class="card-body text-center">

                    <i class="bi bi-phone fs-1 text-success"></i>

                    <h6 class="mt-2">Online</h6>

                    <h3>
                        {{ $transaksi->where('jenis_transaksi','Online')->count() }}
                    </h3>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card border-start border-5 border-warning shadow">

                <div class="card-body text-center">

                    <i class="bi bi-shop fs-1 text-warning"></i>

                    <h6 class="mt-2">Kasir</h6>

                    <h3>
                        {{ $transaksi->where('jenis_transaksi','Kasir')->count() }}
                    </h3>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card border-start border-5 border-danger shadow">

                <div class="card-body text-center">

                    <i class="bi bi-cash-stack fs-1 text-danger"></i>

                    <h6 class="mt-2">Pendapatan</h6>

                    <h5>
                        Rp {{ number_format($transaksi->sum('total_bayar'),0,',','.') }}
                    </h5>

                </div>

            </div>

        </div>

    </div>

    <!-- Tabel -->
    <div class="card shadow border-0">

        <div class="card-header bg-dark text-white">

            <b>Daftar Transaksi</b>

        </div>

        <div class="card-body table-responsive">

            <table class="table table-bordered table-hover align-middle text-center">

                <thead class="table-success">

                    <tr>

                        <th>No</th>
                        <th>Kode</th>
                        <th>Jenis</th>
                        <th>Metode</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($transaksi as $item)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $item->kode_transaksi }}</td>

                        <td>

                            @if($item->jenis_transaksi=="Online")

                                <span class="badge bg-primary">

                                    Online

                                </span>

                            @else

                                <span class="badge bg-warning text-dark">

                                    Kasir

                                </span>

                            @endif

                        </td>

                        <td>{{ $item->metode_pembayaran }}</td>

                        <td>

                            Rp {{ number_format($item->total_bayar,0,',','.') }}

                        </td>

                        <td>

                            <span class="badge bg-success">

                                {{ $item->status }}

                            </span>

                        </td>

                        <td>

                            {{ $item->created_at->format('d-m-Y') }}

                        </td>

                        <td>

                            <a href="{{ route('laporan.show',$item->id) }}"
                               class="btn btn-info btn-sm">

                                <i class="bi bi-eye-fill"></i>

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="8">

                            Tidak ada data transaksi.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

            <div class="mt-3">

                {{ $transaksi->links() }}

            </div>

        </div>

    </div>

</div>

@endsection
