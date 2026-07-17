<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Kasir Offline</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{
    background:#f5f6fa;
}

.card{
    border:none;
    border-radius:15px;
}

.card-header{
    border-radius:15px 15px 0 0 !important;
}

.form-control,
.form-select{
    height:48px;
}

/* FORM KIRI TETAP */
.sticky-form{
    position:sticky;
    top:20px;
}

/* PANEL PRODUK */
.product-panel{
    height:90vh;
    overflow-y:auto;
    overflow-x:hidden;
    padding-right:8px;
}

/* CARD PRODUK */
.product-card{
    border-radius:12px;
    transition:.3s;
    cursor:pointer;
}

.product-card:hover{
    transform:translateY(-3px);
    box-shadow:0 8px 18px rgba(0,0,0,.15);
}

.product-img{
    width:100%;
    height:110px;
    object-fit:cover;
    border-radius:12px 12px 0 0;
}

.product-card .card-body{
    padding:10px;
}

.product-card h6{
    font-size:15px;
    margin-bottom:5px;
}

.product-card small{
    font-size:12px;
}

.btn-tambah{
    font-size:13px;
}


</style>

</head>

<body>
    <div class="container-fluid py-4">
        <div class="row">
            <!-- ===========================
            FORM TRANSAKSI
            =========================== -->
            <div class="col-lg-8">
                <div class="sticky-form">
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0"><i class="bi bi-cart-fill"></i>Transaksi Kasir</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('transaksi.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="fw-bold">Nama Kasir</label>
                                        <input type="text" name="nama_kasir" class="form-control" value="{{ $nama_kasir }}" readonly>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="fw-bold">Kode Transaksi</label>
                                    <input type="text" name="kode_transaksi" class="form-control" value="{{ $kode_transaksi }}" readonly>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="fw-bold">Tanggal</label>
                                        <input type="text" class="form-control" value="{{ date('d-m-Y H:i') }}" readonly>
                                    </div>
                                </div>
                                <hr>
                                <h5 class="mb-3"><i class="bi bi-cart3"></i>Daftar Belanja</h5>
                                <table class="table table-bordered align-middle" id="cartTable">
                                    <thead class="table-primary">
                                        <tr>
                                            <th width="35%">Produk</th>
                                            <th width="18%">Harga</th>
                                            <th width="15%">Qty</th>
                                            <th width="20%">Subtotal</th>
                                            <th width="12%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="emptyCart">
                                            <td colspan="5" class="text-center text-muted">
                                            Belum ada produk dipilih
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="fw-bold">Total Bayar</label>
                                        <input id="total" type="number" name="total_bayar" class="form-control fw-bold text-success" value="0" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="fw-bold">Metode Pembayaran</label>
                                        <select id="metode" name="metode_pembayaran" class="form-select">
                                            <option value="">Pilih Metode</option>
                                            <option value="Cash">Cash</option>
                                            <option value="Transfer">Transfer</option>
                                            <option value="QRIS">QRIS</option>
                                        </select>
                                    </div>
                                </div>
                                    <div id="cashArea" class="mt-3" style="display:none;">
                                        <div class="row">
                                            <div class="col-md-6">
                                        <label class="fw-bold">Uang Dibayar</label>
                                        <input id="bayar" type="number" name="uang_dibayar" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="fw-bold">Kembalian</label>
                                        <input id="kembalian" type="number" name="kembalian" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div id="transferArea" style="display:none;" class="mt-3">
                               <div class="alert alert-info">
                                    <h6 class="fw-bold">Transfer Bank</h6>
                                    <hr>
                                    BCA : <b>1234567890</b><br>
                                    a.n <b>Toko Bajuku</b>
                                </div>
                            </div>
                            <div id="qrisArea" style="display:none;" class="mt-3 text-center">
                                <img src="{{ asset('images/qris.png') }}" class="img-fluid" style="width:220px;">
                                <p class="mt-2">Silakan scan QRIS untuk pembayaran.</p>
                            </div>
                            <div class="text-end mt-4">
                                <button type="submit" class="btn btn-success btn-lg"><i class="bi bi-save"></i>Simpan Transaksi</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- ===========================
DAFTAR PRODUK
=========================== -->
    <div class="col-lg-4">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">
                <i class="bi bi-bag-fill"></i> Daftar Produk
            </h5>
    </div>
    <div class="card-body">
        <!-- Pencarian -->
        <div class="mb-3">
            <input type="text" id="searchProduk" class="form-control" placeholder="🔍 Cari Produk...">
        </div>
        <!-- Daftar Produk -->
        <div class="product-panel">
            <div class="row">
                @foreach($produks as $produk)
                <div class="col-md-6 col-6 mb-3 product-item"
                     data-nama="{{ strtolower($produk->nama_baju) }}">
                    <div class="card product-card">
                        <!-- Gambar -->
                        @if($produk->upload_foto)
                            <img src="{{ asset('storage/'.$produk->upload_foto) }}"
                                 class="product-img">
                        @else
                            <img src="https://via.placeholder.com/300x300"
                                 class="product-img">
                        @endif
                        <div class="card-body text-center">
                            <h6>{{ $produk->nama_baju }}</h6>
                            <div class="text-success fw-bold">
                                Rp {{ number_format($produk->harga,0,',','.') }}
                            </div>
                        </div>
                         <small class="text-center">
                            Stok :
                            {{ optional($produk->stokTerakhir)->stok_akhir ?? 0 }}
                        </small>
                        <button type="button" class="btn btn-success btn-sm w-100 mt-2 btn-tambah tambahProduk" data-id="{{ $produk->id }}" data-nama="{{ $produk->nama_baju }}" data-harga="{{ $produk->harga }}">
                            <i class="bi bi-plus-circle"></i>
                            Tambahkan
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<script>

let cart = [];

// ==========================
// TAMBAH PRODUK
// ==========================
document.querySelectorAll('.tambahProduk').forEach(button => {
    button.addEventListener('click', function () {
        let id = this.dataset.id;
        let nama = this.dataset.nama;
        let harga = parseInt(this.dataset.harga);
        let produk = cart.find(item => item.id == id);
        if (produk) {
            produk.qty++;
        } else {
            cart.push({
                id: id,
                nama: nama,
                harga: harga,
                qty: 1
            });
        }
        renderCart();
    });
});


// ==========================
// RENDER CART
// ==========================
function renderCart() {
    let tbody = document.querySelector('#cartTable tbody');
    tbody.innerHTML = "";
    let total = 0;
    cart.forEach((item,index)=>{
        let subtotal = item.qty * item.harga;
        total += subtotal;
        tbody.innerHTML += `
        <tr>
            <td>
                ${item.nama}
                <input type="hidden" name="produk_id[]" value="${item.id}">
            </td>
            <td>
                Rp ${item.harga.toLocaleString('id-ID')}
            </td>
            <td width="120">
                <input type="number" class="form-control qty" min="1" value="${item.qty}" data-index="${index}" name="qty[]">
            </td>
            <td>
                Rp ${subtotal.toLocaleString('id-ID')}
            </td>
            <td width="60">
                <button type="button" class="btn btn-danger btn-sm hapus" data-index="${index}">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        </tr>
        `;
    });
    document.getElementById("total").value = total;
    aktifkanQty();
    aktifkanHapus();
}
// ==========================
// HAPUS PRODUK
// ==========================
function aktifkanHapus(){
    document.querySelectorAll(".hapus").forEach(button=>{
        button.onclick=function(){
            cart.splice(this.dataset.index,1);
            renderCart();
        }
    });
}

// ==========================
// UBAH JUMLAH
// =========================
function aktifkanQty(){
    document.querySelectorAll(".qty").forEach(input=>{
        input.onchange=function(){
            let index=this.dataset.index
            cart[index].qty=parseInt(this.value);
            if(cart[index].qty<1){
                cart[index].qty=1;
            }
            renderCart();
        }
    });
}
// ==========================
// SEARCH PRODUK
// ==========================
const search = document.getElementById("searchProduk");
if(search){
    search.addEventListener("keyup",function(){
        let keyword=this.value.toLowerCase();
        document.querySelectorAll(".product-item").forEach(item=>{
            let nama=item.dataset.nama.toLowerCase();
            if(nama.includes(keyword)){
                item.style.display="";
            }else{
                item.style.display="none";
            }
        });
    });
}
// ==========================
// METODE PEMBAYARAN
// ==========================
const metode=document.getElementById("metode");
if(metode){
    metode.addEventListener("change",function(){
        document.getElementById("cashArea").style.display="none";
        document.getElementById("transferArea").style.display="none";
        document.getElementById("qrisArea").style.display="none";
        if(this.value=="Cash"){
            document.getElementById("cashArea").style.display="block";
        }
        if(this.value=="Transfer"){
            document.getElementById("transferArea").style.display="block";
        }
        if(this.value=="QRIS"){
            document.getElementById("qrisArea").style.display="block";
        }
    });
}

// ==========================
// HITUNG KEMBALIAN
// ==========================
const bayar=document.getElementById("bayar");
if(bayar){
    bayar.addEventListener("keyup",function(){
        let total=parseInt(document.getElementById("total").value)||0;
        let uang=parseInt(this.value)||0;
        document.getElementById("kembalian").value=uang-total;
    });
}

</script>

</body>
</html>
</body>

</html>