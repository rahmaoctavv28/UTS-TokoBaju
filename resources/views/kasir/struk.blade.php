<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Struk Belanja</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>

        body{
            background:#f5f5f5;
            padding:40px;
        }

        .struk{
            max-width:420px;
            margin:auto;
            background:white;
            padding:25px;
            border-radius:10px;
            box-shadow:0 5px 20px rgba(0,0,0,.15);
        }

        hr{
            border-style:dashed;
        }

        @media print{

            body{
                background:white;
                padding:0;
            }

            .btn-area{
                display:none;
            }

            .struk{
                box-shadow:none;
                width:100%;
                border:none;
            }

        }

    </style>

</head>

<body>

<div class="struk">

    <h3 class="text-center fw-bold">
        OddWear
    </h3>

    <p class="text-center mb-1">
        Toko Pakaian
    </p>

    <p class="text-center text-muted">
        Bandung
    </p>

    <hr>

    <table class="table table-borderless table-sm">

        <tr>
            <td>Kode</td>
            <td>{{ $transaksi->kode_transaksi }}</td>
        </tr>

        <tr>
            <td>Kasir</td>
            <td>{{ $transaksi->nama_kasir }}</td>
        </tr>

        <tr>
            <td>Tanggal</td>
            <td>{{ $transaksi->created_at->format('d-m-Y H:i') }}</td>
        </tr>

    </table>

    <hr>

    <table class="table table-sm">

        <thead>

        <tr>

            <th>Produk</th>

            <th>Qty</th>

            <th>Total</th>

        </tr>

        </thead>

        <tbody>

        @foreach($transaksi->detailTransaksi as $detail)

        <tr>

            <td>{{ $detail->produk->nama_baju }}</td>

            <td>{{ $detail->qty }}</td>

            <td>
                Rp {{ number_format($detail->subtotal,0,',','.') }}
            </td>

        </tr>

        @endforeach

        </tbody>

    </table>

    <hr>

    <table class="table table-borderless">

        <tr>

            <th>Total</th>

            <th class="text-end">
                Rp {{ number_format($transaksi->total_bayar,0,',','.') }}
            </th>

        </tr>

        <tr>

            <td>Dibayar</td>

            <td class="text-end">
                Rp {{ number_format($transaksi->uang_dibayar,0,',','.') }}
            </td>

        </tr>

        <tr>

            <td>Kembalian</td>

            <td class="text-end text-success fw-bold">
                Rp {{ number_format($transaksi->kembalian,0,',','.') }}
            </td>

        </tr>

    </table>

    <hr>

    <p class="text-center">
        Terima kasih telah berbelanja di OddWear
    </p>

    <div class="text-center btn-area mt-4">

        <button onclick="window.print()"
                class="btn btn-success">

            🖨 Cetak

        </button>

        <a href="{{ route('transaksi.create') }}"
           class="btn btn-primary">

            Transaksi Baru

        </a>

    </div>

</div>

</body>
</html>