<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Pesanan;
use App\Models\PesananDetail;
use App\Models\Transaksi;
use App\Models\StokHistory;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PelangganController extends Controller
{
    public function index(){
        // $produks = Produk::where('stok', '>', 0)->get();
        $produks = Produk::with(['kategori','stokTerakhir'])->get();
        $kategoris = Kategori::all();

        return view('pelanggan.shop', compact('produks', 'kategoris'));
    }

    // public function create(){
    //     return view('pelanggan.create');
    // }

    // public function store(Request $request){
    //     Pelanggan::create([
    //         'nama_pelanggan' => $request->nama_pelanggan,
    //         'alamat' => $request->alamat,
    //         'no_hp' => $request->no_hp,
    //     ]);

    //     return redirect('/pelanggan');
    // }

    // public function edit($id){
    //     $pelanggan = Pelanggan::findOrFail($id);

    //     return view('pelanggan.edit', compact('pelanggan'));
    // }

    // public function update(Request $request, $id){
    //     $pelanggan = Pelanggan::findOrFail($id);

    //     $pelanggan->update([
    //         'nama_pelanggan' => $request->nama_pelanggan,
    //         'alamat' => $request->alamat,
    //         'no_hp' => $request->no_hp,
    //     ]);

    //     return redirect('/pelanggan');
    // }

    // public function destroy($id){
    //     $pelanggan = Pelanggan::findOrFail($id);

    //     $pelanggan->delete();

    //     return redirect('/pelanggan');
    // }

    public function addToCart(Request $request, $id){
        $produk = Produk::with('stokTerakhir')->findOrFail($id);
        $qty = (int) $request->qty;
        $stok = $produk->stokTerakhir->stok_akhir ?? 0;
         if ($qty > $stok){
            return back()->with('error', 'Jumlah melebihi stok yang tersedia.');
        }

        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            if (($cart[$id]['qty'] + $qty) > $stok) {
                return back()->with('error', 'Jumlah melebihi stok.');
            }
            $cart[$id]['qty'] += $qty;
        } else {
            $cart[$id] = [
                'id' => $produk->id,
                'nama' => $produk->nama_baju,
                'harga' => $produk->harga,
                'gambar' => $produk->upload_foto,
                'qty' => $qty
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('pelanggan.cart')
                        ->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function cart(){
        $cart = session()->get('cart', []);
        $kategoris = Kategori::all();

        return view('pelanggan.cart', compact('cart', 'kategoris'));
    }

    public function pesanan(){
        $pesanans = Pesanan::with('transaksi')
                        ->latest()
                        ->get();
        $kategoris = Kategori::all();
        return view('pelanggan.pesanan', compact( 'pesanans', 'kategoris' ));
    }

    public function profile(){
        $kategoris = Kategori::all();
        return view('pelanggan.profile');
    }

    public function kategori($id){
        $kategoris = Kategori::all();
        $produks = Produk::with(['kategori', 'stokTerakhir'])
            ->where('kategori_id', $id)
            ->get();
        // $produks = Produk::where('kategori_id', $id)->get();

        return view('pelanggan.shop', compact('produks', 'kategoris'));
    }

    public function detail($id){
        $produk = Produk::with(['kategori', 'stokTerakhir'])->findOrFail($id);
        $kategoris = Kategori::all();

        return view('pelanggan.detail', compact('produk', 'kategoris'));
    }

    public function increaseQty($id){
        $cart = session()->get('cart', []);
        if(isset($cart[$id])){
            $produk = Produk::with('stokTerakhir')->findOrFail($id);
            $stok = $produk->stokTerakhir->stok_akhir ?? 0;
            if($cart[$id]['qty'] < $stok){
                $cart[$id]['qty']++;
            }
        }
        session()->put('cart',$cart);
        return back();
    }

    public function decreaseQty($id){
        $cart = session()->get('cart', []);
        if(isset($cart[$id])){
            if($cart[$id]['qty'] > 1){
                $cart[$id]['qty']--;
            }
        }
        session()->put('cart',$cart);
        return back();
    }

    public function removeCart($id){
        $cart = session()->get('cart', []);
        if(isset($cart[$id])){
            unset($cart[$id]);
            session()->put('cart',$cart);
        }
        return back()->with('success','Produk berhasil dihapus dari keranjang.');
    }

    public function checkout(){
        $cart = session()->get('cart', []);
        if(count($cart) == 0){
            return redirect()->route('pelanggan.cart');
        }
        $kategoris = Kategori::all();
            return view('pelanggan.checkout', compact('cart', 'kategoris'));
        }

    public function processCheckout(Request $request)
    {
        $cart = session()->get('cart', []);

        // Cek keranjang kosong
        if (empty($cart)) {
            return redirect()
                ->route('pelanggan.cart')
                ->with('error', 'Keranjang masih kosong.');
        }

        DB::beginTransaction();

        try {

            // Hitung total harga
            $total = 0;

            foreach ($cart as $item) {
                $total += $item['harga'] * $item['qty'];
            }

            // Simpan pesanan
            $pesanan = Pesanan::create([
                'admin_id'      => null,
                'pelanggan_id'  => 1, // Ganti dengan ID pelanggan yang ada
                'nama_penerima' => $request->nama_penerima,
                'nama_barang'   => count($cart) == 1
                                    ? reset($cart)['nama']
                                    : 'Beberapa Produk',
                'jumlah'        => collect($cart)->sum('qty'),
                'total_harga'   => $total,
                'metode_pembayaran' => $request->metode_pembayaran,
                'status'        => 'Menunggu Pembayaran'
            ]);

            // Simpan detail pesanan
            foreach ($cart as $item) {

                PesananDetail::create([
                    'pesanan_id'   => $pesanan->id,
                    'produk_id'    => $item['id'],
                    'jumlah'       => $item['qty'],
                    'harga_satuan' => $item['harga'],
                    'subtotal'     => $item['harga'] * $item['qty'],
                ]);

            }

            DB::commit();

            // Pindah ke halaman pembayaran
            return redirect()->route('pelanggan.payment', $pesanan->id);

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', $e->getMessage());

        }
    }

    public function payment($id){
        $pesanan = Pesanan::findOrFail($id);
        $kategoris = Kategori::all();

        return view('pelanggan.payment', compact('pesanan', 'kategoris'));
    }

    public function processPayment(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);

        DB::beginTransaction();

        try {
            $pesanan->metode_pembayaran = $request->metode_pembayaran;
            $pesanan->save();
            Transaksi::create([
                'pesanan_id' => $pesanan->id,
                'kode_transaksi' => 'TRX' . date('YmdHis'),
                'jenis_transaksi' => 'Online',
                'metode_pembayaran' => $request->metode_pembayaran,
                'total_bayar' => $pesanan->total_harga,
                'uang_dibayar' => $pesanan->total_harga,
                'kembalian' => 0,
                'status' => 'Lunas'
            ]);

            $pesanan->update([
                'status' => 'Lunas'
            ]);

            $details = PesananDetail::where('pesanan_id', $pesanan->id)->get();

            foreach ($details as $detail) {

                $stokTerakhir = StokHistory::where('produk_id', $detail->produk_id)
                    ->latest('id')
                    ->first();

                if ($stokTerakhir) {

                    StokHistory::create([
                        'produk_id'   => $detail->produk_id,
                        'stok_awal'   => $stokTerakhir->stok_akhir,
                        'stok_masuk'  => 0,
                        'stok_keluar' => $detail->jumlah,
                        'stok_akhir'  => $stokTerakhir->stok_akhir - $detail->jumlah,
                        'keterangan'  => 'Penjualan',
                        'user_id'     => null,
                    ]);
                }
            }

            DB::commit();

            session()->forget('cart');

            return redirect()
                ->route('pelanggan.pesanan')
                ->with('success', 'Pembayaran berhasil.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }

    public function detailPesanan($id){
        $pesanan = Pesanan::with([
            'details.produk',
            'transaksi'
        ])->findOrFail($id);

        $kategoris = Kategori::all();

        return view('pelanggan.detail_pesanan', compact(
            'pesanan',
            'kategoris'
        ));
    }

    public function search(Request $request)
    {
        $kategoris = Kategori::all();
        $produks = Produk::with(['kategori', 'stokTerakhir']);

        if ($request->filled('keyword')) {
            $produks->where('nama_baju', 'like', '%' . $request->keyword . '%');
        }

        if ($request->filled('kategori')) {
            $produks->where('kategori_id', $request->kategori);
        }

        $produks = $produks->get();
        return view('pelanggan.search', compact(
            'produks',
            'kategoris'
        ));
    }

    public function wishlist(){
        $kategoris = Kategori::all();

        $wishlists = Wishlist::with('produk')
            ->where('pelanggan_id', 1)
            ->latest()
            ->get();

        return view('pelanggan.wishlist', compact(
            'wishlists',
            'kategoris'
        ));
    }

    public function addWishlist($id){
        Wishlist::firstOrCreate(
            [
                'pelanggan_id' => 1,
                'produk_id' => $id
            ]
        );

        return response()->json([
            'success'=> true,
            'Produk' => 'berhasil ditambahkan ke wishlist.',
            'count' => Wishlist::where('pelanggan_id',1)->count()
        ]);
    }

    public function removeWishlist($id){
        Wishlist::where('pelanggan_id', 1)
            ->where('produk_id', $id)
            ->delete();

        return redirect()
            ->route('pelanggan.wishlist')
            ->with('success', 'Produk berhasil dihapus dari wishlist.');
    }

    // public function removeWishlist($id){
    //     Wishlist::where('pelanggan_id',1     //         ->where('produk_id',$id)
    //         ->delete();

    //     return response()->json([
    //         'success'=>true,
    //         'count'=>Wishlist::where('pelanggan_id',1)->count()
    //     ]);
    // }
}