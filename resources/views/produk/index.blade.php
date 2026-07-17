@extends('layouts.app')

@section('content')

<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="container">

    <div class="d-flex justify-content-between mb-3">
        <h2 class="fw-bold">
            <i class="bi bi-box-seam"></i> Data Produk
        </h2>

        <a href="{{ route('produk.create') }}" class="btn btn-light">
            ➕ Tambah Produk
        </a>
    </div>

    <table class="table table-bordered table-hover text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th width="5%">No</th>
                <th width="20%">Nama Produk</th>
                <th width="15%">Kategori</th>
                <th width="10%">Ukuran</th>
                <th width="15%">Foto</th>
                <th width="15%">Harga</th>
                <th width="10%">Stok</th>
                <th width="5%">Edit</th>
                <th width="5%">Hapus</th>
                <th width="5%">Detail</th>
            </tr>
        </thead>
        <tbody>
            @forelse($produk as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_baju }}</td>
                    <td>{{ optional($item->kategori)->nama_kategori ?? '-' }}</td>
                    <td>{{ strtoupper($item->ukuran) }}</td>
                   <td class="text-center">
                        @if($item->upload_foto)
                            <img src="{{ asset('storage/'.$item->upload_foto) }}"
                                alt="Foto Produk"
                                class="img-thumbnail"
                                style="width:90px; height:90px; object-fit:cover;">
                        @else
                            Tidak ada foto
                        @endif
                    </td>
                    <td>
                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                    </td>
                    <td>{{ $item->stok }}</td>
                    <td>
                        <a href="{{ route('produk.edit', $item->id) }}"
                           class="btn btn-sm">
                            ✏️
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('produk.destroy', $item->id) }}"
                              method="POST"
                              onsubmit="return confirm('Hapus data?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm">
                                🗑️
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
            @empty
                <tr>
                    <td colspan="10">
                        Belum ada data produk.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection