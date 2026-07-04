@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3>➕ Tambah Supplier</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('supplier.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Supplier</label>
                <input type="text" name="nama_supplier" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">No HP</label>
                <input type="text" name="no_hp" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" rows="4" class="form-control"></textarea>
            </div>
            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('supplier.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

@endsection