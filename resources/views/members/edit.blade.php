@extends('layouts.master')

@section('title','Edit Pelanggan')


@section('content')
 <div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Edit Pelanggan</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item"><a href="{{ url('member') }}">Pelanggan</a></li>
              <li class="breadcrumb-item active" aria-current="page">Edit Pelanggan</li>
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
              <h3 class="mb-0">Edit Pelanggan</h3>
            </div>
          </div>
        </div>

        <div class="card-body">
  
           <form action="{{ url('member', $members->id) }}" method="post">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
              <label for="name">Nama Pelanggan</label>
              <input
               type="text" 
               class="form-control {{ $errors->first('name')?'is-invalid':'' }}" 
               name="name" 
               required
               value="{{ $members->name }}" 
               placeholder="Masukan nama paket">
              <span class="text-danger">{{ $errors->first('name') }}</span>
            </div>

            <div class="form-group">
              <label for="gender">Jenis kelamin</label>
              <select name="gender" id="gender" class="form-control">
                <option value="" selected disabled>Pilih Jenis kelamin</option>
                <option value="Laki-laki" {{ $members->gender == 'Laki-laki'?'selected':'' }}>Laki-laki</option>
                <option value="Perempuan" {{ $members->gender == 'Perempuan'?'selected':'' }}>Perempuan</option>
              </select>
              <span class="text-danger">{{ $errors->first('gender') }}</span>
            </div>

            <div class="form-group">
              <label for="addres">Alamat </label>
              <textarea name="address" id="address" col="30" rows="2" class="form-control {{ $errors->first('address')?'is-invalid':'' }}" required  placeholder="Masukan alamat ">{{ $members->address }}</textarea>
              <span class="text-danger">{{ $errors->first('address') }}</span>
            </div>

            <div class="form-group">
              <label for="phone">No Tlpn</label>
              <input
               type="number" 
               name="phone"
               value="{{ $members->phone }}" 
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