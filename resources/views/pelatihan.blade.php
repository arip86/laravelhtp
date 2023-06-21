@extends('frontend.index')
@section('front')
@if(Auth::user()->role != 'pengunjung')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Pelatihan</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="single-product.html">Pelatihan</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section >
        <div class="container">
   
<h1 align="center">Isi Form Pendaftaran</h1>
<form action="{{url('pelatihan-store')}}" method="POST" enctype="multipart/form-data">
  {{csrf_field()}}
  <div class="form-group row">
    <label for="select" class="col-4 col-form-label">Pegawai</label> 
    <div class="col-8">
      <select id="select" name="pegawai_id" class="custom-select">
        <option value="rabbit">pilih nama pegawai</option>
        @foreach ($pegawai as $peg)
        <option value="{{$peg->id}}">{{$peg->nama}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="select1" class="col-4 col-form-label">Materi</label> 
    <div class="col-8">
      <select id="select1" name="materi_id" class="custom-select">
        <option value="rabbit">Pilih Materi</option>
       @foreach ($materi as $mat)
        <option value="{{$mat->id}}">{{$mat->nama}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="textarea" class="col-4 col-form-label">Keterangan</label> 
    <div class="col-8">
      <textarea id="textarea" name="keterangan" cols="40" rows="5" class="form-control"></textarea>
    </div>
  </div> 
  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="submit" type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>
</div>
</section>
@else 
@include('acces_denied3')
@endif
@endsection