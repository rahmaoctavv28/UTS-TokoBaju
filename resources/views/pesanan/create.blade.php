<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pesanan - Geulis Sandhangan</title>
    <style>
        body{
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #ffe066, #ff6ec7, #6ea8ff);
            min-height: 100vh;
            padding: 40px;
        }
        .container{
            width: 550px;
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
            display: block;
            margin-bottom: 5px;
        }
        input, select{
            width: 100%;
            padding: 12px;
            margin-bottom: 18px;
            border-radius: 10px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        .btn{
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 10px;
            background: #6ea8ff;
            color: white;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
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
        .stok-info {
            font-size: 14px;
            color: #e91e63;
            margin-top: -10px;
            margin-bottom: 15px;
        }
        .error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>🛒 Tambah Pesanan</h1>

    <form action="/pesanan" method="POST" id="pesananForm">
        @csrf

        <label>Pilih Admin</label>
        <select name="admin_id" required>
            <option value="">-- Pilih Admin --</option>
            @foreach($admin as $a)
            <option value="{{ $a->id }}">{{ $a->nama }}</option>
            @endforeach
        </select>

        <label>Nama Pelanggan</label>
        <select name="pelanggan_id" required>
            @foreach($pelanggan as $p)
            <option value="{{ $p->id }}">{{ $p->nama_pelanggan }}</option>
            @endforeach
        </select>

        <label>Jenis Produk</label>
        <select name="nama_barang" id="produk" onchange="updateStokInfo()" required>
            <option value="">-- Pilih Produk --</option>
            @foreach($produk as $p)
            <option 
                value="{{ $p->nama_baju }}"
                data-harga="{{ $p->harga }}"
                data-stok="{{ $p->stok }}">
                {{ $p->nama_baju }} (Rp {{ number_format($p->harga) }})
            </option>
            @endforeach
        </select>

        <div id="stokInfo" class="stok-info"></div>

        <label>Jumlah</label>
        <input type="number" 
               id="jumlah" 
               name="jumlah" 
               placeholder="Masukkan jumlah" 
               onkeyup="updateStokInfo()"
               required min="1">

        <button type="submit" class="btn" id="submitBtn">
            Simpan Pesanan
        </button>
    </form>

    <a href="/pesanan" class="back">← Kembali ke Data Pesanan</a>
</div>

<script>
function updateStokInfo() {
    const select = document.getElementById('produk');
    const jumlahInput = document.getElementById('jumlah');
    const stokInfo = document.getElementById('stokInfo');
    const submitBtn = document.getElementById('submitBtn');

    if (select.value === "") {
        stokInfo.innerHTML = "";
        submitBtn.disabled = true;
        return;
    }

    const stok = parseInt(select.options[select.selectedIndex].dataset.stok);
    const jumlah = parseInt(jumlahInput.value) || 0;

    if (stok <= 0) {
        stokInfo.innerHTML = `❌ Stok habis!`;
        submitBtn.disabled = true;
    } else if (jumlah > stok) {
        stokInfo.innerHTML = `⚠️ Stok tersisa: ${stok} | Jumlah melebihi stok!`;
        submitBtn.disabled = true;
    } else {
        stokInfo.innerHTML = `✅ Stok tersisa: ${stok}`;
        submitBtn.disabled = false;
    }
}

// Jalankan saat halaman dimuat
window.onload = updateStokInfo;
</script>

</body>
</html>