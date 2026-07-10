@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3>Detail Produk</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5 text-center">
                    @if($produk->upload_foto)
                    <img src="{{ asset('storage/'.$produk->upload_foto) }}" class="img-fluid rounded shadow" style="max-height:400px;">
                    @else
                    <img src="https://via.placeholder.com/350x350?text=No+Image" class="img-fluid">
                    @endif
                </div>

                <div class="col-md-7">
                    <table class="table table-bordered">
                        <tr>
                            <th width="35%">Nama Produk</th>
                            <td>{{ $produk->nama_baju }}</td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td>{{ $produk->kategori->nama_kategori }}</td>
                        </tr>
                        <tr>
                            <th>Ukuran</th>
                            <td>{{ strtoupper($produk->ukuran) }}</td>
                        </tr>
                        <tr>
                            <th>Harga</th>
                            <td>Rp {{ number_format($produk->harga,0,',','.') }}</td>
                        </tr>
                        <tr>
                            <th>Stok</th>
                            <td>{{ $produk->stok }}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td>{{ $produk->deskripsi }}</td>
                        </tr>
                    </table>
                    <a href="{{ route('produk.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i>
                    Kembali
                    </a>
            </div>
        </div>
    </div>
</div>
</div>

@endsection