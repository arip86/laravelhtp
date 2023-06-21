@extends('admin.layout.appadmin')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
                        <h1 class="mt-4">Tables</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Tables</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
                                <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
                                .
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <!-- <i class="fas fa-table me-1"></i>
                                DataTable Example -->
                                <!-- membuat tombol mengarahkan ke file produk_form.php -->
                               
                                <a href="#" class="btn btn-primary btn-sm"> Tambah</a>
                                
                            </div>
                            

                            <div class="card-body">
                                <table id="example" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pegawai</th>
                                            <th>Pilihan Materi</th>
                                            <th>Keterangan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pegawai</th>
                                            <th>Pilihan Materi</th>
                                            <th>Keterangan</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <!-- hapus dari baris 64 sampai 511 -->
                                        <!-- dari <tr> ke </tr> -->
                                        @php
                                        $no = 1;
                                        @endphp
                                        @foreach($pelatihan as $p)
                                        <tr>
                                            <td>{{$no}}</td>
                                            <td>{{$p->pegawai}}</td>
                                            <td>{{$p->materi}}</td>
                                            <td>{{$p->keterangan}}</td>
                                            <td>
                                                <form action="#" method="POST">
                                                  
                                        <a class="btn btn-info btn-sm" href="#">Detail</a>
                                                
                                                
                                        <a class="btn btn-warning btn-sm" href="#">Ubah</a>
                                                    
                <!-- <button type="submit" class="btn btn-danger btn-sm" name="proses" value="hapus" 
                                    onclick="return confirm('Anda yakin akan dihapus?')">Hapus</button> -->
        <!-- Button trigger modal -->
<button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Hapus
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah anda yakin akan menghapus data ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a class="btn btn-danger" href="#">Hapus</a>
      </div>
    </div>
  </div>
</div>

                                                    

                                                    
                                                </form>
                                            </td>
                                        </tr>
                                        @php 
                                        $no++

                                        @endphp
                                        @endforeach
                                      
                                    </tbody>
                                </table>
                            </div>

</div>
</div>

@endsection


               