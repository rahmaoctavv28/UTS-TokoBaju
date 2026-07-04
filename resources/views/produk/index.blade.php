@extends('layouts.app')

@section('content')

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="container">
<div class="d-flex justify-content-between mb-3">
<h2>Data Produk</h2>
<a href="{{ route('produk.create') }}" class="btn btn-light">
➕ Tambah Produk
</a>
</div>
<table class="table table-bordered table-hover text-center align-middle">
<thead class="table-dark text-center">
    <tr>
        <th width="5%">No</th>
        <th width="20%">Nama Produk</th>
        <th width="15%">Kategori</th>
        <th width=10%>Ukuran</th>
        <th width="15%">Foto</th>
        <th width="15%">Harga</th>
        <th width="10%">Stok</th>
        <th width="5%">Edit</th>
        <th width="5%">Hapus</th>
        <th width="5%">Detail</th>
    </tr>
</thead>
    <tbody>
    @foreach($produk as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->nama_baju }}</td>
        <td>{{ $item->kategori->nama_kategori }}</td>
        <td>{{ strtoupper($item->ukuran) }}</td>
        <td>
            @if($item->upload_foto)
                <img src="{{ asset('storage/'.$item->upload_foto) }}"
                     width="100"
                     class="img-thumbnail">
            @else
                Tidak ada foto
            @endif
        </td>
        <td>
            Rp {{ number_format($item->harga,0,',','.') }}
        </td>
        <td>
            {{ $item->stok }}
        </td>
        <td>
            <a href="{{ route('produk.edit',$item->id) }}"
               class="btn btn-sm">
                ✏ 
            </a>
        </td>
        <td>
            <form action="{{ route('produk.destroy',$item->id) }}"
                  method="POST"
                  style="display:inline;">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm"
                        onclick="return confirm('Hapus data?')">
                     🗑 
                </button>
            </form>
        </td>
        <td>
            <a href="{{ route('produk.show', $item->id) }}"
            class="btn btn-sm">
            👁️
            </a>
        </td>
    </tr>
    <!-- <div class="modal fade" id="detail{{ $item->id }}" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5>Detail Produk</h5>
                    <button class="btn-close btn-close-white"
                    data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                    <div class="col-md-5 text-center">
                        <img src="{{ asset('storage/'.$item->upload_foto) }}"class="img-fluid rounded">
                    </div>
                        <div class="col-md-7">
                            <table class="table">
                                <tr>
                                    <th>Nama Produk</th>
                                    <td>{{ $item->nama_baju }}</td>
                                </tr>
                            <tr>
                                <th>Kategori</th>
                                <td>{{ $item->kategori->nama_kategori }}</td>
                            </tr>
                            <tr>
                                <th>Ukuran</th>
                                <td>{{ $item->ukuran }}</td>
                            </tr>
                            <tr>
                                <th>Harga</th>
                                <td>
                                Rp {{ number_format($item->harga,0,',','.') }}
                                </td>
                            </tr>
                            <tr>
                                <th>Stok</th>
                                <td>{{ $item->stok }}</td>
                                </tr>
                            <tr>
                            <th>Deskripsi</th>
                                <td>{{ $item->deskripsi }}</td>
                            </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal"> Tutup </button>
        </div>
    </div>
    </div>
    </div> -->
    @endforeach
    </tbody>
</table>
</div>
@endsection