<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
        $produk = Produk::with('kategori')->get();

        return view('produk.index', compact('produk'));
    }

    public function create()
    {
        $kategori = Kategori::all();

        return view('produk.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $foto = null;
        if ($request->hasFile('upload_foto')) {
            $foto = $request->file('upload_foto')->store('produk', 'public');
        }
        Produk::create([
            'nama_baju' => $request->nama_baju,
            'harga' => $request->harga,
            'ukuran' => $request->ukuran,
            'stok' => $request->stok,
            'kategori_id' => $request->kategori_id,
            'upload_foto' => $foto,
            'deskripsi'   => $request->deskripsi,
        ]);

        return redirect('/produk');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $kategori = Kategori::all();

        return view('produk.edit', compact('produk', 'kategori'));
    }

    public function update(Request $request, $id)
    {
         $request->validate([
        'nama_baju'   => 'required',
        'harga'       => 'required|numeric',
        'ukuran'      => 'required',
        'stok'        => 'required|numeric',
        'kategori_id' => 'required',
        'upload_foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'deskripsi'   => 'nullable|string',
    ]);

    // Cari produk berdasarkan id
    $produk = Produk::findOrFail($id);

    // Jika upload foto baru
    if ($request->hasFile('upload_foto')) {
        $path = $request->file('upload_foto')->store('produk', 'public');
        $produk->upload_foto = $path;
    }

    // Update data
    $produk->nama_baju   = $request->nama_baju;
    $produk->harga       = $request->harga;
    $produk->ukuran      = $request->ukuran;
    // $produk->stok        = $request->stok;
    $produk->kategori_id = $request->kategori_id;

    $produk->save();

    return redirect()->route('produk.index')
                     ->with('success', 'Produk berhasil diupdate');
}
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        $produk->delete();

        return redirect('/produk');
    }

    public function show($id){
        $produk = Produk::with('kategori')->findOrFail($id);

        return view('produk.detail', compact('produk'));
    }
}