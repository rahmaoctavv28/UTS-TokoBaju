```blade
@extends('layouts.app')

@section('content')

<div class="container-fluid">

<div class="d-flex justify-content-between mb-4">

<h3>

<i class="bi bi-receipt-cutoff"></i>

Detail Transaksi

</h3>

<a href="{{ route('laporan.transaksi') }}"
class="btn btn-secondary">

<i class="bi bi-arrow-left"></i>

Kembali

</a>

</div>

<div class="card shadow">

<div class="card-header bg-success text-white">

Informasi Transaksi

</div>

<div class="card-body">

<table class="table">

<tr>

<th width="250">

Kode Transaksi

</th>

<td>

{{ $transaksi->kode_transaksi }}

</td>

</tr>

<tr>

<th>

Jenis Transaksi

</th>

<td>

@if($transaksi->jenis_transaksi=="Online")

<span class="badge bg-primary">

Online

</span>

@else

<span class="badge bg-warning text-dark">

Kasir

</span>

@endif

</td>

</tr>

<tr>

<th>

Status

</th>

<td>

<span class="badge bg-success">

{{ $transaksi->status }}

</span>

</td>

</tr>

<tr>

<th>

Tanggal

</th>

<td>

{{ $transaksi->created_at->format('d F Y H:i') }}

</td>

</tr>

</table>

</div>

</div>

@if($transaksi->jenis_transaksi=="Online")

<div class="card shadow mt-4">

<div class="card-header bg-primary text-white">

Data Penerima

</div>

<div class="card-body">

<table class="table">

<tr>

<th width="250">

Nama Penerima

</th>

<td>

{{ $transaksi->pesanan->nama_penerima }}

</td>

</tr>

<tr>

<th>

Alamat

</th>

<td>

{{ $transaksi->pesanan->alamat }}

</td>

</tr>

<tr>

<th>

No HP

</th>

<td>

{{ $transaksi->pesanan->telepon }}

</td>

</tr>

</table>

</div>

</div>

@endif

<div class="card shadow mt-4">

<div class="card-header bg-dark text-white">

Produk

</div>

<div class="card-body">

<table class="table table-bordered">

<thead class="table-success">

<tr>

<th>No</th>

<th>Produk</th>

<th>Qty</th>

<th>Harga</th>

<th>Subtotal</th>

</tr>

</thead>

<tbody>

@if($transaksi->jenis_transaksi=="Online")

@foreach($transaksi->pesanan->details as $item)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $item->produk->nama_baju }}</td>

<td>{{ $item->jumlah }}</td>

<td>

Rp {{ number_format($item->harga_satuan,0,',','.') }}

</td>

<td>

Rp {{ number_format($item->subtotal,0,',','.') }}

</td>

</tr>

@endforeach

@else

<tr>

<td>1</td>

<td>{{ $transaksi->nama_produk }}</td>

<td>{{ $transaksi->jumlah_produk }}</td>

<td>

Rp {{ number_format($transaksi->harga_satuan,0,',','.') }}

</td>

<td>

Rp {{ number_format($transaksi->subtotal,0,',','.') }}

</td>

</tr>

@endif

</tbody>

</table>

</div>

</div>

<div class="card shadow mt-4">

<div class="card-header bg-success text-white">

Ringkasan Pembayaran

</div>

<div class="card-body">

<table class="table">

<tr>

<th width="250">

Metode Pembayaran

</th>

<td>

{{ $transaksi->metode_pembayaran }}

</td>

</tr>

<tr>

<th>

Total Bayar

</th>

<td>

Rp {{ number_format($transaksi->total_bayar,0,',','.') }}

</td>

</tr>

<tr>

<th>

Uang Dibayar

</th>

<td>

Rp {{ number_format($transaksi->uang_dibayar,0,',','.') }}

</td>

</tr>

<tr>

<th>

Kembalian

</th>

<td>

Rp {{ number_format($transaksi->kembalian,0,',','.') }}

</td>

</tr>

</table>

</div>

</div>

<div class="text-end mt-4">

<a href="{{ route('laporan.cetak',$transaksi->id) }}"
class="btn btn-success">

<i class="bi bi-printer"></i>

Cetak Laporan

</a>

</div>

</div>

@endsection
```
