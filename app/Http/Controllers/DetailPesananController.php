<?php

namespace App\Http\Controllers;

use App\Models\PesananDetail;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;

class DetailPesananController extends Controller
{
    public function index()
    {
        //$detailpesanan = PesananDetail::all();
        $detail = DetailPesanan::join('produks','detail_pesanans.produk_id','=','produks.id')
        ->join('pesanans','detail_pesanans.pesanan_id','=','pesanans.id')
        ->select(
            'detail_pesanans.*',
            'produks.nama_baju',
            'pesanans.id'
        )
        ->get();
        
        return view('detailpesanan.index', compact('detailpesanan'));
    }

    public function create()
    {
        $pesanan = Pesanan::all();
        $produk = Produk::all();

        return view('detailpesanan.create', compact(
            'pesanan',
            'produk'
        ));
    }

    public function store(Request $request)
    {
        PesananDetail::create($request->all());

        return redirect('/detailpesanan');
    }

    public function edit($id)
    {
        $detailpesanan = PesananDetail::findOrFail($id);

        $pesanan = Pesanan::all();

        $produk = Produk::all();

        return view('detailpesanan.edit', compact(
            'detailpesanan',
            'pesanan',
            'produk'
        ));
    }

    public function update(Request $request, $id)
    {
        $detailpesanan = PesananDetail::findOrFail($id);

        $detailpesanan->update($request->all());

        return redirect('/detailpesanan');
    }

    public function destroy($id)
    {
        $detailpesanan = PesananDetail::findOrFail($id);

        $detailpesanan->delete();

        return redirect('/detailpesanan');
    }
}