@extends('layouts.master')

@section('title','Edit Paket')

@section('content')
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Edit Paket</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item"><a href="{{ url('package') }}">Paket</a></li>
              <li class="breadcrumb-item active" aria-current="page">Edit Paket</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div> 

<div class="container-fluid mt--6">
  <div class="row justify-content-center">
     <div class="col-xl-6">

      <div class="card">

        <div class="card-header">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Edit Paket</h3>
            </div>
          </div>
        </div>

        <div class="card-body">
          
          <form action="{{ url('package', $packages->id) }}" method="post">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
              <label for="name">Nama Paket</label>
              <input
               type="text" 
               class="form-control {{ $errors->first('name')?'is-invalid':'' }}" 
               name="name" 
               value="{{ $packages->name }}"
               required 
               placeholder="Masukan nama paket">
              <span class="text-danger">{{ $errors->first('name') }}</span>
            </div>

           <div class="form-group">
              <label for="type">Tipe Paket</label>
               <select name="type" id="type" class="form-control {{ $errors->first('type')?'is-invalid':'' }}">
                  <option value="" selected disabled>Pilih Tipe Paket</option>
                  <option value="Kiloan" {{ $packages->type == 'Kiloan'?'selected':'' }}>Kiloan</option>
                  <option value="Selimut" {{ $packages->type == 'Selimut'?'selected':'' }}>Selimut</option>
                  <option value="Bed Cover" {{ $packages->type == 'Bed Cover'?'selected':'' }}>Bed Cover</option>
                  <option value="Kaos" {{ $packages->type == 'Kaos'?'selected':'' }}>Kaos</option>
                  <option value="Lain" {{ $packages->type == 'Lain'?'selected':'' }}>Lain</option>
               </select>
              <span class="text-danger">{{ $errors->first('type') }}</span>
            </div>

            <div class="form-group">
              <label for="price">Harga</label>
              <input
               type="number" 
               name="price"
               value="{{ $packages->price }}" 
               class="form-control {{ $errors->first('price')?'is-invalid':'' }}" 
               placeholder="Masukan harga" 
               required>
               <span class="text-danger">{{ $errors->first('price') }}</span>
            </div>

            <div class="form-group">
              <label for="outlet_id">Outlet</label>
               <select name="outlet_id" id="outlet_id" class="form-control {{ $errors->first('outlet_id')?'is-invalid':'' }}">
                  <option value="" selected disabled>Pilih Outlet</option>
                  @foreach ($outlets as $outlet)
                  <option value="{{ $outlet->id }}" {{ $packages->outlet_id == $outlet->id?'selected':'' }}>{{ $outlet->name }}</option>
                  @endforeach
               </select>
              <span class="text-danger">{{ $errors->first('outlet_id') }}</span>
            </div>

            <div class="form-group">
              <button class="btn btn-primary btn-block">Simpan</button>
            </div>

          </form>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection