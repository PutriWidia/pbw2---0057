<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Http\Requests\StorebukuRequest;
use App\Http\Requests\UpdatebukuRequest;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('buku/index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buku/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorebukuRequest $request)
    {
        $ValidatedDate = $request->validate([

            'judul' => 'required',
            'penulisan' => 'required',
            'kategori' => 'required',
            'sampul' => 'required|image|file|max:2048',
        ]);

        if ($request->file('sampul')){
            $ValidatedDate['sampul'] = $request->file('sampul')->store('/sampul-buku');
        }
        buku::create($ValidatedDate);
        return redirect('/buku');
    }

    /**
     * Display the specified resource.
     */
    public function show(buku $buku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(buku $buku)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatebukuRequest $request, buku $buku)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(buku $buku)
    {
        //
    }
}
