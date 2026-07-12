@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">
            <i class="bi bi-receipt-cutoff"></i>
            Cetak Resi Pesanan
        </h2>
        <div>
            <a href="{{ route('pesanan.show', $pesanan->id) }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <button onclick="window.print()" class="btn btn-success">
                <i class="bi bi-printer-fill"></i> Cetak Resi
            </button>
        </div>
    </div>
    <div class="card shadow border-0" id="area-print">
        <div class="card-body p-5">
            <div class="text-center mb-4">
                <div class="text-center mb-4">
                    <img src="{{ asset('images/logo.jpeg') }}" width="90" class="mb-2">
                    <h2 class="fw-bold mb-0">GEULIS SANDHANGAN</h2>
                    <p class="mb-0">Fashion Store</p>
                    <small>Jl. Soekarno Hatta No. 123, Bandung, Jawa Barat</small>
                <br>
                    <small>
                    WhatsApp : 0812-3456-7890</small>
                </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <th width="180">No. Invoice</th>
                            <td>
                                : INV{{ str_pad($pesanan->id,6,'0',STR_PAD_LEFT) }}
                            </td>
                        </tr>
                        <tr>
                            <th>Tanggal Pesanan</th>
                            <td>
                                : {{ $pesanan->created_at->format('d F Y') }}
                            </td>
                        </tr>
                        <tr>
                            <th>Status Pesanan</th>
                            <td>
                                : {{ $pesanan->status }}
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <th width="180">Nama Penerima</th>
                            <td>
                                : {{ $pesanan->nama_penerima }}
                            </td>
                        </tr>
                        <tr>
                            <th>No. HP</th>
                            <td>
                                : {{ $pesanan->pelanggan->no_hp }}
                            </td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>
                                : {{ $pesanan->pelanggan->alamat }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card border-0 bg-light mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Kurir</strong><br>
                            GS Kurir
                        </div>
                        <div class="col-md-4">
                            <tr>
                                <th><strong>Metode Pembayaran </strong></th><br>
                                <td> {{ $pesanan->metode_pembayaran }}</td>
                            </tr>
                        </div>
                        <div class="col-md-4">
                            <strong>Status Pengiriman</strong><br>
                            {{ $pesanan->status }}
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <h5 class="fw-bold mb-3">Detail Produk</h5>
            <table class="table table-bordered text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th width="8%">No</th>
                        <th>Nama Produk</th>
                        <th width="12%">Qty</th>
                        <th width="18%">Harga</th>
                        <th width="18%">Subtotal</th>
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
            <div class="row justify-content-end mt-4">
                <div class="col-md-4">
                    <table class="table">
                        <tr>
                            <th>Total Pembayaran</th>
                            <td class="text-end fw-bold text-success">
                                Rp {{ number_format($pesanan->total_harga,0,',','.') }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <hr>
            <div class="row mt-5">
                <div class="col-md-6">
                    <p class="mb-0">Terima kasih telah berbelanja di</p>
                    <h5 class="fw-bold">Geulis Sandhangan</h5>
                </div>
                <div class="col-md-6 text-end">
                    <p>
                        Bandung,
                        {{ now()->format('d F Y') }}
                    </p>
                    <br><br>
                    <b>Admin Geulis Sandhangan</b>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection