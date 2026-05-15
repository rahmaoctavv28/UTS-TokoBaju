<!DOCTYPE html>
<html>
<head>
    <title>Edit Stok</title>

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

    <h1>✏️ Edit Stok</h1>

    <form action="/stok/{{ $stok->id }}"
          method="POST">

        @csrf
        @method('PUT')

        <input type="number"
               name="produk_id"
               value="{{ $stok->produk_id }}">

        <input type="number"
               name="stok_awal"
               value="{{ $stok->stok_awal }}">

        <input type="number"
               name="stok_masuk"
               value="{{ $stok->stok_masuk }}">

        <input type="number"
               name="stok_keluar"
               value="{{ $stok->stok_keluar }}">

        <input type="number"
               name="stok_akhir"
               value="{{ $stok->stok_akhir }}">

        <input type="text"
               name="keterangan"
               value="{{ $stok->keterangan }}">

        <input type="number"
               name="user_id"
               value="{{ $stok->user_id }}">

        <button type="submit">
            Update
        </button>

    </form>

    <a href="/stok"
       class="home">

       🏠 Kembali

    </a>

</div>

</body>
</html>