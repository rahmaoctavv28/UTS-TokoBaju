<!DOCTYPE html>
<html>
<head>
    <title>Data Admin - Geulis Sandhangan</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #ffe066, #ff6ec7, #6ea8ff);
            min-height: 100vh;
            padding: 40px;
        }

        .container{
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        h1{
            text-align: center;
            color: #ff1493;
            margin-bottom: 30px;
        }

        .btn{
            background: #ff1493;
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .btn:hover{
            background: #6ea8ff;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th{
            background: #6ea8ff;
            color: white;
            padding: 12px;
        }

        table td{
            background: #fff5fa;
            padding: 12px;
            text-align: center;
        }

        .action{
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        form{
            display: inline;
        }

        button{
            background: #ff1493;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 10px;
            cursor: pointer;
        }

        button:hover{
            background: #6ea8ff;
        }

        .top-action{
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .btn{
            background: #ff1493;
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .btn:hover{
            background: #6ea8ff;
        }

        .home-btn{
            background: #6ea8ff;
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
        }

        .home-btn:hover{
            background: #ff1493;
        }
    </style>
</head>
<body>

<div class="container">

    <h1>👨‍💼 Data Admin</h1>
    <div class="top-action">
        <a href="/admin/create" class="btn">
            + Tambah Admin
        </a>
        <a href="/" class="home-btn">
            🏠 Home
        </a>
    </div>
    <table border="1">

        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Edit</th>
            <th>Hapus</th>
        </tr>
        @foreach($data as $d)
        <tr>
            <td>{{ $d->nama }}</td>
            <td>{{ $d->email }}</td>
            <td>
                <div class="action">
                    <a href="/admin/{{ $d->id }}/edit" class="btn">
                        Edit
                    </a>
            </td>
            <td>
                <form action="/admin/{{ $d->id }}"
                      method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="hapus" onclick="return confirm('Apakah yakin ingin menghapus data ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
</body>
</html>