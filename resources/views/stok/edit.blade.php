<!DOCTYPE html>
<html>
<head>
    <title>Edit Stok Barang</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI',sans-serif;
        }

        body{
            background:#eef2f7;
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            padding:30px;
        }

        .card{
            width:800px;
            background:white;
            padding:40px;
            border-radius:25px;
            box-shadow:0 10px 30px rgba(0,0,0,0.1);
        }

        h1{
            text-align:center;
            margin-bottom:30px;
            color:#183153;
        }

        label{
            display:block;
            margin-bottom:8px;
            font-weight:bold;
            color:#444;
        }

        input,select{
            width:100%;
            padding:15px;
            border:1px solid #ddd;
            border-radius:12px;
            margin-bottom:20px;
            font-size:15px;
        }

        button{
            width:100%;
            padding:15px;
            border:none;
            border-radius:12px;
            background:#f59e0b;
            color:white;
            font-size:16px;
            font-weight:bold;
            cursor:pointer;
        }

        .back{
            display:block;
            text-align:center;
            text-decoration:none;
            margin-top:15px;
            padding:15px;
            border-radius:12px;
            background:#6b7280;
            color:white;
            font-weight:bold;
        }

    </style>
</head>
<body>

<div class="card">

    <h1>✏️ Edit Stok Barang</h1>

    <form action="/stok/{{ $stok->id }}" method="POST">

        @csrf
        @method('PUT')

        <label>Nama Produk</label>

        <select name="produk_id">

            @foreach($produk as $p)

                <option value="{{ $p->id }}"
                    {{ $stok->produk_id == $p->id ? 'selected' : '' }}>

                    {{ $p->nama_baju }}

                </option>

            @endforeach

        </select>

        <label>Stok Awal</label>
        <input type="number"
               name="stok_awal"
               value="{{ $stok->stok_awal }}">

        <label>Stok Masuk</label>
        <input type="number"
               name="stok_masuk"
               value="{{ $stok->stok_masuk }}">

        <label>Stok Keluar</label>
        <input type="number"
               name="stok_keluar"
               value="{{ $stok->stok_keluar }}">

        <label>Stok Akhir</label>
        <input type="number"
               name="stok_akhir"
               value="{{ $stok->stok_akhir }}">

        <label>Keterangan</label>
        <input type="text"
               name="keterangan"
               value="{{ $stok->keterangan }}">

        <button type="submit">
            Update Data
        </button>

    </form>

    <a href="/stok" class="back">
        ⬅ Kembali
    </a>

</div>

</body>
</html>