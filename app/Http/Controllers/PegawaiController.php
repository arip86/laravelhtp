<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Divisi;
use App\Models\Jabatan;
use DB;
use PDF;
use App\Exports\PegawaiExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PegawaiImport;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //arahkan ke view
        $pegawai = Pegawai::join('divisi','pegawai.divisi_id', '=', 'divisi.id')
        ->join('jabatan','pegawai.jabatan_id', '=', 'jabatan.id')
        ->select('pegawai.*', 'divisi.nama as divisi', 'jabatan.nama as jabatan')
        ->get();
        return view ('admin.pegawai.index', compact('pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //arahkan ke folder pegawai
        $divisi = DB::table('divisi')->get();
        $jabatan = DB::table('jabatan')->get();
        $pegawai = Pegawai::join('divisi','pegawai.divisi_id', '=', 'divisi.id')
        ->join('jabatan','pegawai.jabatan_id', '=', 'jabatan.id')
        ->select('pegawai.*', 'divisi.nama as divisi', 'jabatan.nama as jabatan')
        ->get();
        return view ('admin.pegawai.create', compact('pegawai', 'divisi', 'jabatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:pegawai|max:5',
            'nama' => 'required|max:45',
            'jabatan_id' => 'required|integer',
            'divisi_id' => 'required|integer',
            'gender' => 'required',
            'tmp_lahir' => 'required',
            'tgl_lahir' => 'required',
            'kekayaan' => 'required',
            'alamat' => 'nullable|string|min:10',
            'foto' => 'nullable|image|mimes:jpg,jpeg,gif,svg|max:2048',
        ],
        [
            'nip.required' => 'NIP Wajib Disii',
            'nip.unique' => 'NIP sudah ada, masukan NIP yang lain',
            'nip.max' => 'NIP maksimal 5 karakter',
            'nama.required' => 'Nama wajib diisi',
            'nama.max' => 'Nama maksimal 45 karakter',
            'jabatan_id.required' => 'jabatan wajib disii',
            'divisi_id.required' => 'Divisi Wajib disii',
            'tmp_lahir.required' => 'Tempat lahir wajib diisi',
            'tgl_lahir.required' => 'Tanggal lahir wajib diisi',
            'kekayaan.required' => 'Kekayaan wajib diisi',
            'gender.required' => 'Jenis kelamin wajib diisi', 
        ]
    
    );
        //sintaks untuk menambahkan foto 
        if(!empty($request->foto)){
            $fileName = 'foto-'.$request->id.'.'.$request->foto->extension();
            $request->foto->move(public_path('admin/image'), $fileName);
        }
        else {
            $fileName = '';
        }
        //fungsi untuk menambahkan pegawai
        DB::table('pegawai')->insert([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'jabatan_id' => $request->jabatan_id,
            'divisi_id' => $request->divisi_id,
            'gender' => $request->gender,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'kekayaan' => $request->kekayaan,
            'alamat' => $request->alamat,
            'foto' => $fileName,
        ]);
        return redirect('admin/pegawai');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $pegawai = Pegawai::join('divisi', 'pegawai.divisi_id', '=', 'divisi.id')
        ->join('jabatan','pegawai.jabatan_id', '=', 'jabatan.id')
        ->select('pegawai.*', 'divisi.nama as divisi', 'jabatan.nama as jabatan')
        ->where('pegawai.id', $id)
        ->get();
        return view ('admin.pegawai.detail', compact('pegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        //ini akan diarahkan ke file edit yang ada di view
        //menggunakan query builder
        $divisi = DB::table('divisi')->get();
        $jabatan = DB::table('jabatan')->get();
        $pegawai = DB::table('pegawai')->where('id', $id)->get();
        $ar_gender = ['L', 'P'];

        return view ('admin.pegawai.edit', compact('pegawai', 'divisi', 'jabatan', 'ar_gender'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            
            'nama' => 'required|max:45',
            'jabatan_id' => 'required|integer',
            'divisi_id' => 'required|integer',
            'gender' => 'required',
            'tmp_lahir' => 'required',
            'tgl_lahir' => 'required',
            'kekayaan' => 'required',
            'alamat' => 'nullable|string|min:10',
            'foto' => 'nullable|image|mimes:jpg,jpeg,gif,svg|max:2048',
        ]);
        //foto lama apabila user mengganti fotonya 
        $foto = DB::table('pegawai')->select('foto')->where('id', $request->id)->get();
        foreach($foto as $f){
            $namaFileFotoLama = $f->foto;
        }
        //apakah user ingin ganti foto lama 
        if (!empty($request->foto)){
// jika ada foto lama makan hapus dulu fotonya 
        if(!empty($p->foto)) unlink('admin/image/'.$p->foto);
//proses ganti foto
            $fileName = 'foto-'.$request->id.'.'.$request->foto->extension();
            $request->foto->move(public_path('admin/image'), $fileName);
        }
        else {
            $fileName = $namaFileFotoLama;
        }
        DB::table('pegawai')->where('id', $request->id)->update([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'jabatan_id' => $request->jabatan_id,
            'divisi_id' => $request->divisi_id,
            'gender' => $request->gender,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'kekayaan' => $request->kekayaan,
            'alamat' => $request->alamat,
            'foto' => $fileName,
        ]);
        return redirect('admin/pegawai');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //menambahkan tombol hapus pada pegawai
        DB::table('pegawai')->where('id', $id)->delete();
        return redirect('admin/pegawai');
    }
    //ini adalah fungsi percontohan untuk export pdf
    public function generatePDF(){
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y')
        ];
          
        $pdf = PDF::loadView('admin.pegawai.myPDF', $data);
    
        return $pdf->download('testdownload.pdf');
    }
    public function pegawaiPDF(){
        $pegawai = Pegawai::all();
        
        $pdf = PDF::loadView('admin.pegawai.pegawaiPDF', ['pegawai' => $pegawai])->setPaper('a4', 'landscape');
        // return $pdf->download('data_pegawai.pdf');
        return $pdf->stream();
    }
    public function exportExcel(){
        return Excel::download(new PegawaiExport, 'pegawai.xlsx');
    }
    public function importExcel(Request $request){
        $file = $request->file('file');
        $nama_file = rand().$file->getClientOriginalName();
        $file->move('file_excel', $nama_file);
        Excel::import(new PegawaiImport, public_path('/file_excel/'.$nama_file));
        return redirect('admin/pegawai');
    }
    public function apiPegawai(){
        $pegawai = Pegawai::all();
        return response()->json(
            [
                'success'=>true,
                'message'=> 'Data Pegawai',
                'data'=>$pegawai
            ], 200
        );
    }
    public function apiPegawaiDetail($id){
        $pegawai = Pegawai::join('divisi', 'pegawai.divisi_id', '=', 'divisi.id')
        ->join('jabatan','pegawai.jabatan_id', '=', 'jabatan.id')
        ->select('pegawai.*', 'divisi.nama as divisi', 'jabatan.nama as jabatan')
        ->where('pegawai.id', $id)
        ->get();
        if($pegawai){
            return response()->json([
                'success'=>true,
                'message'=> 'Detail Pegawai ',
                'data'=>$pegawai,
            ], 200);
        }
        else {
            return response()->json([
                'success'=>false,
                'message'=>'Detail pegawai tidak dikenali'

            ], 404);
        }
    }
}
