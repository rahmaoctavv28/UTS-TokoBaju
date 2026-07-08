<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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

.form-control,
.form-select{
    height:50px;
}

</style>

</head>

<body>

<div class="container mt-4">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h2>
<i class="bi bi-cart-fill"></i>
Kasir Offline
</h2>

</div>

<div class="card-body">

<div class="row">

<div class="col-md-6 mb-3">

<label>Nama Kasir</label>

<input type="text"
class="form-control"
placeholder="Nama Kasir">

</div>

<div class="col-md-6 mb-3">

<label>Kode Transaksi</label>

<input type="text"
class="form-control"
value="TRX001">

</div>

<div class="col-md-6 mb-3">

<label>ID Produk</label>

<input type="number"
class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>Nama Produk</label>

<input type="text"
class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>Jumlah Produk</label>

<input
id="jumlah"
type="number"
class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>Harga Satuan</label>

<input
id="harga"
type="number"
class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>Subtotal</label>

<input
id="subtotal"
type="number"
class="form-control"
readonly>

</div>

<div class="col-md-6 mb-3">

<label>Metode Pembayaran</label>

<select
id="metode"
class="form-select">

<option>Pilih</option>
<option>Cash</option>
<option>Transfer</option>
<option>QRIS</option>

</select>

</div>

<div class="col-md-6 mb-3">

<label>Tanggal Transaksi</label>

<input
type="date"
class="form-control">

</div>

</div>

<div id="cash" style="display:none;">

<hr>

<div class="row">

<div class="col-md-6">

<label>Uang Masuk</label>

<input
id="bayar"
type="number"
class="form-control">

</div>

<div class="col-md-6">

<label>Kembalian</label>

<input
id="kembali"
type="number"
class="form-control"
readonly>

</div>

</div>

</div>

<br>

<button class="btn btn-success">

<i class="bi bi-save"></i>

Simpan

</button>

</div>

</div>

</div>

<script>

jumlah.onkeyup=hitung;
harga.onkeyup=hitung;

function hitung(){

subtotal.value=(jumlah.value||0)*(harga.value||0);

}

metode.onchange=function(){

cash.style.display=this.value=="Cash"?"block":"none";

}

bayar.onkeyup=function(){

kembali.value=(bayar.value||0)-(subtotal.value||0);

}

</script>

</body>
</html>