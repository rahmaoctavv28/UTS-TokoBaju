@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3>Tambah Kategori</h3>
        </div>
        <div class="card-body">
        <form action="{{ route('kategori.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">
                Nama Kategori
            </label>
            <input type="text" name="nama_kategori" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">
                Deskripsi
            </label>
            <textarea name="deskripsi" class="form-control" rows="4"></textarea>
        </div>
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
        </form>

        </div>

</div>

</div>

@endsection