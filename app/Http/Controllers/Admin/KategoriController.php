<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoris = Kategori::paginate(10);
        return view('pages.admin.kategori.index', ['kategoris' => $kategoris]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::get();
        return view('pages.admin.kategori.create', ['kategoris' => $kategoris]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required',
            'foto_kategori' => 'required|image|max:4096',
        ]);

        if ($request->hasFile('foto_kategori')) {
            $file = $request->file('foto_kategori');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/kategori'), $filename);
        } else {
            $filename = null;
        }

        Kategori::create([
            'kategori' => $request->kategori,
            'foto_kategori' => $filename,
        ]);

        return redirect()->route('kategori.index')->with('succes', 'Data kategori berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
