@extends('frontend.index')
@section('front')
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
<form>
  <div class="form-group row">
    <label for="select" class="col-4 col-form-label">Select</label> 
    <div class="col-8">
      <select id="select" name="select" class="custom-select">
        <option value="rabbit">Rabbit</option>
        <option value="duck">Duck</option>
        <option value="fish">Fish</option>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="select1" class="col-4 col-form-label">Select</label> 
    <div class="col-8">
      <select id="select1" name="select1" class="custom-select">
        <option value="rabbit">Rabbit</option>
        <option value="duck">Duck</option>
        <option value="fish">Fish</option>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="textarea" class="col-4 col-form-label">Text Area</label> 
    <div class="col-8">
      <textarea id="textarea" name="textarea" cols="40" rows="5" class="form-control"></textarea>
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
@endsection