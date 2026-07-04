<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin Gudang</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI',sans-serif;
        }

        body{
            background:#eef2f7;
        }

        .sidebar{
            width:260px;
            height:100vh;
            background:#183153;
            position:fixed;
            left:0;
            top:0;
            padding:25px;
        }

        .logo{
            color:white;
            font-size:28px;
            font-weight:bold;
            text-align:center;
            margin-bottom:40px;
        }

        .menu{
            display:block;
            text-decoration:none;
            color:white;
            padding:15px;
            margin-bottom:15px;
            border-radius:12px;
            background:#24446a;
            transition:.3s;
        }

        .menu:hover{
            background:#3465e1;
        }

        .content{
            margin-left:280px;
            padding:40px;
        }

        .welcome{
            background:white;
            padding:25px;
            border-radius:20px;
            box-shadow:0 5px 15px rgba(0,0,0,.1);
            margin-bottom:25px;
        }

        .welcome h1{
            color:#183153;
            margin-bottom:10px;
        }

        .welcome p{
            color:#666;
        }

        .cards{
            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:20px;
            margin-bottom:25px;
        }

        .card{
            padding:25px;
            border-radius:20px;
            color:white;
            box-shadow:0 5px 15px rgba(0,0,0,.15);
        }

        .card h2{
            font-size:16px;
            margin-bottom:10px;
        }

        .card p{
            font-size:40px;
            font-weight:bold;
        }

        .blue{
            background:linear-gradient(135deg,#3b82f6,#2563eb);
        }

        .green{
            background:linear-gradient(135deg,#22c55e,#16a34a);
        }

        .orange{
            background:linear-gradient(135deg,#f59e0b,#d97706);
        }

        .red{
            background:linear-gradient(135deg,#ef4444,#dc2626);
        }

        .notif{
            margin-bottom:25px;
            background:#fff4e5;
            border-left:6px solid #f59e0b;
            padding:18px;
            border-radius:12px;
            color:#92400e;
            font-weight:bold;
        }

        .dashboard-grid{
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:20px;
        }

        .box{
            background:white;
            border-radius:20px;
            padding:25px;
            box-shadow:0 5px 15px rgba(0,0,0,.1);
        }

        .box h3{
            color:#183153;
            margin-bottom:20px;
        }

        .activity{
            background:#f8fafc;
            padding:12px;
            border-radius:10px;
            margin-bottom:10px;
        }

        .chart-area{
            height:300px;
        }

        canvas{
            max-height:280px;
        }

        @media(max-width:1000px){

            .cards{
                grid-template-columns:repeat(2,1fr);
            }

            .dashboard-grid{
                grid-template-columns:1fr;
            }

        }

    </style>

</head>
<body>

<div class="sidebar">

    <div class="logo">
        📦 Gudang
    </div>

    <a href="/stok" class="menu">
        📦 Data Stok
    </a>

    <a href="/supplier" class="menu">
        🏪 Supplier
    </a>

    <a href="/laporanstok" class="menu">
        📊 Laporan Stok
    </a>

    <a href="/" class="menu">
        🏠 Kembali Home
    </a>

</div>

<div class="content">

    <div class="welcome">

        <h1>Dashboard Admin Gudang</h1>

        <p>
            Monitoring stok barang, supplier, aktivitas gudang dan notifikasi restock.
        </p>

    </div>

    <div class="cards">

        <div class="card blue">
            <h2>Total Produk</h2>
            <p>{{ $totalProduk }}</p>
        </div>

        <div class="card green">
            <h2>Total Supplier</h2>
            <p>{{ $totalSupplier }}</p>
        </div>

        <div class="card orange">
            <h2>Barang Masuk</h2>
            <p>{{ $barangMasuk }}</p>
        </div>

        <div class="card red">
            <h2>Barang Keluar</h2>
            <p>{{ $barangKeluar }}</p>
        </div>

    </div>

    @if(count($produkMenipis) > 0)

    <div class="notif">
        ⚠️ Ada {{ count($produkMenipis) }} produk yang stoknya menipis dan perlu segera direstock.
    </div>

    @endif

    <div class="dashboard-grid">

        <div class="box">

            <h3>📈 Grafik Barang Masuk & Keluar</h3>

            <div class="chart-area">
                <canvas id="stokChart"></canvas>
            </div>

        </div>

        <div class="box">

            <h3>📊 Distribusi Stok</h3>

            <div class="chart-area">
                <canvas id="pieChart"></canvas>
            </div>

        </div>

        <div class="box">

            <h3>⚠️ Notifikasi Stok Menipis</h3>

            @forelse($produkMenipis as $p)

                <div class="activity">

                    <strong>{{ $p->nama_baju }}</strong>

                    <br>

                    Ukuran : {{ $p->ukuran }}

                    <br>

                    Sisa Stok : {{ $p->stok }}

                </div>

            @empty

                <div class="activity">
                    Semua stok aman
                </div>

            @endforelse

        </div>

        <div class="box">

            <h3>📦 Aktivitas Terbaru Gudang</h3>

            @forelse($aktivitas as $a)

                <div class="activity">

                    <strong>
                        {{ $a->produk->nama_baju ?? '-' }}
                    </strong>

                    <br>

                    Barang Masuk :
                    {{ $a->stok_masuk }}

                    |

                    Barang Keluar :
                    {{ $a->stok_keluar }}

                    <br>

                    Stok Akhir :
                    {{ $a->stok_akhir }}

                </div>

            @empty

                <div class="activity">
                    Belum ada aktivitas stok
                </div>

            @endforelse

        </div>

    </div>

</div>

<script>

new Chart(document.getElementById('stokChart'), {

    type:'line',

    data:{
        labels:[
            'Sen',
            'Sel',
            'Rab',
            'Kam',
            'Jum',
            'Sab',
            'Min'
        ],

        datasets:[

            {
                label:'Barang Masuk',
                data:[20,40,70,55,90,45,75]
            },

            {
                label:'Barang Keluar',
                data:[10,20,30,25,35,20,30]
            }

        ]
    }

});

new Chart(document.getElementById('pieChart'), {

    type:'doughnut',

    data:{

        labels:[
            'Stok Aman',
            'Stok Menipis',
            'Stok Habis'
        ],

        datasets:[{

            data:[70,20,10]

        }]

    }

});

</script>

</body>
</html>