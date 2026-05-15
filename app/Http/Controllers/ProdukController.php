<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::all();

        return view('produk.index', compact('produk'));
    }

    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request)
    {
        Produk::create([
            'nama_baju' => $request->nama_baju,
            'ukuran' => $request->ukuran,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);

        return redirect('/produk');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);

        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $produk->update([
            'nama_baju' => $request->nama_baju,
            'ukuran' => $request->ukuran,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);

        return redirect('/produk');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        $produk->delete();

        return redirect('/produk');
    }
}