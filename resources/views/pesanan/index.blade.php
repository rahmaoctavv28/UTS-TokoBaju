@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">
            <i class="bi bi-bag-check-fill"></i>Data Pesanan</h2>
    </div>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center">
                    <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Pelanggan</th>
                        <th>Jumlah Item</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th width="150">Detail</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($pesanan as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->created_at->format('d M Y') }}</td>
                        <td>{{ $item->pelanggan->nama_pelanggan ?? '-' }}</td>
                        <td>{{ $item->details->count() }} Produk</td>
                        <td>Rp {{ number_format($item->total_harga,0,',','.') }}</td>
                        <td>
                            @switch($item->status)
                                @case('Menunggu')
                                    <span class="badge bg-warning">Selesai</span>
                                @break
                                @case('Diproses')
                                    <span class="badge bg-info">Diproses </span>
                                @break
                                @case('Dikemas')
                                    <span class="badge bg-primary"> Dikemas</span>
                                @break
                                @case('Dikirim')
                                    <span class="badge bg-success">Dikirim</span>
                                @break
                                @default
                                    <span class="badge bg-dark">Menunggu</span>
                            @endswitch
                        </td>
                        <td>
                            <a href="{{ route('pesanan.show',$item->id) }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">Belum ada pesanan.</td>
                    </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection