<!DOCTYPE html>
<html>
<head>
    <title>Edit Pesanan</title>

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
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        h1{
            text-align: center;
            color: #ff1493;
            margin-bottom: 25px;
        }

        label{
            font-weight: bold;
            color: #444;
        }

        input,
        select{
            width: 100%;
            padding: 12px;
            margin-top: 8px;
            margin-bottom: 20px;
            border-radius: 10px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .btn{
            width: 100%;
            background: #ff1493;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-size: 18px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover{
            background: #6ea8ff;
        }

        .home-btn{
            display: inline-block;
            margin-bottom: 20px;
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

    <a href="/pesanan" class="home-btn">
        ← Kembali
    </a>

    <h1>🛒 Edit Pesanan</h1>

    <form action="/pesanan/{{ $data->id }}" method="POST">

        @csrf
        @method('PUT')


        <label>Nama Pelanggan</label>

        <input type="text"
               name="nama_pelanggan"
               value="{{ $data->nama_pelanggan }}"
               required>

        <label>Nama Barang</label>

        <input type="text"
               name="nama_barang"
               value="{{ $data->nama_barang }}"
               required>

        <label>Harga Produk</label>

        <input type="number"
               id="harga"
               name="harga"
               value="{{ $data->harga }}"
               required>

        <label>Jumlah</label>

        <input type="number"
               id="jumlah"
               name="jumlah"
               value="{{ $data->jumlah }}"
               required>

        <label>Total Harga</label>

        <input type="number"
               id="total_harga"
               name="total_harga"
               value="{{ $data->total_harga }}"
               readonly>

        <button type="submit" class="btn">
            Update Pesanan
        </button>

    </form>

</div>

<script>

    const harga = document.getElementById('harga');
    const jumlah = document.getElementById('jumlah');
    const total = document.getElementById('total_harga');

    function hitungTotal() {

        let hasil = harga.value * jumlah.value;

        total.value = hasil;
    }

    harga.addEventListener('keyup', hitungTotal);

    jumlah.addEventListener('keyup', hitungTotal);

</script>

</body>
</html>