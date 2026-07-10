<!DOCTYPE html>
<html>
<head>
    <title>Data Stok Barang</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI',sans-serif;
        }

        body{
            min-height:100vh;
            background:#eef2f7;
            padding:40px;
        }

        .container{
            background:white;
            padding:30px;
            border-radius:25px;
            box-shadow:0 10px 25px rgba(0,0,0,0.15);
        }

        h1{
            text-align:center;
            color:#183153;
            margin-bottom:30px;
            font-size:40px;
        }

        .btn{
            text-decoration:none;
            color:white;
            padding:12px 20px;
            border-radius:12px;
            display:inline-block;
            margin-bottom:25px;
            font-weight:bold;
        }

        .tambah{
            background:#3465e1;
        }

        .home{
            background:#6b7280;
            float:right;
        }

        .alert{
            background:#d4edda;
            color:#155724;
            padding:15px;
            border-radius:12px;
            margin-bottom:20px;
            font-weight:bold;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th{
            background:#183153;
            color:white;
            padding:15px;
        }

        td{
            padding:15px;
            text-align:center;
            border-bottom:1px solid #e5e7eb;
        }

        tr:nth-child(even){
            background:#f8fafc;
        }

        .edit{
            background:#f59e0b;
            color:white;
            padding:10px 15px;
            border-radius:10px;
            text-decoration:none;
            font-weight:bold;
        }

        .hapus{
            background:#dc2626;
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

    <h1>📦 Data Stok Barang</h1>

    @if(session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    <a href="/stok/create"
       class="btn tambah">

       + Tambah Stok

    </a>

    <a href="/gudang"
       class="btn home">

       🏠 Dashboard

    </a>

    <table>

        <tr>
            <th>ID Produk</th>
            <th>Nama Produk</th>
            <th>Stok Awal</th>
            <th>Stok Masuk</th>
            <th>Stok Keluar</th>
            <th>Stok Akhir</th>
            <th>Tanggal Masuk</th>
            <th>Keterangan</th>
            <th>Edit</th>
            <th>Hapus</th>
        </tr>

        @foreach($stok as $s)

        <tr>

            <td>{{ $s->produk_id }}</td>

            <td>
                {{ $s->produk->nama_baju ?? '-' }}
            </td>

            <td>{{ $s->stok_awal }}</td>

            <td>{{ $s->stok_masuk }}</td>

            <td>{{ $s->stok_keluar }}</td>

            <td>{{ $s->stok_akhir }}</td>

            <td>
                {{ $s->created_at->format('d-m-Y') }}
            </td>

            <td>{{ $s->keterangan }}</td>

            <td>
                <a href="/stok/{{ $s->id }}/edit"
                   class="edit">

                    Edit

                </a>
            </td>

            <td>

                <form action="/stok/{{ $s->id }}"
                      method="POST">

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="hapus"
                        onclick="return confirm('Yakin ingin menghapus data ini?')">

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