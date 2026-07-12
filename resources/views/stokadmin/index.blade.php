@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">
            <i class="bi bi-boxes"></i> Data Stok Barang
        </h2>
    </div>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>ID Produk</th>
                            <th>Nama Produk</th>
                            <th>Stok Awal</th>
                            <th>Stok Masuk</th>
                            <th>Stok Keluar</th>
                            <th>Stok Akhir</th>
                            <th>Tanggal Masuk</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($stok as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->produk_id }}</td>
                            <td>{{ $item->produk->nama_baju ?? '-' }}</td>
                            <td>{{ $item->stok_awal }}</td>
                            <td class="text-success fw-bold">
                                +{{ $item->stok_masuk }}
                            </td>
                            <td class="text-danger fw-bold">
                                -{{ $item->stok_keluar }}
                            </td>
                            <td>
                                @if($item->stok_akhir <= 10)
                                    <span class="badge bg-danger">
                                        {{ $item->stok_akhir }}
                                    </span>
                                @else
                                    <span class="badge bg-success">
                                        {{ $item->stok_akhir }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                {{ $item->created_at->format('d-m-Y') }}
                            </td>
                            <td>
                                {{ $item->keterangan }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9">
                                Belum ada data stok.
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