@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="fw-bold">
                <i class="bi bi-bar-chart-line-fill text-primary"></i>
                Grafik Penjualan
            </h3>

            <p class="text-muted">
                Statistik penjualan Geulis Sandhangan
            </p>

        </div>

    </div>

    <!-- Ringkasan -->
    <div class="row mb-4">

        <div class="col-md-4">

            <div class="card shadow border-0">

                <div class="card-body text-center">

                    <i class="bi bi-cart-check-fill display-5 text-primary"></i>

                    <h6 class="mt-3">
                        Transaksi Online
                    </h6>

                    <h2 class="fw-bold">

                        {{ $online }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card shadow border-0">

                <div class="card-body text-center">

                    <i class="bi bi-shop display-5 text-success"></i>

                    <h6 class="mt-3">
                        Transaksi Kasir
                    </h6>

                    <h2 class="fw-bold">

                        {{ $kasir }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card shadow border-0">

                <div class="card-body text-center">

                    <i class="bi bi-cash-stack display-5 text-warning"></i>

                    <h6 class="mt-3">
                        Total Transaksi
                    </h6>

                    <h2 class="fw-bold">

                        {{ $online + $kasir }}

                    </h2>

                </div>

            </div>

        </div>

    </div>

    <!-- Grafik -->
    <div class="row">

        <div class="col-lg-8">

            <div class="card shadow border-0 mb-4">

                <div class="card-header bg-primary text-white">

                    <b>Grafik Pendapatan Bulanan</b>

                </div>

                <div class="card-body">

                    <canvas id="chartBulanan" height="100"></canvas>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="card shadow border-0 mb-4">

                <div class="card-header bg-success text-white">

                    <b>Online vs Kasir</b>

                </div>

                <div class="card-body">

                    <canvas id="chartJenis"></canvas>

                </div>

            </div>

        </div>

    </div>

    <!-- Produk Terlaris -->
    <div class="card shadow border-0">

        <div class="card-header bg-warning">

            <b>
                Top 5 Produk Terlaris
            </b>

        </div>

        <div class="card-body table-responsive">

            <table class="table table-hover align-middle text-center">

                <thead class="table-warning">

                    <tr>

                        <th>No</th>

                        <th>Nama Produk</th>

                        <th>Total Terjual</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($produkTerlaris as $item)

                    <tr>

                        <td>

                            {{ $loop->iteration }}

                        </td>

                        <td>

                            {{ $item->nama_baju }}

                        </td>

                        <td>

                            <span class="badge bg-success">

                                {{ $item->total }}

                            </span>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="3">

                            Belum ada data.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection


@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

// ===============================
// Pendapatan Bulanan
// ===============================

const bulan = [

@foreach($penjualanBulanan as $item)

"{{ DateTime::createFromFormat('!m',$item->bulan)->format('M') }}",

@endforeach

];

const total = [

@foreach($penjualanBulanan as $item)

{{ $item->total }},

@endforeach

];

new Chart(document.getElementById('chartBulanan'),{

    type:'bar',

    data:{

        labels:bulan,

        datasets:[{

            label:'Pendapatan',

            data:total,

            borderWidth:1

        }]

    },

    options:{

        responsive:true,

        scales:{

            y:{

                beginAtZero:true

            }

        }

    }

});

// ===============================
// Online VS Kasir
// ===============================

new Chart(document.getElementById('chartJenis'),{

    type:'pie',

    data:{

        labels:['Online','Kasir'],

        datasets:[{

            data:[

                {{ $online }},

                {{ $kasir }}

            ]

        }]

    },

    options:{

        responsive:true

    }

});

</script>

@endsection
