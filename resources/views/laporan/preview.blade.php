@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Preview Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{
            background:#f5f5f5;
            font-family:Arial, Helvetica, sans-serif;
        }

        .laporan{
            width:1000px;
            margin:30px auto;
            background:white;
            padding:40px;
            box-shadow:0 0 10px rgba(0,0,0,.15);
        }

        .header{
            border-bottom:2px solid #000;
            margin-bottom:25px;
            padding-bottom:15px;
        }

        .header h2{
            margin:0;
            font-weight:bold;
        }

        .header p{
            margin:0;
        }

        .judul{
            text-align:center;
            margin-top:20px;
            margin-bottom:25px;
        }

        table th{
            background:#343a40;
            color:white;
            text-align:center;
        }

        table td{
            text-align:center;
            vertical-align:middle;
        }

        .ttd{
            width:300px;
            float:right;
            text-align:center;
            margin-top:50px;
        }

        @media print{

            .no-print{
                display:none;
            }

            body{
                background:white;
            }

            .laporan{
                width:100%;
                margin:0;
                padding:20px;
                box-shadow:none;
            }
        }
    </style>
</head>
<body>
<div class="container mt-4 no-print">
    <button onclick="window.print()" class="btn btn-success">
        🖨 Print
    </button>
    <a href="{{ route('laporan.cetak') }}" class="btn btn-secondary">
        Kembali
    </a>
</div>
<div class="laporan">
    <div class="header">
        <div class="row">
            <div class="col-8">
                <h2>GEULIS SANDHANGAN</h2>
                <p>Jl. Soekarno Hatta, Bandung</p>
                <p>Telp. 0812-3456-7890</p>
            </div>
            <div class="col-4 text-end">
                <strong>Tanggal Cetak</strong><br>
                {{ now()->format('d M Y H:i') }}
            </div>
        </div>
    </div>
    <div class="judul">
        <h3>
            LAPORAN {{ strtoupper($jenis) }}
        </h3>
        <p>
            Periode :
            {{ $tanggalAwal }}
            s/d
            {{ $tanggalAkhir }}
        </p>
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Metode</th>
            <th>Status</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        @forelse($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->created_at->format('d-m-Y') }}</td>
                <td>{{ $item->nama_barang ?? '-' }}</td>
                <td>{{ $item->jumlah ?? '-' }}</td>
                <td>{{ $item->metode_pembayaran ?? '-' }}</td>
                <td>{{ $item->status ?? '-' }}</td>
                <td>
                    Rp {{ number_format($item->total_bayar ?? $item->total_harga ?? 0,0,',','.') }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7">
                    Tidak ada data pada periode ini.
                </td>
            </tr>
        @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="6" class="text-end">
                    Grand Total
                </th>
                <th>
                    Rp {{ number_format($data->sum(function($item){
                        return $item->total_bayar ?? $item->total_harga;
                    }),0,',','.') }}
                </th>
            </tr>
        </tfoot>
    </table>
    <div class="ttd">
        Bandung,
        {{ now()->translatedFormat('d F Y') }}
        <br><br><br><br>
        _______________________
        <br>
        <strong>Admin Geulis Sandhangan</strong>
    </div>
</div>
</body>
</html>


<script>

window.onload=function(){
    //
}

</script>
@endsection