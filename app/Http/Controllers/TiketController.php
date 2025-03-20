<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use Illuminate\Http\Request;

class TiketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tiket = Tiket::all();
        return view('tiket.index', compact('tiket'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tiket.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'waktu' => 'required',
            'harga' => 'required',
            'lokasi' => 'required',
        ]);

        $proses = Tiket::create([
            'name' => $request->name,
            'waktu' => $request->waktu,
            'harga' => $request->harga,
            'lokasi' => $request->lokasi
        ]);

        if ($proses) {
            return redirect()->route('tiket.index')->with('success', 'Data Tiket Berhasil Ditambahkan');
        } else {
            return redirect()->route('tiket.index')->with('error', 'Data Tiket Gagal Ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tiket $tiket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tiket $tiket, $id )
    {
        $tiket = Tiket::where('id', $id)->first();
        return view('tiket.edit', compact('tiket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'waktu' => 'required',
            'harga' => 'required',
            'lokasi' => 'required',
        ]);

        $tiketBefore = Tiket::where('id', $id)->first();

        if (!$tiketBefore) {
            return redirect()->route('tiket.index')->with('error', 'Data Tiket Tidak Ditemukan');
        }

        $tiketBefore->update([
            'name' => $request->name,
            'waktu' => $request->waktu,
            'harga' => $request->harga,
            'lokasi' => $request->lokasi
        ]);

        return redirect()->route('tiket')->with('success', 'Data Tiket Berhasil Diubah');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tiket = Tiket::where('id', $id)->delete();
        if ($tiket) {
            return redirect()->back()->with('success', 'Data Tiket Berhasil Dihapus');
        } else {
            return redirect()->back()->with('error', 'Data Tiket Gagal Dihapus');
        }
    }
}
