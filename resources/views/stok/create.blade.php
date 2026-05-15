<!DOCTYPE html>
<html>
<head>
    <title>Tambah Stok</title>

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

    </style>

</head>
<body>

<div class="container">

    <h1>➕ Tambah Stok</h1>

    <form action="/stok"
          method="POST">

        @csrf

        <input type="number" name="produk_id" placeholder="Produk ID">

        <input type="number" name="stok_awal" placeholder="Stok Awal">

        <input type="number" name="stok_masuk" placeholder="Stok Masuk">

        <input type="number" name="stok_keluar" placeholder="Stok Keluar">

        <input type="number" name="stok_akhir" placeholder="Stok Akhir">

        <input type="text" name="keterangan" placeholder="Keterangan">

        <input type="number" name="user_id" placeholder="User ID">

        <button type="submit">
            Simpan
        </button>

    </form>

    <a href="/stok"
       class="home">

       🏠 Kembali

    </a>

</div>

</body>
</html>