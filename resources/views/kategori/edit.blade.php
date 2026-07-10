@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-warning text-dark">
            <h3>Edit Kategori</h3>
        </div>
        <div class="card-body">
        <form action="{{ route('kategori.update',$kategori->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nama Kategori</label>
            <input type="text" name="nama_kategori" class="form-control" value="{{ $kategori->nama_kategori }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4">{{ $kategori->deskripsi }}</textarea>
        </div>
        <button class="btn btn-warning">💾 Update</button>
        <a href="{{ route('kategori.index') }}"class="btn btn-secondary">Kembali</a>
        </form>
        </div>
    </div>
</div>

@endsection