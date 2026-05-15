<!DOCTYPE html>
<html>
<head>
    <title>Data Pelanggan</title>

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
            cursor:pointer;
            font-weight:bold;
        }

    </style>

</head>
<body>

<div class="container">

    <h1>👥 Data Pelanggan</h1>

    <a href="/pelanggan/create"
       class="btn">

       + Tambah Pelanggan

    </a>

    <a href="/"
       class="btn home">

       🏠 Home

    </a>

    <table>

        <tr>
            <th>Nama Pelanggan</th>
            <th>Alamat</th>
            <th>No HP</th>
            <th>Edit</th>
            <th>Hapus</th>
        </tr>

        @foreach($pelanggan as $p)

        <tr>
            <td>{{ $p->nama_pelanggan }}</td>
            <td>{{ $p->alamat }}</td>
            <td>{{ $p->no_hp }}</td>
            <td>
                <a href="/pelanggan/{{ $p->id }}/edit" class="edit" >Edit</a
            </td>
            <td>
                <form action="/pelanggan/{{ $p->id }}"
                      method="POST">

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="hapus" onclick="return confirm('Apakah yakin ingin menghapus data ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>

</body>
</html>