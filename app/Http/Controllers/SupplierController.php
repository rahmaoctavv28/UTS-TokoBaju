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

<<<<<<< HEAD
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
=======
    public function store(Request $request){
        $request->validate([
            'nama_supplier'=>'required',
            'no_hp'=>'required',
            'alamat'=>'required'

        ]);

        Supplier::create($request->all());

        return redirect()->route('supplier.index')
                ->with('success','Supplier berhasil ditambahkan');
>>>>>>> b98995d7adb5bb52dd11f4b3ee3f096fd2cc364e
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

<<<<<<< HEAD
        return redirect('/supplier')
            ->with('success', 'Data supplier berhasil diubah');
=======
        return redirect()->route('supplier.index')
                ->with('success','Supplier berhasil diupdate');
>>>>>>> b98995d7adb5bb52dd11f4b3ee3f096fd2cc364e
    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);

        $supplier->delete();

<<<<<<< HEAD
        return redirect('/supplier')
            ->with('success', 'Data supplier berhasil dihapus');
=======
        return redirect()->route('supplier.index')
                ->with('success','Supplier berhasil dihapus');
>>>>>>> b98995d7adb5bb52dd11f4b3ee3f096fd2cc364e
    }
}