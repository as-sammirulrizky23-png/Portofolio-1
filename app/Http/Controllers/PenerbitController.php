<?php

namespace App\Http\Controllers;

use App\Models\Penerbit;
use Illuminate\Http\Request;

class PenerbitController extends Controller
{
    public function index()
    {
        $allPenerbit = Penerbit::all();
        return view('penerbit.index', compact('allPenerbit'));
    }

    public function create()
    {
        return view('penerbit.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_penerbit' => 'required|max:100',
        ]);

        Penerbit::create($validatedData);

        return redirect()->route('penerbit.index')
                         ->with('success', 'Data penerbit berhasil ditambahkan');
    }

    public function show(Penerbit $penerbit)
    {
        return view('penerbit.show', compact('penerbit'));
    }

    public function edit(Penerbit $penerbit)
    {
        return view('penerbit.edit', compact('penerbit'));
    }

    public function update(Request $request, Penerbit $penerbit)
    {
        $validatedData = $request->validate([
            'nama_penerbit' => 'required|max:100',
        ]);

        $penerbit->update($validatedData);

        return redirect()->route('penerbit.index')
                         ->with('success', 'Data penerbit berhasil diperbarui');
    }

    public function destroy(Penerbit $penerbit)
    {
        $penerbit->delete();

        return redirect()->route('penerbit.index')
                         ->with('success', 'Data penerbit berhasil dihapus');
    }
}
