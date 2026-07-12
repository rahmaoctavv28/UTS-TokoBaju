@extends('layouts.pelanggan')

@section('content')

<div class="container py-5">
    <div class="card shadow rounded-4">
        <div class="card-body">
            <h2 class="mb-4">Detail Pesanan</h2>
            <p>
                <b>No Pesanan :</b>
                #{{ $pesanan->id }}
            </p>
            <p>
                <b>Status :</b>
                {{ $pesanan->status }}
            </p>
            <p>
                <b>Total :</b>
                Rp {{ number_format($pesanan->total_harga,0,',','.') }}
            </p>
            <hr>
            <table class="table">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pesanan->details as $detail)
                    <tr>
                        <td width="120">
                        @if($detail->produk)
                        <img src="{{ asset('storage/'.$detail->produk->upload_foto) }}" width="90" class="rounded">
                        @endif
                        </td>
                        <td>
                        {{ $detail->produk->nama_baju }}
                        </td>
                        <td>
                        Rp {{ number_format($detail->harga_satuan,0,',','.') }}
                        </td>
                        <td>
                        {{ $detail->jumlah }}
                        </td>
                        <td>
                        Rp {{ number_format($detail->subtotal,0,',','.') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-end">
                <h4>
                    Total :
                    <span class="text-success">
                        Rp {{ number_format($pesanan->total_harga,0,',','.') }}
                    </span>
                </h4>
            </div>
            <a href="{{ route('pelanggan.pesanan') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection