<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>

    <!-- <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial;
        }

        body{
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background: linear-gradient(135deg,#ffe066,#ff6ec7,#6ea8ff);
        }

        .container{
            width:700px;
            background:white;
            padding:40px;
            border-radius:25px;
            box-shadow:0 10px 25px rgba(0,0,0,0.2);
        }

        h1{
            text-align:center;
            color:#ff1493;
            margin-bottom:30px;
        }

        input{
            width:100%;
            padding:15px;
            margin-bottom:20px;
            border:none;
            border-radius:15px;
            background:#f3f3f3;
        }

        button{
            width:100%;
            padding:15px;
            border:none;
            border-radius:15px;
            background:#ff1493;
            color:white;
            font-size:18px;
            font-weight:bold;
            cursor:pointer;
        }

        .home{
            display:block;
            text-align:center;
            margin-top:20px;
            background:#6ea8ff;
            color:white;
            padding:15px;
            border-radius:15px;
            text-decoration:none;
            font-weight:bold;
        }

    </style> -->

</head>
<body>
@extends('layouts.app')

@section('content')
<div class="container">

    <h1>➕ Tambah Produk</h1>

    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>Nama Baju</label>
        <input type="text" name="nama_baju" class="form-control">
    </div>

    <div class="mb-3">
        <label>Harga</label>
        <input type="number" name="harga" class="form-control">
    </div>

    <div class="mb-3">
        <label>Ukuran</label>
        <input type="text" name="ukuran" class="form-control">
    </div>

    <!-- <div class="mb-3">
        <label>Stok</label>
        <input type="number" name="stok" class="form-control">
    </div> -->

    <div class="mb-3">
        <label>Foto Produk</label>
        <input type="file" name="upload_foto" class="form-control">
    </div>

    <div class="mb-3">
    <label for="deskripsi" class="form-label">
        Deskripsi Produk
    </label>
    <textarea
        name="deskripsi"
        id="deskripsi"
        rows="4"
        class="form-control"
        placeholder="Masukkan deskripsi produk...">{{ old('deskripsi') }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Kategori</label>
        <select name="kategori_id" class="form-select" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach($kategori as $item)
                <option value="{{ $item->id }}">
                    {{ $item->nama_kategori }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">
        Simpan
    </button>
</form>
</div>
@endsection
</body>
</html>