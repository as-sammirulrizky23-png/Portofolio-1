<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Penerbit;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allBuku = Buku::with(['kategori', 'penerbit'])->get();
        return view('buku.index', compact('allBuku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all();
        $penerbit = Penerbit::all();

        return view('buku.create', compact('kategori', 'penerbit'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul'         => 'required|max:255',
            'pengarang'     => 'required|max:100',
            'tahun_terbit'  => 'required|digits:4',
            'kategori_id'   => 'required|exists:kategoris,id',
            'penerbit_id'   => 'required|exists:penerbits,id',
        ]);

        Buku::create($validatedData);

        return redirect()->route('buku.index')
                         ->with('success', 'Data buku berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Buku $buku)
    {
        return view('buku.show', compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buku $buku)
    {
        $kategori = Kategori::all();
        $penerbit = Penerbit::all();

        return view('buku.edit', compact('buku', 'kategori', 'penerbit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Buku $buku)
    {
        $validatedData = $request->validate([
            'judul'         => 'required|max:255',
            'pengarang'     => 'required|max:100',
            'tahun_terbit'  => 'required|digits:4',
            'kategori_id'   => 'required|exists:kategoris,id',
            'penerbit_id'   => 'required|exists:penerbits,id',
        ]);

        $buku->update($validatedData);

        return redirect()->route('buku.index')
                         ->with('success', 'Data buku berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buku $buku)
    {
        $buku->delete();

        return redirect()->route('buku.index')
                         ->with('success', 'Data buku berhasil dihapus');
    }
}
