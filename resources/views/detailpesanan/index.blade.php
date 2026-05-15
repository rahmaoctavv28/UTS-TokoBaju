<!DOCTYPE html>
<html>
<head>
    <title>Detail Pesanan</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial;
        }

        body{
            min-height:100vh;
            background: linear-gradient(135deg,#ffe066,#ff6ec7,#6ea8ff);
            padding:40px;
        }

        .container{
            background:white;
            padding:30px;
            border-radius:25px;
            box-shadow:0 10px 25px rgba(0,0,0,0.2);
        }

        h1{
            text-align:center;
            color:#ff1493;
            margin-bottom:30px;
            font-size:40px;
        }

        .btn{
            text-decoration:none;
            background:#ff1493;
            color:white;
            padding:12px 20px;
            border-radius:12px;
            display:inline-block;
            margin-bottom:25px;
            font-weight:bold;
        }

        .home{
            background:#6ea8ff;
            float:right;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th{
            background:#ff1493;
            color:white;
            padding:15px;
        }

        td{
            padding:15px;
            text-align:center;
            background:#fff5fa;
        }

        tr:nth-child(even) td{
            background:#f3f7ff;
        }

        .edit{
            background:orange;
            color:white;
            padding:10px 15px;
            border-radius:10px;
            text-decoration:none;
            font-weight:bold;
        }

        .hapus{
            background:red;
            color:white;
            border:none;
            padding:10px 15px;
            border-radius:10px;
            font-weight:bold;
            cursor:pointer;
        }

    </style>

</head>
<body>

<div class="container">

    <h1>📋 Detail Pesanan</h1>

    <a href="/detailpesanan/create"
       class="btn">

       + Tambah Data

    </a>

    <a href="/"
       class="btn home">

       🏠 Home

    </a>

    <table>

        <tr>
            <th>Pesanan</th>
            <th>Produk</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Subtotal</th>
            <th>Edit</th>
            <th>Hapus</th>
        </tr>

        @foreach($detailpesanan as $d)

        <tr>
            <td>{{ $d->pesanan_id }}</td>
            <td>{{ $d->produk_id }}</td>
            <td>{{ $d->jumlah }}</td>
            <td>{{ $d->harga_satuan }}</td>
            <td>{{ $d->subtotal }}</td>
            <td>
                <a href="/detailpesanan/{{ $d->id }}/edit" class="edit">Edit</a>
            </td>
            <td>
                <form action="/detailpesanan/{{ $d->id }}"
                      method="POST">

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="hapus" onclick="return confirm('Apakah yakin ingin menghapus data ini?')">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>

</body>
</html>