<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\Pesanan;

class PesananController extends Controller
{
    public function index()
    {
        // $data = Pesanan::with('admin', 'pelanggan')->get();
        // $pesanan = Pesanan::join('pelanggans','pesanans.pelanggan_id','=','pelanggans.id')
        // ->select('pesanans.*','pelanggans.nama_pelanggan')
        // ->get();
        $pesanan = Pesanan::with([
            'pelanggan',
            'details.produk'
        ])->latest()->get();
        
        return view('pesanan.index', compact('pesanan'));
    }

    public function create()
    {
        $admin = Admin::all();
        $pelanggan = Pelanggan::all();
        $produk = Produk::all();

        return view('pesanan.create', compact(
            'admin',
            'pelanggan',
            'produk'
        ));
    }

    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'admin_id'      => 'required',
            'pelanggan_id'  => 'required',
            'nama_penerima'=> 'required',
            'nama_barang'   => 'required',
            'jumlah'        => 'required|integer|min:1',
            'metode_pembayaran' => 'required'
        ]);

        // Cek apakah produk ada
        $produk = Produk::where('nama_baju', $request->nama_barang)->first();

        if (!$produk) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan!');
        }

        // Cek stok cukup atau tidak
        if ($produk->stok < $request->jumlah) {
            return redirect()->back()->with('error', 'Stok tidak cukup! Stok tersisa: ' . $produk->stok);
        }

        // Hitung total harga
        $total = $produk->harga * $request->jumlah;

        // Buat pesanan baru
        Pesanan::create([
            'admin_id'      => $request->admin_id,
            'pelanggan_id'  => $request->pelanggan_id,
            'nama_penerima' => $request->nama_penerima,
            'nama_penerima' => $request->nama_penerima,
            'nama_barang'   => $request->nama_barang,
            'jumlah'        => $request->jumlah,
            'total_harga'   => $total,
            'metode_pembayaran' => $request->metode_pembayaran
        ]);

        // === KURANGI STOK OTOMATIS ===
        $produk->decrement('stok', $request->jumlah);

        return redirect('/pesanan')->with('success', 'Pesanan berhasil dibuat dan stok telah dikurangi.');
    }

    public function edit($id){
        $data = Pesanan::findOrFail($id);
        $admin = Admin::all();
        $produk = Produk::all();
        $pelanggan = Pelanggan::all();

        return view('pesanan.edit',
        compact('data', 'admin', 'produk', 'pelanggan'));
    }

    public function update(Request $request, $id){
    $data = Pesanan::findOrFail($id);

        $data->update([
            'nama_barang' => $request->nama_barang,
            'jumlah' => $request->jumlah,
            'total_harga' => $request->total_harga,
        ]);

        return redirect('/pesanan');
    }

    public function destroy($id){
        Pesanan::destroy($id);

        return redirect('/pesanan')->with('success', 'Pesanan berhasil dihapus.');
    }

    public function show($id){
        $pesanan = Pesanan::with([
            'pelanggan',
            'details.produk'
        ])->findOrFail($id);

        return view('pesanan.show', compact('pesanan'));
    }

    public function updateStatus(Request $request, $id){
        $request->validate([
            'status' => 'required'
        ]);
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->status = $request->status;
        $pesanan->save();

        return redirect()
                ->route('pesanan.show',$id)
                ->with('success','Status pesanan berhasil diperbarui.');
    }

    public function cetak($id){
        $pesanan = Pesanan::with([
            'pelanggan',
            'details.produk'
        ])->findOrFail($id);

        return view('pesanan.cetak', compact('pesanan'));
    }
}