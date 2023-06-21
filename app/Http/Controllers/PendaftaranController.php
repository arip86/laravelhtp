<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Materi;
use App\Models\Pelatihan;
use DB;

class PendaftaranController extends Controller
{
    //
    public function index(){
        $pegawai = DB::table('pegawai')->get();
        $materi = DB::table('materi')->get();
        $pelatihan = Pelatihan::join('pegawai', 'pegawai.id', '=', 'pelatihan.pegawai_id')
        ->join('materi', 'materi.id', '=', 'pelatihan.materi_id')
        ->select('pegawai.nama as pegawai', 'materi.nama as materi', 'keterangan')
        ->get();

        return view ('admin.pendaftaran.index', compact('pelatihan', 'pegawai', 'materi'));

    }
}
