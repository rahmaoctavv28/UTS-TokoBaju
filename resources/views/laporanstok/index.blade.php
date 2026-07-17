<!DOCTYPE html>
<html>
<head>
    <title>Laporan Stok</title>

    <style>
        body{
            font-family:Arial,sans-serif;
            background:#f4f6f9;
            padding:30px;
        }

        h2{
            color:#183153;
            margin-bottom:20px;
        }

        .btn{
            display:inline-block;
            padding:10px 15px;
            background:#183153;
            color:white;
            text-decoration:none;
            border-radius:8px;
            margin-bottom:20px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            background:white;
        }

        th{
            background:#183153;
            color:white;
            padding:12px;
        }

        td{
            border:1px solid #ddd;
            padding:10px;
            text-align:center;
        }

        tr:nth-child(even){
            background:#f9f9f9;
        }
    </style>

</head>
<body>

<a href="/gudang" class="btn">
    ← Kembali Dashboard
</a>

<h2>Laporan Stok Barang</h2>

<table>

    <thead>
        <tr>
            <th>ID Produk</th>
            <th>Nama Produk</th>
            <th>Supplier</th>
            <th>Stok Awal</th>
            <th>Stok Masuk</th>
            <th>Stok Keluar</th>
            <th>Barang Rusak</th>
            <th>Stok Akhir</th>
            <th>Tanggal Masuk</th>
            <th>Keterangan</th>
        </tr>
    </thead>

    <tbody>

        @forelse($stok as $item)

        <tr>
            <td>{{ $item->produk_id }}</td>

            <td>
                {{ $item->produk->nama_baju ?? '-' }}
            </td>

            <td>
                {{ $item->supplier->nama_supplier ?? '-' }}
            </td>

            <td>{{ $item->stok_awal }}</td>

            <td>{{ $item->stok_masuk }}</td>

            <td>{{ $item->stok_keluar }}</td>

            <td>{{ $item->barang_rusak }}</td>

            <td>{{ $item->stok_akhir }}</td>

            <td>{{ $item->tanggal_masuk }}</td>

            <td>{{ $item->keterangan }}</td>
        </tr>

        @empty

        <tr>
            <td colspan="10">
                Belum ada data stok
            </td>
        </tr>

        @endforelse

    </tbody>

</table>

</body>
</html>