@extends('layouts.app')

<<<<<<< HEAD
    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI',sans-serif;
        }

        body{
            background:#eef2f7;
            padding:40px;
        }

        .container{
            max-width:800px;
            margin:auto;
            background:white;
            border-radius:25px;
            padding:40px;
            box-shadow:0 15px 35px rgba(0,0,0,0.1);
        }

        h1{
            font-size:45px;
            color:#183153;
            margin-bottom:30px;
            font-weight:800;
        }

        label{
            display:block;
            margin-bottom:8px;
            color:#334155;
            font-weight:600;
        }

        input{
            width:100%;
            padding:15px;
            border:1px solid #d1d5db;
            border-radius:12px;
            margin-bottom:20px;
            font-size:16px;
        }

        input:focus{
            outline:none;
            border-color:#3465e1;
        }

        .btn{
            width:100%;
            border:none;
            background:#f59e0b;
            color:white;
            padding:16px;
            border-radius:12px;
            font-size:18px;
            font-weight:bold;
            cursor:pointer;
        }

        .btn:hover{
            background:#d97706;
        }

        .back{
            display:block;
            text-align:center;
            margin-top:15px;
            text-decoration:none;
            background:#4b5c77;
            color:white;
            padding:16px;
            border-radius:12px;
            font-weight:bold;
        }

    </style>

</head>
<body>

<div class="container">

    <h1>✏️ Edit Supplier</h1>

    <form action="/supplier/{{ $supplier->id }}"
          method="POST">
=======
@section('content')
>>>>>>> b98995d7adb5bb52dd11f4b3ee3f096fd2cc364e

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-warning">
            <h3>✏ Edit Supplier</h3>
        </div>
        <div class="card-body">
        <form action="{{ route('supplier.update',$supplier->id) }}"method="POST">
        @csrf
        @method('PUT')
<<<<<<< HEAD

        <label>Nama Supplier</label>
        <input type="text"
               name="nama_supplier"
               value="{{ $supplier->nama_supplier }}"
               required>

        <label>No HP Supplier</label>
        <input type="text"
               name="no_hp"
               value="{{ $supplier->no_hp }}"
               required>

        <label>Alamat Perusahaan</label>
        <input type="text"
               name="alamat"
               value="{{ $supplier->alamat }}"
               required>

        <label>Jenis Barang</label>
        <input type="text"
               name="kota"
               value="{{ $supplier->kota }}"
               required>

        <button type="submit" class="btn">
            Update Data Supplier
        </button>

    </form>

    <a href="/supplier" class="back">
        ← Kembali ke Data Supplier
    </a>

=======
        <div class="mb-3">
            <label class="form-label">Nama Supplier</label>
            <input type="text" name="nama_supplier" class="form-control" value="{{ $supplier->nama_supplier }}"required>
        </div>
        <div class="mb-3">
            <label class="form-label">No HP</label>
            <input type="text" name="no_hp" class="form-control" value="{{ $supplier->no_hp }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label"> Alamat </label>
            <textarea name="alamat" rows="4" class="form-control">{{ $supplier->alamat }}</textarea>
        </div>
        <button class="btn btn-warning">💾 Update</button>
        <a href="{{ route('supplier.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
        </div>
    </div>
>>>>>>> b98995d7adb5bb52dd11f4b3ee3f096fd2cc364e
</div>

@endsection