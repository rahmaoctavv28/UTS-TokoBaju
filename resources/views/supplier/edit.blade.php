<!DOCTYPE html>
<html>
<head>
    <title>Edit Supplier</title>

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

        textarea{
            width:100%;
            padding:15px;
            margin-bottom:20px;
            border:none;
            border-radius:15px;
            background:#f3f3f3;
            height:100px;
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

    <h1>✏️ Edit Supplier</h1>

    <form action="/supplier/{{ $supplier->id }}"
          method="POST">

        @csrf
        @method('PUT')

        <input type="text"
               name="nama_supplier"
               value="{{ $supplier->nama_supplier }}">

        <input type="text"
               name="no_hp"
               value="{{ $supplier->no_hp }}">

        <textarea name="alamat">{{ $supplier->alamat }}</textarea>

        <input type="text"
               name="kota"
               value="{{ $supplier->kota }}">

        <button type="submit">
            Update
        </button>

    </form>

    <a href="/supplier"
       class="home">

       🏠 Kembali

    </a>

</div>

</body>
</html>