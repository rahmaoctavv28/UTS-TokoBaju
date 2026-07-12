<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $supplier = Supplier::all();

        return view('supplier.index', compact('supplier'));
    }

    public function create()
    {
        return view('supplier.create');
    }

    public function store(Request $request)
    {
        Supplier::create([
            'nama_supplier' => $request->nama_supplier,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
        ]);

         return redirect('/supplier')
            ->with('success', 'Data supplier berhasil ditambahkan');
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);

        return view('supplier.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);

        $supplier->update([
            'nama_supplier' => $request->nama_supplier,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
        ]);

        return redirect('/supplier')
            ->with('success', 'Data supplier berhasil diubah');
        return redirect()->route('supplier.index')
                ->with('success','Supplier berhasil diupdate');

    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);

        $supplier->delete();


        return redirect('/supplier')
            ->with('success', 'Data supplier berhasil dihapus');
        return redirect()->route('supplier.index')
                ->with('success','Supplier berhasil dihapus');
    }
}