@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header">
            <h3 class="fw-bold"><i class="bi bi-receipt"></i>Detail Pesanan</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><b>Invoice :</b>
                    INV{{ str_pad($pesanan->id,6,'0',STR_PAD_LEFT) }}
                    </p>
                    <p><b>Tanggal :</b>
                    {{ $pesanan->created_at->format('d M Y') }}
                    </p>
                    <p><b>Status :</b>
                    {{ $pesanan->status }}
                    </p>
                    </div>
                    <div class="col-md-6">
                        <p><b>Nama :</b>
                        {{ $pesanan->pelanggan->nama }}
                        </p>
                        <p><b>Email :</b>
                        {{ $pesanan->pelanggan->email }}
                        </p>
                        <p><b>No HP :</b>
                        {{ $pesanan->pelanggan->no_hp }}
                        </p>
                    </div>
                </div>
                <hr>
                <h5 class="mb-3">Daftar Produk</h5>
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Produk</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pesanan->details as $detail)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $detail->produk->nama_baju }}</td>
                            <td>{{ $detail->jumlah }}</td>
                            <td>Rp {{ number_format($detail->harga_satuan,0,',','.') }}</td>
                            <td>Rp {{ number_format($detail->subtotal,0,',','.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-end">
                    <h4>Total :
                    Rp {{ number_format($pesanan->total_harga,0,',','.') }}</h4>
                </div>
                <hr>
                <h5>Ubah Status Pesanan</h5>
                <form action="{{ route('pesanan.status',$pesanan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <select name="status" class="form-select">
                                <option value="Menunggu"
                                    {{ $pesanan->status=='Menunggu'?'selected':'' }}>
                                    Menunggu
                                </option>
                                <option value="Diproses"
                                    {{ $pesanan->status=='Diproses'?'selected':'' }}>
                                    Diproses
                                </option>
                                <option value="Dikemas"
                                    {{ $pesanan->status=='Dikemas'?'selected':'' }}>
                                    Dikemas
                                </option>
                                <option value="Dikirim"
                                    {{ $pesanan->status=='Dikirim'?'selected':'' }}>
                                    Dikirim
                                </option>
                                <option value="Selesai"
                                    {{ $pesanan->status=='Selesai'?'selected':'' }}>
                                    Selesai
                                </option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-success">Simpan Status</button>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('pesanan.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i>
                        Kembali
                    </a>
                    <a href="{{ route('pesanan.cetak',$pesanan->id) }}" class="btn btn-success">
                        <i class="bi bi-printer-fill"></i>
                        Cetak Resi
                    </a>
                </div>
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
        </div>
    </div>    
</div>

@endsection