@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <title>Laporan {{ ucfirst($jenis) }}</title>
    <style>
        body{
        font-family: DejaVu Sans;
        font-size:12px;
        }
        table{
        width:100%;
        border-collapse:collapse;
        margin-top:15px;
        }
        table th{
        background:#eeeeee;
        border:1px solid black;
        padding:8px;
        }
        table td{
        border:1px solid black;
        padding:6px;
        }
        .header{
        text-align:center;
        margin-bottom:20px;
        border-bottom:2px solid black;
        padding-bottom:15px;
        }
        .info{
        margin-top:20px;
        }
        .footer{
        margin-top:50px;
        text-align:right;
        }
        .total{
        margin-top:15px;
        font-size:14px;
        font-weight:bold;
        text-align:right;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>GEULIS SANDHANGAN</h2>
        <p>Jl. Soekarno Hatta No.123 Bandung</p>
        <p>Telp : 0812-3456-7890</p>
        <h3>LAPORAN {{ strtoupper($jenis) }}</h3>
    </div>
    <div class="info">
        <b>Periode :</b>
        {{ $tanggalAwal }}s/d {{ $tanggalAkhir }}
        <br>
        <b>Total Data :</b>
        {{ $totalData }}
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Tanggal</th>
                <th>Metode</th>
                <th>Status</th>
                <th>Total</th>
            </tr>
        </thead>
    <tbody>
        @forelse($data as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
            @if(isset($item->kode_transaksi))
            {{ $item->kode_transaksi }}
            @else
            INV{{ str_pad($item->id,6,'0',STR_PAD_LEFT) }}
            @endif
            </td>
            <td>{{ $item->created_at->format('d-m-Y') }}</td>
            <td>{{ $item->metode_pembayaran }}</td>
            <td>{{ $item->status }}</td>
            <td>Rp {{ number_format($item->total_bayar ?? $item->total_harga,0,',','.') }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="6">Tidak ada data.</td>
        </tr>
        @endforelse
        </tbody>
    </table>
    <div class="total">
        Grand Total :
        Rp {{ number_format($grandTotal,0,',','.') }}
    </div>
    <div class="footer">
        Bandung,
        {{ now()->format('d F Y') }}
        <br><br><br>
        _____________________
        <br>
        Admin Geulis Sandhangan
    </div>
</body>
</html>
@endsection