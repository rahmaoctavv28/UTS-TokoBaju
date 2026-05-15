<!DOCTYPE html>
<html>
<head>
    <title>Tambah Transaksi</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial;
        }

        body{
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background: linear-gradient(135deg,#ffe066,#ff6ec7,#6ea8ff);
            padding:40px;
        }

        .container{
            width:700px;
            background:white;
            padding:40px;
            border-radius:25px;
            box-shadow:0 10px 25px rgba(0,0,0,0.2);
        }

        h1{
            text-align:center;
            color:#ff1493;
            margin-bottom:30px;
        }

        label{
            display:block;
            margin-bottom:8px;
            margin-top:15px;
            font-weight:bold;
            color:#444;
        }

        input,
        select{
            width:100%;
            padding:15px;
            margin-bottom:20px;
            border:none;
            border-radius:15px;
            background:#f3f3f3;
            font-size:16px;
        }

        input:focus,
        select:focus{
            outline:none;
            background:#ececec;
        }

        button{
            width:100%;
            padding:15px;
            border:none;
            border-radius:15px;
            background:#ff1493;
            color:white;
            font-size:18px;
            font-weight:bold;
            cursor:pointer;
            margin-top:10px;
        }

        button:hover{
            background:#ff0080;
        }

        .home{
            display:block;
            text-align:center;
            margin-top:20px;
            background:#6ea8ff;
            color:white;
            padding:15px;
            border-radius:15px;
            text-decoration:none;
            font-weight:bold;
        }

        .home:hover{
            background:#3f8cff;
        }

    </style>

</head>
<body>

<div class="container">

    <h1>➕ Tambah Transaksi</h1>

    <form action="/transaksi" method="POST">

        @csrf

        <label>ID Pesanan</label>

        <input type="number"
               name="pesanan_id"
               placeholder="Masukkan ID Pesanan"
               required>

        <label>Kode Transaksi</label>

        <input type="text"
               name="kode_transaksi"
               placeholder="Masukkan kode transaksi"
               required>

        <label>Metode Pembayaran</label>

        <select name="metode_pembayaran" required>

            <option value="">-- Pilih Metode --</option>

            <option value="Cash">Cash</option>

            <option value="Transfer">Transfer</option>

            <option value="QRIS">QRIS</option>

        </select>

        <label>Total Bayar</label>

        <input type="number"
               id="total_bayar"
               name="total_bayar"
               placeholder="Masukkan total bayar"
               required>

        <label>Uang Dibayar</label>

        <input type="number"
               id="uang_dibayar"
               name="uang_dibayar"
               placeholder="Masukkan uang dibayar"
               required>

        <label>Kembalian</label>

        <input type="number"
               id="kembalian"
               name="kembalian"
               readonly>

        <label>Status</label>

        <select name="status" required>

            <option value="">-- Pilih Status --</option>

            <option value="Lunas">Lunas</option>

            <option value="Belum Lunas">Belum Lunas</option>

        </select>

        <label>Tanggal Transaksi</label>

        <input type="date"
               name="tanggal_transaksi"
               required>

        <button type="submit">

            Simpan Transaksi

        </button>

    </form>

    <a href="/transaksi"
       class="home">

       🏠 Kembali

    </a>

</div>

<script>

    const totalBayar = document.getElementById('total_bayar');

    const uangDibayar = document.getElementById('uang_dibayar');

    const kembalian = document.getElementById('kembalian');

    function hitungKembalian(){

        let total = parseInt(totalBayar.value) || 0;

        let bayar = parseInt(uangDibayar.value) || 0;

        kembalian.value = bayar - total;
    }

    uangDibayar.addEventListener('keyup', hitungKembalian);

    totalBayar.addEventListener('keyup', hitungKembalian);

</script>

</body>
</html>