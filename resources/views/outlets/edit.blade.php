@extends('layouts.master')

@section('title','Edit Outlet')

@section('content')
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Edit Outlet</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item"><a href="{{ url('outlet') }}">Outlet</a></li>
              <li class="breadcrumb-item active" aria-current="page">Edit Outlet</li>
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
              <h3 class="mb-0">Edit Outlet</h3>
            </div>
          </div>
        </div>

        <div class="card-body">
          <form action="{{ url('outlet/update', $outlet->id) }}" method="post">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
              <label for="name">Nama Outlet</label>
              <input
               type="text" 
               class="form-control {{ $errors->first('name')?'is-invalid':'' }}" 
               name="name" 
               value="{{ $outlet->name }}"
               required 
               placeholder="Masukan nama outlet">
              <span class="text-danger">{{ $errors->first('name') }}</span>
            </div>

            <div class="form-group">
              <label for="addres">Alamat Outlet</label>
              <textarea name="address" id="address" col="30" rows="2" class="form-control {{ $errors->first('address')?'is-invalid':'' }}" required  placeholder="Masukan alamat outlet">{{ $outlet->address }}</textarea>
              <span class="text-danger">{{ $errors->first('address') }}</span>
            </div>

            <div class="form-group">
              <label for="phone">No Tlpn</label>
              <input
               type="number" 
               name="phone"
               value="{{ $outlet->phone }}" 
               class="form-control {{ $errors->first('phone')?'is-invalid':'' }}" 
               placeholder="Masukan no tlpn" 
               required>
               <span class="text-danger">{{ $errors->first('phone') }}</span>
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