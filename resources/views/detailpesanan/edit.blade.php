<!DOCTYPE html>
<html>
<head>
    <title>Edit Detail Pesanan</title>

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

    <h1>✏️ Edit Detail Pesanan</h1>

    <form action="/detailpesanan/{{ $detailpesanan->id }}"
          method="POST">

        @csrf
        @method('PUT')
        <label>Id Pesanan</label>
        <input type="number"
               name="pesanan_id"
               value="{{ $detailpesanan->pesanan_id }}" >

        <label>Id Produk</label>
        <input type="number"
               name="produk_id"
               value="{{ $detailpesanan->produk_id }}">

        <label>Jumlah</label>
        <input type="number"
               name="jumlah"
               value="{{ $detailpesanan->jumlah }}">

        <label>Harga Baru</label>
        <input type="number"
               name="harga_satuan"
               value="{{ $detailpesanan->harga_satuan }}">

        <label>Subtotal</label>
        <input type="number"
               name="subtotal"
               value="{{ $detailpesanan->subtotal }}">

        <button type="submit">
            Update
        </button>

    </form>

</div>

</body>
</html>