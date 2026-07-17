@extends('layouts.app')

@section('content')

<div class="container">

    <h3 class="mb-4">Laporan Pendapatan</h3>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Kode</th>
                <th>Oleh</th>
                <th>Total</th>
                <th>Metode</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>

        <tbody>
        @forelse($transaksi as $item)
            <tr>
                <td>{{ $item->kode_transaksi }}</td>
                <td>{{ $item->nama_kasir }}</td>
                <td>Rp {{ number_format($item->total_bayar,0,',','.') }}</td>
                <td>{{ $item->metode_pembayaran }}</td>
                <td>{{ $item->status }}</td>
                <td>{{ $item->created_at->format('d-m-Y') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">
                    Belum ada data transaksi.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{ $transaksi->links() }}

</div>

@endsection