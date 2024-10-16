<?php

namespace App\Http\Controllers;

use App\Models\buku;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\StorebukuRequest;
use App\Http\Requests\UpdatebukuRequest;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('buku/index', [
            'bukus' => DB::table('bukus')->get()
        ]);
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
    public function edit($id)
    {
        $test = DB::table('bukus')->where('id', $id)->get();
        return view('buku/update', [
            'buku' => $test[0]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatebukuRequest $request, $id)
    {
        $ValidatedDate = $request->validate([
            'judul' => 'required',
            'penulisan' => 'required',
            'kategori' => 'required',
            'sampul' => 'image|file|max:2048',
        ]);

        if ($request->file('sampul')) {
            if ($request->sampulLama){
                Storage::delete($request->sampulLama);
            }
            $ValidatedDate['sampul'] = $request->file('sampul')->store('/sampul-buku');
        }
        Buku::where('id', $id)->update($ValidatedDate);
        return redirect('/buku');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $test = DB::table('bukus')->select('sampul')
            ->where('id', $id)
            ->get();
        if ($test[0]->sampul){
            Storage::delete($test[0]->sampul);
        }
        Buku::destroy($id);
        return redirect('/buku');
    }
}
