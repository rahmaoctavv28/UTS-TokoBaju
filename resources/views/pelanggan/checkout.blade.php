@extends('layouts.pelanggan')

@section('content')

<div class="container py-5">
    <div class="row">
        <div class="col-lg-7">
            <div class="card shadow border-0 rounded-4">
                <div class="card-body">
                    <h3 class="mb-4">Data Pengiriman</h3>
                    <form action="{{ route('pelanggan.checkout.process') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Nama Penerima</label>
                            <input type="text" name="nama_penerima" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>No HP</label>
                            <input type="text" name="telepon" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Alamat Lengkap</label>
                            <textarea name="alamat" rows="5" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Catatan</label>
                            <textarea name="catatan" rows="3" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success btn-lg">
                        Lanjut Pembayaran
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card shadow border-0 rounded-4">
                <div class="card-body">
                    <h4>Ringkasan Pesanan</h4>
                    <hr>
                    @php
                    $total=0;
                    @endphp
                    @foreach($cart as $item)
                    @php
                    $subtotal=$item['harga']*$item['qty'];
                    $total+=$subtotal;
                    @endphp
                    <div class="d-flex justify-content-between">
                    <span>
                    {{ $item['nama'] }}
                    x{{ $item['qty'] }}
                    </span>
                    <span>Rp {{ number_format($subtotal,0,',','.') }}</span>
                </div>
                @endforeach
                <hr>
                <h4 class="text-success">
                    Total
                    Rp {{ number_format($total,0,',','.') }}
                </h4>
            </div>
        </div>
    </div>
</div>
</div>
@endsection