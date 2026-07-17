@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="fw-bold">
            <i class="bi bi-receipt"></i>
            Laporan Transaksi
        </h2>

    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row mb-4">
    <div class="col-md-3">
        <div class="card shadow border-4 border-primary">
            <div class="card-body">
                <small>Transaksi Online Hari Ini</small>
                <h2>{{ $onlineHariIni }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow border-4 border-success">
            <div class="card-body">
                <small>Transaksi Kasir Hari Ini</small>
                <h2>{{ $kasirHariIni }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow border-4 border-warning">
            <div class="card-body">
                <small>Total Hari Ini</small>
                <h2>{{ $totalHariIni }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow border-4 border-danger">
            <div class="card-body">
                <small>Pendapatan Hari Ini</small>
                <h4>
                    Rp {{ number_format($pendapatanHariIni,0,',','.') }}
                </h4>
            </div>
        </div>
    </div>
</div>
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <form method="GET">
            <div class="row">
                <div class="col-md-2">
                    <label>Jenis</label>
                    <select name="jenis" class="form-select">
                        <option value="">Semua</option>
                        <option value="Online" {{ request('jenis')=='Online'?'selected':'' }}>
                            Online
                        </option>
                        <option value="Kasir" {{ request('jenis')=='Kasir'?'selected':'' }}>
                            Kasir
                        </option>
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button class="btn btn-primary me-2"><i class="bi bi-search"></i>Filter</button>
                    <a href="{{ route('laporan.transaksi') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>
    </div>
</div>
    <div class="card shadow border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Kode Transaksi</th>
                            <th>Jenis</th>
                            <th>Total Bayar</th>
                            <th>Metode</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <!-- <th>Detail</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksi as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ $item->kode_transaksi }}
                            </td>
                            <td>
                                @if($item->jenis_transaksi=="Online")
                                    <span class="badge bg-primary">Online</span>
                                @else
                                    <span class="badge bg-success">Kasir</span>
                                @endif
                            </td>
                            <td>
                                Rp {{ number_format($item->total_bayar,0,',','.') }}
                            </td>
                            <td>
                                {{ $item->metode_pembayaran }}
                            </td>
                            <td>
                                @if($item->status=="Lunas")
                                    <span class="badge bg-success">Lunas</span>
                                @else
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @endif
                            </td>
                            <td>
                                {{ $item->created_at->format('d M Y') }}
                            </td>
                            <!-- <td>
                                @if($item->pesanan_id)
                                    <a href="{{ route('pesanan.show',$item->pesanan_id) }}" class="btn btn-info btn-sm">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td> -->
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9">
                                Belum ada transaksi.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection