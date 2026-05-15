<?php

namespace App\Http\Controllers;

use App\Models\StokHistory;
use Illuminate\Http\Request;

class StokController extends Controller
{
    public function index()
    {
        $stok = StokHistory::all();

        return view('stok.index', compact('stok'));
    }

    public function create()
    {
        return view('stok.create');
    }

    public function store(Request $request)
    {
        StokHistory::create($request->all());

        return redirect('/stok');
    }

    public function edit($id)
    {
        $stok = StokHistory::findOrFail($id);

        return view('stok.edit', compact('stok'));
    }

    public function update(Request $request, $id)
    {
        $stok = StokHistory::findOrFail($id);

        $stok->update($request->all());

        return redirect('/stok');
    }

    public function destroy($id)
    {
        $stok = StokHistory::findOrFail($id);

        $stok->delete();

        return redirect('/stok');
    }
}