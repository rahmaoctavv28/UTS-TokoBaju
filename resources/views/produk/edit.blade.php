<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>

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
            box-shadow:0 10px 25px rgba(0,0,0,0.2);
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
            cursor:pointer;
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

    <h1>✏️ Edit Produk</h1>

    <form action="/produk/{{ $produk->id }}"
          method="POST">

        @csrf
        @method('PUT')

        <input type="text"
               name="nama_baju"
               value="{{ $produk->nama_baju }}">

        <input type="text"
               name="ukuran"
               value="{{ $produk->ukuran }}">

        <input type="number"
               name="harga"
               value="{{ $produk->harga }}">

        <input type="number"
               name="stok"
               value="{{ $produk->stok }}">

        <button type="submit">
            Update
        </button>

    </form>

    <a href="/produk"
       class="home">

       🏠 Kembali

    </a>

</div>

</body>
</html>