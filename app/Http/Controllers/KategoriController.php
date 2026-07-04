<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::withCount('produk')->get();

        return view('kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
         $request->validate([
            'nama_kategori' => 'required',
            'deskripsi' => 'nullable'
        ]);

        Kategori::create($request->all());

        return redirect()->route('kategori.index')
                ->with('success','Kategori berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);

        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
       $request->validate([
        'nama_kategori'=>'required'
    ]);

    $kategori = Kategori::findOrFail($id);

    $kategori->update([
        'nama_kategori'=>$request->nama_kategori,
        'deskripsi'=>$request->deskripsi

    ]);

    return redirect()->route('kategori.index')
            ->with('success','Kategori berhasil diupdate');
    }

    public function destroy($id)
    {
       $kategori = Kategori::findOrFail($id);

        $kategori->delete();

        return redirect()->route('kategori.index')
                ->with('success','Kategori berhasil dihapus');
    }
}