<!-- <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light"> -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
            <h2 class="mb-0">Data Kategori</h2>
            <a href="{{ route('kategori.create') }}" class="btn btn-light">
                ➕ Tambah Kategori
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <table class="table table-bordered table-hover text-center align-middle">
                    {{ session('success') }}
                </div>
            @endif
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th width="5%">No</th>
                        <th width="25%">Nama Kategori</th>
                        <th>Deskripsi</th>
                        <th width="15%">Jumlah Produk</th>
                        <th width="5%">Edit</th>
                        <th width="5%">Hapus</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($kategori as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_kategori }}</td>
                        <td>{{ $item->deskripsi }}</td>
                        <td>
                            <span class="badge text-black">
                                {{ $item->produk_count }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('kategori.edit',$item->id) }}"
                               class="btn btn-sm">
                                ✏ 
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('kategori.destroy',$item->id) }}"
                                  method="POST"
                                  style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button
                                    onclick="return confirm('Yakin ingin menghapus kategori ini?')"
                                    class="btn btn-sm">
                                    🗑 
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            Belum ada data kategori.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> -->
@endsection