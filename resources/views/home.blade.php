<!DOCTYPE html>
<html>
<head>
    <title>Geulis Sandhangan</title>

    <style>

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body{
            min-height: 100vh;
            background: linear-gradient(135deg, #ffe066, #ff6ec7, #6ea8ff);
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            color: white;
        }

        .container{
            text-align: center;
        }

        .logo{
            font-size: 70px;
            margin-bottom: 20px;
        }

        h1{
            font-size: 55px;
            margin-bottom: 15px;
        }

        p{
            font-size: 22px;
            margin-bottom: 50px;
        }

        .menu-container{
            display: flex;
            gap: 25px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .menu{
            width: 180px;
            height: 180px;
            background: white;
            border-radius: 25px;
            text-decoration: none;
            color: #ff1493;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transition: 0.3s;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .menu:hover{
            transform: translateY(-10px);
            background: #fff0f7;
        }

        .icon{
            font-size: 55px;
            margin-bottom: 15px;
        }

        .menu-text{
            font-size: 22px;
            font-weight: bold;
        }

    </style>
</head>
<body>

<div class="container">

    <div class="logo">
        🛍️
    </div>

    <h1>Geulis Sandhangan</h1>
    <p>

    </p>
    <br><br>
    <div class="menu-container">

        <!-- PRODUK -->
        <a href="/produk" class="menu">
            <div class="icon">
                📦
            </div>
            <div class="menu-text">
                Produk
            </div>
        </a>

        <!-- PELANGGAN -->
        <a href="/pelanggan" class="menu">
            <div class="icon">
                👥
            </div>
            <div class="menu-text">
                Pelanggan
            </div>
        </a>

        <!-- PESANAN -->
        <a href="/pesanan" class="menu">
            <div class="icon">
                🛒
            </div>
            <div class="menu-text">
                Pesanan
            </div>
        </a>

        <!-- ADMIN -->
        <a href="/admin" class="menu">
            <div class="icon">
                👨‍💼
            </div>
            <div class="menu-text">
                Admin
            </div>
        </a>

        <!-- KATEGORI -->
        <a href="/kategori" class="menu">
            <div class="icon">
                🏷️
            </div>
            <div class="menu-text">
                Kategori
            </div>
        </a>
    </div>
    <br></br>
    <div class="menu-container">
        <!-- TRANSAKSI -->
        <a href="/transaksi" class="menu">
            <div class="icon">
                💳
            </div>
            <div class="menu-text">
                Transaksi
            </div>
        </a>

        <!-- SUPPLIER -->
        <a href="/supplier" class="menu">
            <div class="icon">
                🚚
            </div>
            <div class="menu-text">
                Supplier
            </div>
        </a>

        <!-- STOK -->
        <a href="/stok" class="menu">
            <div class="icon">
                📊
            </div>
            <div class="menu-text">
                Stok
            </div>
        </a>

        <!-- DETAIL PESANAN -->
        <a href="/detailpesanan" class="menu">
            <div class="icon">
                📋
            </div>
            <div class="menu-text">
                Detail Pesanan
            </div>
        </a>

    </div>
</div>

</body>
</html>