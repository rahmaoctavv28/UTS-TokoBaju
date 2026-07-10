<?php

namespace App\Http\Controllers;

use App\Models\admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $data = Admin::all();
        return view('admin.index', compact('data'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request){
        Admin::create($request->all());
        return redirect('/admin');       
    }

    public function show(admin $admin)
    {
        //
    }

    public function edit(admin $admin){
        return view('admin.edit', compact('admin'));
    }

    public function update(Request $request, admin $admin){
        $admin->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $request->password
        ]);

        return redirect('/admin');
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect('/admin');
    }
}
