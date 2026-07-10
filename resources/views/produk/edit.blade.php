<!-- <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light"> -->

@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-warning text-dark">
            <h3 class="mb-0">✏️ Edit Produk</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('produk.update',$produk->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Nama Produk</label>
                    <input type="text"
                           name="nama_baju"
                           class="form-control"
                           value="{{ $produk->nama_baju }}">
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Ukuran</label>
                        <input type="text"
                               name="ukuran"
                               class="form-control"
                               value="{{ $produk->ukuran }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Harga</label>
                        <input type="number"
                               name="harga"
                               class="form-control"
                               value="{{ $produk->harga }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number"
                               name="stok"
                               class="form-control"
                               value="{{ $produk->stok }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori_id" class="form-select">
                            @foreach($kategori as $item)
                                <option value="{{ $item->id }}"
                                    {{ $produk->kategori_id == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Foto Produk</label>
                    <input type="file"
                           name="upload_foto"
                           class="form-control">
                </div>
                @if($produk->upload_foto)
                    <div class="mb-3">
                        <img src="{{ asset('storage/'.$produk->upload_foto) }}"
                             width="150"
                             class="img-thumbnail">
                    </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">
                        Deskripsi Produk
                    </label>

                    <textarea
                        name="deskripsi"
                        id="deskripsi"
                        rows="4"
                        class="form-control">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                </div>
                @endif
                <button class="btn btn-warning">
                    💾 Update Produk
                </button>
                <a href="{{ route('produk.index') }}"
                   class="btn btn-secondary">
                    ← Kembali
                </a>
            </form>
        </div>
    </div>
</div>
<!-- </body>
</html> -->
@endsection