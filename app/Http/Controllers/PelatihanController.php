<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Pelatihan;
use DB;
use App\Models\Materi;
class PelatihanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $pegawai = DB::table('pegawai')->get();
        $materi = DB::table('materi')->get();
        $pelatihan = Pelatihan::join('pegawai', 'pegawai.id', '=', 'pelatihan.pegawai_id')
        ->join('materi', 'materi.id', '=', 'pelatihan.materi_id')
        ->select('pegawai.nama as pegawai', 'materi.nama as materi', 'keterangan')
        ->get();

        return view ('pelatihan', compact('pelatihan', 'pegawai', 'materi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //isi datanya 
        DB::table('pelatihan')->insert([
            'pegawai_id' => $request->pegawai_id,
            'materi_id' => $request->materi_id,
            'keterangan' => $request->keterangan,
        ]);

        return redirect('/');
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
