@extends('layouts.master')

@section('title','Edit user')

@section('content')
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0"></h6>
        </div>  
      </div>
    </div>
  </div>
</div>

<div class="container-fluid mt--7">
  <div class="row justify-content-center">
    <div class="col-xl-6">
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Edit User</h3>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form action="{{ url('user', $user->id) }}" method="post">
            @csrf

            <input type="hidden" value="PUT" name="_method" >
            <div class="form-group">
              <label for="name">Nama</label>
              <input
                type="text" 
                class="form-control @error('name') is-invalid @enderror" 
                name="name"
                value="{{ $user->name }}"
                
                placeholder="Masukan nama user">
                <span class="text-danger">{{ $errors->first('name') }}</span>
            </div>

            <div class="form-group">
              <label for="email">Email</label>
              <input
                type="email"
                class="form-control @error('email') is-invalid @enderror"
                name="email"
                disabled
                value="{{ $user->email }}"
                placeholder="Masukan email user">
                 <span class="text-danger">{{ $errors->first('email') }}</span>
            </div>

            <div class="form-group">
              <label for="password">Password <sup class="text-danger">*Kosongkan jika tidak ingin mengubah password</sup></label>
              <input
                type="password"
                class="form-control @error('password') is-invalid @enderror"
                name="password"
                placeholder="Masukan password user">
                <span class="text-danger">{{ $errors->first('password') }}</span>
            </div>


             <div class="form-group">
              <label for="role">Level</label>
              <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                <option disabled selected>Pilih level</option>
                <option value="admin" {{ $user->role == 'admin'?'selected':'' }}>Admin</option>
                <option value="kasir" {{ $user->role == 'kasir'?'selected':'' }}>Kasir</option>
                <option value="owner" {{ $user->role == 'owner'?'selected':'' }}>Owner</option>
              </select>
               <span class="text-danger">{{ $errors->first('role') }}</span>
            </div>


            <div class="form-group">
              <label for="outlet">Outlet</label>
              <select name="outlet_id"  {{ $user->role != 'kasir' ?'disabled' :'' }}  id="outlet" class="form-control @error('outlet_id') is-invalid @enderror">
                <option disabled selected >Pilih outlet</option>
                @foreach ($outlets as $outlet)
                <option value="{{ $outlet->id }}" {{ $user->outlet_id == $outlet->id?'selected':'' }}>
                  {{ $outlet->name }}</option>    
                @endforeach
              </select>
              <span class="text-danger span" hidden>Tidak wajib dipilih</span>
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

@section('js')
    
  <script>

    $('#role').on('change',function() {
         
          let role = $('#role').val();
          
          if(role == 'admin' || role == 'owner'){
              $('#outlet').prop('disabled', true);
              $('#outlet').append('<option value="">Pilih Outlet</option>')
              $('#outlet').val('');
              $('.span').prop('hidden', false);
          }else{
               $('#outlet').prop('disabled', false);
                $('.span').prop('hidden', true);
          }
        
      });

  </script>

@endsection
