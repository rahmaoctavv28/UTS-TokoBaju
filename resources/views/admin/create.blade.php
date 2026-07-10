<!DOCTYPE html>
<html>
<head>
    <title>Tambah Admin - Geulis Sandhangan</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #ffe066, #ff6ec7, #6ea8ff);
            min-height: 100vh;
            padding: 40px;
        }

        .container{
            width: 500px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        h1{
            text-align: center;
            color: #ff1493;
            margin-bottom: 25px;
        }

        label{
            font-weight: bold;
            color: #333;
        }

        input{
            width: 100%;
            padding: 12px;
            margin-top: 8px;
            margin-bottom: 18px;
            border-radius: 10px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .btn{
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 10px;
            background: #6ea8ff;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .btn:hover{
            background: #ff1493;
        }

        .back{
            text-decoration: none;
            display: inline-block;
            margin-top: 15px;
            color: #ff1493;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>➕ Tambah Admin</h1>
    <form action="/admin" method="POST">
        @csrf
        <label>Nama Admin</label>
        <input type="text"
               name="nama"
               placeholder="Masukkan Nama Admin">
        <label>Email</label>
        <input type="email"
               name="email"
               placeholder="Masukkan Email">
        <label>Password</label>
        <input type="password"
               name="password"
               placeholder="Masukkan Password">
        <button type="submit" class="btn">
            Simpan Admin
        </button>
    </form>
    <a href="/admin" class="back">
        ← Kembali ke Data Admin
    </a>
</div>
</body>
</html>