@extends('layouts.pelanggan')

@section('content')

<div class="container py-5">
    <div class="card shadow border-0 rounded-4">
        <div class="card-body p-5">
            <h2 class="text-center mb-4">
                Pembayaran
            </h2>
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <form action="{{ route('pelanggan.payment.process',$pesanan->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="fw-bold">
                        Kode Pesanan
                    </label>
                    <h5>#{{ $pesanan->id }}</h5>
                </div>
                <hr>
                <div class="mb-4">
                    <label class="fw-bold">
                        Total Bayar
                    </label>
                    <h2 class="text-success">
                        Rp {{ number_format($pesanan->total_harga,0,',','.') }}
                    </h2>
                </div>
                <div class="mb-4">
                    <label class="fw-bold">
                        Metode Pembayaran
                    </label>
                    <select class="form-select" name="metode_pembayaran" id="metode">
                        <option value="Cash">Cash</option>
                        <option value="Transfer">Transfer Bank</option>
                        <option value="QRIS">QRIS</option>
                    </select>
                </div>
                <!-- CASH -->
                <div id="cash-area">
                    <div class="alert alert-success">
                        Silakan lakukan pembayaran langsung kepada kasir.
                    </div>
                </div>
                <!-- TRANSFER -->
                <div id="transfer-area" style="display:none;">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Rekening Tujuan
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th>Bank</th>
                                    <th>No Rekening</th>
                                    <th>Atas Nama</th>
                                </tr>
                                <tr>
                                    <td>BCA</td>
                                    <td>1234567890</td>
                                    <td>Geulis Sandhangan</td>
                                </tr>
                                <tr>
                                    <td>BRI</td>
                                    <td>9876543210</td>
                                    <td>Geulis Sandhangan</td>
                                </tr>
                                <tr>
                                    <td>Mandiri</td>
                                    <td>1122334455</td>
                                    <td>Geulis Sandhangan</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- QRIS -->
                <div id="qris-area" style="display:none;" class="text-center">
                    <img src="{{ asset('storage/qris.png') }}" width="250" class="img-thumbnail">
                    <p class="mt-3">
                        Scan QRIS di atas menggunakan aplikasi pembayaran.
                    </p>
                </div>
                <button
                    class="btn btn-success w-100 mt-4">
                    Bayar Sekarang
                </button>
            </form>
        </div>
    </div>
</div>

<script>

let metode=document.getElementById('metode');

let cash=document.getElementById('cash-area');

let transfer=document.getElementById('transfer-area');

let qris=document.getElementById('qris-area');

function tampilkan(){

    cash.style.display='none';

    transfer.style.display='none';

    qris.style.display='none';

    if(metode.value=="Cash"){

        cash.style.display='block';

    }

    if(metode.value=="Transfer"){

        transfer.style.display='block';

    }

    if(metode.value=="QRIS"){

        qris.style.display='block';

    }

}

metode.addEventListener('change',tampilkan);

tampilkan();

</script>

@endsection