@extends('layouts.app')

@section('content')
<div class="container mt-4">
        <div class="card-header text-black">
                <div class="d-flex justify-content-between mb-3">
                    <h2>Data Supplier</h2>
                    <a href="{{ route('supplier.create') }}" class="btn btn-light">
                    ➕ Tambah Supplier
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <table class="table table-bordered table-hover text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Supplier</th>
                        <th>No HP</th>
                        <th>Alamat</th>
                        <th width="8%">Edit</th>
                        <th width="8%">Hapus</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($supplier as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_supplier }}</td>
                        <td>{{ $item->no_hp }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>
                            <a href="{{ route('supplier.edit',$item->id) }}" class="btn btn-warning btn-sm">✏</a>
                        </td>
                        <td>
                            <form action="{{ route('supplier.destroy',$item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin ingin menghapus supplier ini?')" class="btn btn-danger btn-sm"> 🗑 </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            Belum ada data supplier.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection