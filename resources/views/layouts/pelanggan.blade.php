<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>GS Collection</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>

        body{
            background:#f8f5ef;
            font-family:'Poppins',sans-serif;
            padding-top:80px;
        }

        .navbar{
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,.08);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 9999;
        }
        .navbar-brand{
            font-weight:bold;
            color:#b88a44;
            font-size:28px;
        }

        .nav-link{
            color:#444;
            font-weight:500;
        }

        .nav-link:hover{
            color:#b88a44;
        }

        .icon-menu i{
            font-size:22px;
            margin-left:20px;
            color:#444;
        }

        .icon-menu i:hover{
            color:#b88a44;
        }

        .hero{
            min-height: calc(100vh - 80px);
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
        }

        /* Logo */
        .logo{
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding: 20px;
        }

        .logo-img{
            width: 80px;
            height: 45px;
            object-fit: cover;
            border-radius: 50%; /* Hilangkan jika ingin logo tetap kotak */
        }

        .logo-text{
            font-size: 18px;
            font-weight: 700;
        }

        .dropdown-toggle::after{
            display: inline-block;
            margin-left: .5rem;
            vertical-align: middle;
        }

        .navbar .dropdown-toggle{
            display: flex;
            align-items: center;
        }

        .card{
            transition:.3s;
        }

        .card:hover{
            transform:translateY(-3px);
        }

        .btn-danger{
            width:45px;
            height:45px;
        }

        .form-control{
            border-radius:10px;
        }

        .qty-btn
        {
            width:38px;
            height:38px;
            border-radius:50%;
        }
    </style>
</head>

<body>
    @php
    $cart = session('cart', []);
    $cartCount = 0;
    foreach($cart as $item){
        $cartCount += $item['qty'];
    }
    $wishlistCount = \App\Models\Wishlist::where('pelanggan_id',1)->count();
    @endphp
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <div class="logo">
            <img src="{{ asset('images/logo.jpeg') }}"alt="Logo" class="logo-img">
            <a class="navbar-brand" href="#">Geulis Sandhangan</a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- <div class="collapse navbar-collapse" id="menu">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item">
                <a href="{{ route('pelanggan.index') }}" class="nav-link"><h2><i class="fa-solid fa-house"></i></h2></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><h2>Kategori</h2></a>
                <ul class="dropdown-menu">
                    @foreach($kategoris as $kategori)
                        <li>
                            <a class="dropdown-item" href="{{ route('pelanggan.kategori', $kategori->id) }}">
                                {{ $kategori->nama_kategori }}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"><h2>Promo</h2></a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"><h2>Tentang</h2></a>
            </li>
        </ul> -->
        <div class="d-flex align-items-center">
            <a href="/pelanggan#produk" class="text-dark me-4 text-decoration-none">
               <h2><i class="fa-solid fa-house"></i></h2></a>
            {{-- Search --}}
            <a href="{{ route('pelanggan.search') }}" class="text-dark me-4 text-decoration-none">
               <h2><i class="fa-solid fa-magnifying-glass"></i></h2></a>
            {{-- Wishlist --}}
            <a href="{{ route('pelanggan.wishlist') }}" class=" text-dark me-4 text-decoration-none nav-icon position-relative">
                    <h2><i class="fa-regular fa-heart"></i></h2>
                    @if($wishlistCount > 0)
                        <span id="wishlist-count"
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $wishlistCount }}
                        </span>
                    @endif
                </a>
            {{-- Keranjang --}}
            <a href="{{ route('pelanggan.cart') }}" class="text-dark me-4 text-decoration-none position-relative">
                <h2><i class="fa-solid fa-cart-shopping"></i></h2>
                <span class="badge bg-danger rounded-pill position-absolute top-0 start-100 translate-middle">{{ count(session('cart', [])) }}</span></a>
            {{-- Pesanan Saya --}}
            <a href="{{ route('pelanggan.pesanan') }}" class="text-dark me-4 text-decoration-none">
                <h2><i class="fa-solid fa-box"></i></h2></a>
            {{-- Profile --}}
            <div class="dropdown">
                <a href="#" class="text-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                    <h2><i class="fa-regular fa-user"></i></h2></a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('pelanggan.profile') }}">Profil Saya</a>
                    </li>
                    <li>
                        <a class="dropdown-item text-danger" href="#">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</nav>


@yield('content')


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Toast Wishlist -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">

    <div id="wishlistToast"
         class="toast text-bg-success"
         role="alert">

        <div class="d-flex">

            <div class="toast-body">
                Berhasil ditambahkan ke Wishlist
            </div>

            <button class="btn-close btn-close-white me-2 m-auto"
                    data-bs-dismiss="toast">
            </button>

        </div>

    </div>

</div>

<script>

function showToast(text){

    document.querySelector('#wishlistToast .toast-body').innerHTML = text;

    let toast = new bootstrap.Toast(
        document.getElementById('wishlistToast')
    );

    toast.show();

}

document.querySelectorAll('.wishlist-btn').forEach(button => {

    button.addEventListener('click', function(){

        let id = this.dataset.id;

        fetch('/pelanggan/wishlist/add/' + id, {

            method: 'POST',

            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }

        })

        .then(res => res.json())

        .then(data => {

            if(data.success){

                this.classList.remove('btn-outline-danger');
                this.classList.add('btn-danger');

                this.innerHTML = '<i class="fa-solid fa-heart"></i>';

                const badge = document.getElementById('wishlist-count');

                if(badge){
                    badge.innerHTML = data.count;
                }

                showToast(data.message);

            }

        });

    });

});

</script>

</body>

</html>