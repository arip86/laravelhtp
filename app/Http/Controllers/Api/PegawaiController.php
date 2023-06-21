<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Http\Resources\PegawaiResource;
use DB;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    //
    public function index(){
        $pegawai = Pegawai::join('jabatan', 'jabatan.id', '=', 'pegawai.jabatan_id')
        ->join('divisi', 'divisi.id', '=', 'pegawai.divisi_id')
        ->select('pegawai.*', 'divisi.nama as divisi', 'jabatan.nama as jabatan')
        ->get();

        return new PegawaiResource(true, 'Data Pegawai', $pegawai);
    }
    public function show($id){
        $pegawai = Pegawai::join('divisi', 'pegawai.divisi_id', '=', 'divisi.id')
        ->join('jabatan','pegawai.jabatan_id', '=', 'jabatan.id')
        ->select('pegawai.*', 'divisi.nama as divisi', 'jabatan.nama as jabatan')
        ->where('pegawai.id', $id)
        ->get();
       return new PegawaiResource(true, 'Detail Pegawai', $pegawai);
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'nip' => 'required|unique:pegawai|max:5',
            'nama' => 'required|max:45',
            'jabatan_id' => 'required',
            'divisi_id' => 'required',
            'gender' => 'required',
            'tmp_lahir' => 'required',
            'tgl_lahir' => 'required',
            'kekayaan' => 'required',
            'alamat' => 'nullable|string|min:10',
            
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 442);
        }
        $pegawai = Pegawai::create([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'jabatan_id' => $request->jabatan_id,
            'divisi_id' => $request->divisi_id,
            'gender' => $request->gender,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'kekayaan' => $request->kekayaan,
            'alamat' => $request->alamat

        ]);
        return new PegawaiResource(true, 'Data Pegawai berhasil diinput', $pegawai);

    }
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'nip' => 'required|max:5',
            'nama' => 'required|max:45',
            'jabatan_id' => 'required',
            'divisi_id' => 'required',
            'gender' => 'required',
            'tmp_lahir' => 'required',
            'tgl_lahir' => 'required',
            'kekayaan' => 'required',
            'alamat' => 'nullable|string|min:10',
            
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 442);
        }
        $pegawai = Pegawai::whereId($id)->update([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'jabatan_id' => $request->jabatan_id,
            'divisi_id' => $request->divisi_id,
            'gender' => $request->gender,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'kekayaan' => $request->kekayaan,
            'alamat' => $request->alamat
        ]);
        return new PegawaiResource(true, 'Data Pegawai Berhasil diubah', $pegawai);
    }
    public function destroy($id){
        $pegawai = Pegawai::whereId($id)->first();
        $pegawai->delete();
        return new PegawaiResource(true, 'Data Pegawai Berhasil dihapus', $pegawai);
    }
}
