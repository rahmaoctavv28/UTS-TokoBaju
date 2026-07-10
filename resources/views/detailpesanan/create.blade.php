<!DOCTYPE html>
<html>
<head>
    <title>Tambah Detail Pesanan</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial;
        }

        body{
            min-height:100vh;
            background: linear-gradient(135deg,#ffe066,#ff6ec7,#6ea8ff);
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .container{
            width:700px;
            background:white;
            padding:40px;
            border-radius:25px;
        }

        h1{
            text-align:center;
            color:#ff1493;
            margin-bottom:30px;
        }

        input{
            width:100%;
            padding:15px;
            margin-bottom:20px;
            border:none;
            border-radius:15px;
            background:#f3f3f3;
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
        }

    </style>

</head>
<body>

<div class="container">

    <h1> ➕ Tambah Detail Pesanan</h1>

    <form action="/detailpesanan"
          method="POST">

        @csrf

        <input type="number"
               name="pesanan_id"
               placeholder="Pesanan ID">

        <input type="number"
               name="produk_id"
               placeholder="Produk ID">

        <input type="number"
               name="jumlah"
               placeholder="Jumlah">

        <input type="number"
               name="harga_satuan"
               placeholder="Harga">

        <input type="number"
               name="subtotal"
               placeholder="Subtotal">

        <button type="submit">
            Simpan
        </button>

    </form>

</div>

</body>
</html>