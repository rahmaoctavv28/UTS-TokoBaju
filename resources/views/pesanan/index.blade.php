<!DOCTYPE html>
<html>
<head>
    <title>Data Pesanan - Geulis Sandhangan</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #ffe066, #ff6ec7, #6ea8ff);
            min-height: 100vh;
            padding: 40px;
        }

        .container{
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        h1{
            text-align: center;
            color: #ff1493;
            margin-bottom: 30px;
        }

        .top-action{
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .btn{
            background: #ff1493;
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            display: inline-block;
        }

        .btn:hover{
            background: #6ea8ff;
        }

        .home-btn{
            background: #6ea8ff;
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
        }

        .home-btn:hover{
            background: #ff1493;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th{
            background: #6ea8ff;
            color: white;
            padding: 12px;
        }

        table td{
            background: #fff5fa;
            padding: 12px;
            text-align: center;
        }

        form{
            display: inline;
        }

        button{
            background: #ff1493;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 10px;
            cursor: pointer;
        }

        button:hover{
            background: #6ea8ff;
        }

    </style>
</head>

<body>

<div class="container">

    <h1>🛒 Data Pesanan</h1>

    <div class="top-action">

        <a href="/pesanan/create" class="btn">
            + Tambah Pesanan
        </a>

        <a href="/" class="home-btn">
            🏠 Home
        </a>

    </div>

    <table border="1">

        <tr>
            <th>Admin</th>
            <th>Pelanggan</th>
            <th>Barang</th>
            <th>Jumlah</th>
            <th>Total Harga</th>
            <th>Edit</th>
            <th>Hapus</th>
        </tr>

        @foreach($data as $d)

        <tr>
            <td>{{ $d->admin->nama }}</td>
            <td>{{ $d->pelanggan->nama_pelanggan }}</td>
            <td>{{ $d->nama_barang }}</td>
            <td>{{ $d->jumlah }}</td>
            <td>
                Rp {{ number_format($d->total_harga) }}
            </td>
            <td>
                <a href="/pesanan/{{ $d->id }}/edit" class="btn">Edit</a>
            </td>
            <td>
                <form action="/pesanan/{{ $d->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="hapus-btn" onclick="return confirm('Apakah yakin ingin menghapus data ini?')">Hapus</button>

                </form>
            </td>

        </tr>

        @endforeach

    </table>

</div>

</body>
</html>