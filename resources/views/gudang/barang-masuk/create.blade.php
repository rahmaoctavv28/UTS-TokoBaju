@extends('admin.layout.main')   {{-- Sesuaikan dengan layout admin kamu jika berbeda --}}

@section('title', 'Input Barang Masuk')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Input Barang Masuk</h4>
                </div>
                <div class="card-body">

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('gudang.barang-masuk.store') }}" method="POST">
                        @csrf

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label>Nama Produk <span class="text-danger">*</span></label>
                                <select name="produk_id" class="form-control" required>
                                    <option value="">-- Pilih Produk --</option>
                                    @foreach($produks as $produk)
                                        <option value="{{ $produk->id }}">{{ $produk->nama_baju }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label>Supplier <span class="text-danger">*</span></label>
                                <select name="supplier_id" class="form-control" required>
                                    <option value="">-- Pilih Supplier --</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">
                                            {{ $supplier->nama_supplier ?? $supplier->name ?? 'Supplier' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label>Stok Masuk <span class="text-danger">*</span></label>
                                <input type="number" name="stok_masuk" class="form-control" min="1" required>
                            </div>

                            <div class="col-md-4">
                                <label>Barang Rusak</label>
                                <input type="number" name="barang_rusak" class="form-control" min="0" value="0">
                            </div>

                            <div class="col-md-4">
                                <label>Tanggal Masuk</label>
                                <input type="date" name="tanggal_masuk" class="form-control" value="{{ date('Y-m-d') }}" required>
                            </div>

                            <div class="col-12">
                                <label>Keterangan</label>
                                <textarea name="keterangan" class="form-control" rows="3"></textarea>
                            </div>

                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Simpan Barang Masuk</button>
                            <a href="{{ route('gudang.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection