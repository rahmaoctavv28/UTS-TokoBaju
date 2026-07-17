<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        return view('profil.index');
    }

    public function update(Request $request)
    {
        return redirect()
            ->route('profil.index')
            ->with('success','Profil berhasil diperbarui.');
    }
}