@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0 fw-bold">
                <i class="bi bi-tags-fill"></i>Data Kategori
            </h3>
            <a href="{{ route('kategori.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i>
                Tambah Kategori
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th width="5%">No</th>
                            <th width="25%">Nama Kategori</th>
                            <th>Deskripsi</th>
                            <th width="15%">Jumlah Produk</th>
                            <th width="8%">Edit</th>
                            <th width="8%">Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kategori as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_kategori }}</td>
                            <td>{{ $item->deskripsi }}</td>
                            <td>
                                <span>
                                    {{ $item->produk_count }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('kategori.edit',$item->id) }}"
                                   class="btn btn-sm">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('kategori.destroy',$item->id) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        onclick="return confirm('Yakin ingin menghapus kategori ini?')"
                                        class="btn btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">
                                Belum ada data kategori.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection