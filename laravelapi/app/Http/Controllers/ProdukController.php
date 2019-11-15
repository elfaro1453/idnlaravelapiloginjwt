<?php

namespace App\Http\Controllers;

use App\Produk;
use Illuminate\Http\Request;
use Auth;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Produk::all();
        $user = Auth::user();
        return view('produk.index')
        ->with('produk', $produk)
        ->with('user', $user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produk.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usersaatini = Auth::user();

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|integer',
        ]);

        if ($usersaatini->role == 1) {
        $produk = new Produk;
        $produk->nama = $validatedData['nama'];
        $produk->harga = $validatedData['harga'];
        $produk->save();
        }
        
        return redirect()->route('produk.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        return view('produk.show')->with('produk', $produk);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $produk)
    {
        return view('produk.edit')->with('produk', $produk);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $produk)
    {
        $usersaatini = Auth::user();

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|integer',
        ]);

        if ($usersaatini->role == 1) {
        $produk->nama = $validatedData['nama'];
        $produk->harga = $validatedData['harga'];
        $produk->save();
        }
        
        return redirect()->route('produk.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        $usersaatini = Auth::user();

        if ($usersaatini->role == 1) {
            $produk->delete();
        }
        return redirect()->route('produk.index');
    }
}
