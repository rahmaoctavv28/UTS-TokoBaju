<!DOCTYPE html>
<html>
<head>
    <title>Edit Pelanggan</title>

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

        input,
        textarea{
            width:100%;
            padding:15px;
            margin-bottom:20px;
            border:none;
            border-radius:15px;
            background:#f3f3f3;
        }

        textarea{
            height:120px;
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

    <h1>✏️ Edit Pelanggan</h1>

    <form action="/pelanggan/{{ $pelanggan->id }}"
          method="POST">

        @csrf
        @method('PUT')

        <input type="text"
               name="nama_pelanggan"
               value="{{ $pelanggan->nama_pelanggan }}">

        <textarea name="alamat">{{ $pelanggan->alamat }}</textarea>

        <input type="text"
               name="no_hp"
               value="{{ $pelanggan->no_hp }}">

        <button type="submit">
            Update
        </button>

    </form>

    <a href="/pelanggan"
       class="home">

       🏠 Kembali

    </a>

</div>

</body>
</html>