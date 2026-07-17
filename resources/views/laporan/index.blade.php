@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <h2 class="fw-bold mb-4">
        <i class="bi bi-clipboard-data"></i>
        Laporan Transaksi
    </h2>

    <a href="{{ route('laporan.rekap') }}" class="btn btn-success"><i class="bi bi-file-earmark-bar-graph"></i> Rekap Transaksi</a>
    {{-- CARD --}}
    <div class="row mb-4">

        <div class="col-md-3">
            <div class="card shadow border-4 border-primary">
                <div class="card-body text-center">
                    <h6>Online Hari Ini</h6>
                    <h2>{{ $online }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow border-4 border-success">
                <div class="card-body text-center">
                    <h6>Kasir Hari Ini</h6>
                    <h2>{{ $kasir }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow border-4 border-warning">
                <div class="card-body text-center">
                    <h6>Total Hari Ini</h6>
                    <h2>{{ $hariIni }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow border-4 border-danger">
                <div class="card-body text-center">
                    <h6>Pendapatan</h6>

                    <h4>

                        Rp {{ number_format($pendapatan,0,',','.') }}

                    </h4>

                </div>
            </div>
        </div>

    </div>

    {{-- FILTER --}}
    <div class="card shadow mb-4">

        <div class="card-body">

            <form method="GET">

                <div class="row">

                    <div class="col-md-3">

                        <label>Dari Tanggal</label>

                        <input type="date"
                               name="tanggal_awal"
                               class="form-control">

                    </div>

                    <div class="col-md-3">

                        <label>Sampai Tanggal</label>

                        <input type="date"
                               name="tanggal_akhir"
                               class="form-control">

                    </div>

                    <div class="col-md-2">

                        <label>Jenis</label>

                        <select name="jenis"
                                class="form-select">

                            <option value="">Semua</option>

                            <option value="Online">
                                Online
                            </option>

                            <option value="Kasir">
                                Kasir
                            </option>

                        </select>

                    </div>

                    <div class="col-md-4 d-flex align-items-end">

                        <button class="btn btn-primary">

                            <i class="bi bi-search"></i>

                            Filter

                        </button>

                        <a href="{{ route('laporan.index') }}"
                           class="btn btn-secondary ms-2">

                            Reset

                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>

    {{-- TABEL --}}
    <div class="card shadow">

        <div class="card-header">

            <b>Data Laporan Transaksi</b>

        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover align-middle text-center">

                <thead class="table-dark">

                    <tr>

                        <th>No</th>

                        <th>Kode</th>

                        <th>Jenis</th>

                        <th>Metode</th>

                        <th>Total</th>

                        <th>Status</th>

                        <th>Tanggal</th>

                        <th>Detail</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($laporan as $item)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $item->kode_transaksi }}</td>

                        <td>

                            @if($item->jenis_transaksi=="Online")

                                <span class="badge bg-primary">

                                    Online

                                </span>

                            @else

                                <span class="badge bg-success">

                                    Kasir

                                </span>

                            @endif

                        </td>

                        <td>

                            {{ $item->metode_pembayaran }}

                        </td>

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

                                <i class="bi bi-eye"></i>

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

        </div>

    </div>

</div>

@endsection