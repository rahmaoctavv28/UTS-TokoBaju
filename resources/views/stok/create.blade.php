<!DOCTYPE html>
<html>
<head>
    <title>Tambah Barang Masuk</title>

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

        input,
        select{
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
            background:#3465e1;
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

    <h1>📦 Tambah Barang Masuk</h1>

    <form action="{{ url('/stok') }}" method="POST">

        @csrf

        <label>Nama Produk</label>

        <select name="produk_id" required>
            <option value="">-- Pilih Produk --</option>

            @foreach($produk as $p)
                <option value="{{ $p->id }}">
                    {{ $p->nama_baju }}
                </option>
            @endforeach

        </select>

        <label>Supplier</label>

        <select name="supplier_id" required>
            <option value="">-- Pilih Supplier --</option>

            @foreach($supplier as $s)
                <option value="{{ $s->id }}">
                    {{ $s->nama_supplier }}
                </option>
            @endforeach

        </select>

        <label>Stok Masuk</label>

        <input
            type="number"
            name="stok_masuk"
            min="1"
            required>

        <label>Barang Rusak</label>

        <input
            type="number"
            name="barang_rusak"
            value="0"
            min="0">
        
        <label>Tanggal Masuk</label>

        <input
            type="date"
            name="tanggal_masuk"
            required>

        <label>Keterangan</label>

        <input
            type="text"
            name="keterangan"
            placeholder="Masukkan keterangan">

        <button type="submit">
            Simpan Data
        </button>

    </form>

    <a href="{{ url('/stok') }}" class="back">
        ⬅ Kembali
    </a>

</div>

</body>
</html>