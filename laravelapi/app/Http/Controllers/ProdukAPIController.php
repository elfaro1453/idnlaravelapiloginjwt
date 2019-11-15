<?php

namespace App\Http\Controllers;

use Auth;
use App\Produk;
use Illuminate\Http\Request;

class ProdukAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Produk::all();
        
        return response()->json([
            'type' => 'index',
            'status' => 'success',
            'data' => $produk
        ], 200);
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
        
        return response()->json([
            'type' => 'store',
            'status' => 'success',
            'data' => $produk
        ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        return response()->json([
            'type' => 'show',
            'status' => 'success',
            'data' => $produk
        ], 200);
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

        return response()->json([
            'type' => 'update',
            'status' => 'success',
            'data' => $produk
        ], 200);
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

        $produkall = Produk::all();
        
        return response()->json([
            'type' => 'destroy',
            'status' => 'success',
            'data' => $produkall
        ], 200);
    }
}
