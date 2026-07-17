
    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI',sans-serif;
        }

        body{
            background:#eef2f7;
            padding:40px;
        }

        .container{
            max-width:800px;
            margin:auto;
            background:white;
            border-radius:25px;
            padding:40px;
            box-shadow:0 15px 35px rgba(0,0,0,0.1);
        }

        h1{
            font-size:45px;
            color:#183153;
            margin-bottom:30px;
            font-weight:800;
        }

        label{
            display:block;
            margin-bottom:8px;
            color:#334155;
            font-weight:600;
        }

        input{
            width:100%;
            padding:15px;
            border:1px solid #d1d5db;
            border-radius:12px;
            margin-bottom:20px;
            font-size:16px;
        }

        input:focus{
            outline:none;
            border-color:#3465e1;
        }

        .btn{
            width:100%;
            border:none;
            background:#3465e1;
            color:white;
            padding:16px;
            border-radius:12px;
            font-size:18px;
            font-weight:bold;
            cursor:pointer;
        }

        .btn:hover{
            background:#2954c8;
        }

        .back{
            display:block;
            text-align:center;
            margin-top:15px;
            text-decoration:none;
            background:#4b5c77;
            color:white;
            padding:16px;
            border-radius:12px;
            font-weight:bold;
        }

    </style>

</head>
<body>

<div class="container">

    <h1>➕ Tambah Supplier</h1>

    <form action="/supplier" method="POST">

        @csrf

        <label>Nama Supplier</label>
        <input type="text"
               name="nama_supplier"
               placeholder="Masukkan Nama Supplier"
               required>

        <label>No HP Supplier</label>
        <input type="text"
               name="no_hp"
               placeholder="Masukkan No HP Supplier"
               required>

        <label>Alamat Perusahaan</label>
        <input type="text"
               name="alamat"
               placeholder="Masukkan Alamat Perusahaan"
               required>

        <label>Jenis Barang</label>
        <input type="text"
               name="kota"
               placeholder="Contoh : Baju Wanita, Baju Pria, Hijab"
               required>

        <button type="submit" class="btn">
            Simpan Data Supplier
        </button>

    </form>

    <a href="/supplier" class="back">
        ← Kembali ke Data Supplier
    </a>