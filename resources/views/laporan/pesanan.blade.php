@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="fw-bold">
                <i class="bi bi-box-seam text-primary"></i>
                Laporan Pesanan Online
            </h3>

            <p class="text-muted mb-0">
                Menampilkan seluruh pesanan pelanggan secara online.
            </p>

        </div>

    </div>

    <!-- Filter -->
    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-primary text-white">

            <b>Filter Pesanan</b>

        </div>

        <div class="card-body">

            <form method="GET"
                  action="{{ route('laporan.pesanan') }}">

                <div class="row g-3">

                    <div class="col-md-3">

                        <label>Tanggal Awal</label>

                        <input type="date"
                               name="tanggal_awal"
                               class="form-control"
                               value="{{ request('tanggal_awal') }}">

                    </div>

                    <div class="col-md-3">

                        <label>Tanggal Akhir</label>

                        <input type="date"
                               name="tanggal_akhir"
                               class="form-control"
                               value="{{ request('tanggal_akhir') }}">

                    </div>

                    <div class="col-md-2">

                        <label>Status</label>

                        <select name="status"
                                class="form-select">

                            <option value="">Semua</option>

                            <option value="Menunggu Pembayaran"
                            {{ request('status')=='Menunggu Pembayaran' ? 'selected' : '' }}>
                                Menunggu Pembayaran
                            </option>

                            <option value="Diproses"
                            {{ request('status')=='Diproses' ? 'selected' : '' }}>
                                Diproses
                            </option>

                            <option value="Dikemas"
                            {{ request('status')=='Dikemas' ? 'selected' : '' }}>
                                Dikemas
                            </option>

                            <option value="Dikirim"
                            {{ request('status')=='Dikirim' ? 'selected' : '' }}>
                                Dikirim
                            </option>

                            <option value="Selesai"
                            {{ request('status')=='Selesai' ? 'selected' : '' }}>
                                Selesai
                            </option>

                        </select>

                    </div>

                    <div class="col-md-2">

                        <label>Cari</label>

                        <input type="text"
                               name="keyword"
                               class="form-control"
                               placeholder="Nama Penerima"
                               value="{{ request('keyword') }}">

                    </div>

                    <div class="col-md-2 d-flex align-items-end">

                        <button class="btn btn-primary me-2">

                            <i class="bi bi-search"></i>

                            Filter

                        </button>

                        <a href="{{ route('laporan.pesanan') }}"
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

        <div class="col-md-2">

            <div class="card shadow border-start border-5 border-dark">

                <div class="card-body text-center">

                    <h6>Total</h6>

                    <h3>{{ $totalPesanan }}</h3>

                </div>

            </div>

        </div>

        <div class="col-md-2">

            <div class="card shadow border-start border-5 border-secondary">

                <div class="card-body text-center">

                    <h6>Menunggu</h6>

                    <h3>{{ $menunggu }}</h3>

                </div>

            </div>

        </div>

        <div class="col-md-2">

            <div class="card shadow border-start border-5 border-warning">

                <div class="card-body text-center">

                    <h6>Diproses</h6>

                    <h3>{{ $diproses }}</h3>

                </div>

            </div>

        </div>

        <div class="col-md-2">

            <div class="card shadow border-start border-5 border-info">

                <div class="card-body text-center">

                    <h6>Dikirim</h6>

                    <h3>{{ $dikirim }}</h3>

                </div>

            </div>

        </div>

        <div class="col-md-2">

            <div class="card shadow border-start border-5 border-success">

                <div class="card-body text-center">

                    <h6>Selesai</h6>

                    <h3>{{ $selesai }}</h3>

                </div>

            </div>

        </div>

    </div>

    <!-- Tabel -->
    <div class="card shadow border-0">

        <div class="card-header bg-primary text-white">

            <b>Daftar Pesanan Online</b>

        </div>

        <div class="card-body table-responsive">

            <table class="table table-bordered table-hover align-middle text-center">

                <thead class="table-primary">

                    <tr>

                        <th>No</th>

                        <th>Invoice</th>

                        <th>Nama Penerima</th>

                        <th>Jumlah Produk</th>

                        <th>Total</th>

                        <th>Status</th>

                        <th>Tanggal</th>

                        <th>Aksi</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($pesanan as $item)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>

                            INV{{ str_pad($item->id,6,'0',STR_PAD_LEFT) }}

                        </td>

                        <td>{{ $item->nama_penerima }}</td>

                        <td>{{ $item->jumlah }}</td>

                        <td>

                            Rp {{ number_format($item->total_harga,0,',','.') }}

                        </td>

                        <td>

                            @switch($item->status)

                                @case('Menunggu Pembayaran')
                                    <span class="badge bg-secondary">
                                        {{ $item->status }}
                                    </span>
                                    @break

                                @case('Diproses')
                                    <span class="badge bg-warning text-dark">
                                        {{ $item->status }}
                                    </span>
                                    @break

                                @case('Dikemas')
                                    <span class="badge bg-primary">
                                        {{ $item->status }}
                                    </span>
                                    @break

                                @case('Dikirim')
                                    <span class="badge bg-info">
                                        {{ $item->status }}
                                    </span>
                                    @break

                                @case('Selesai')
                                    <span class="badge bg-success">
                                        {{ $item->status }}
                                    </span>
                                    @break

                                @default
                                    <span class="badge bg-dark">
                                        {{ $item->status }}
                                    </span>

                            @endswitch

                        </td>

                        <td>

                            {{ $item->created_at->format('d-m-Y') }}

                        </td>

                        <td>

                            <a href="{{ route('pesanan.show',$item->id) }}"
                               class="btn btn-info btn-sm">

                                <i class="bi bi-eye-fill"></i>

                            </a>

                            <a href="{{ route('pesanan.cetak',$item->id) }}"
                               class="btn btn-success btn-sm">

                                <i class="bi bi-printer-fill"></i>

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="8">

                            Tidak ada data pesanan.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

            <div class="mt-3">

                {{ $pesanan->links() }}

            </div>

        </div>

    </div>

</div>

@endsection