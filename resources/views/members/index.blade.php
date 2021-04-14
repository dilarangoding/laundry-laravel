@extends('layouts.master')

@section('title','Pelanggan')

@section('content')
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Pelanggan</h6>
        </div>   
      </div>
    </div>
  </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">


  <div class="row">

    {{-- <div class="col-xl-4">

      <div class="card">

        <div class="card-header">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Tambah Pelanggan</h3>
            </div>
          </div>
        </div>

        <div class="card-body">
          <form action="{{ url('member') }}" method="post">
            @csrf
            
            <div class="form-group">
              <label for="name">Nama Pelanggan</label>
              <input
               type="text" 
               class="form-control {{ $errors->first('name')?'is-invalid':'' }}" 
               name="name" 
               required 
               placeholder="Masukan nama pelanggan">
              <span class="text-danger">{{ $errors->first('name') }}</span>
            </div>

            <div class="form-group">
              <label for="gender">Jenis kelamin</label>
              <select name="gender" id="gender" class="form-control">
                <option value="" selected disabled>Pilih Jenis kelamin</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
              <span class="text-danger">{{ $errors->first('gender') }}</span>
            </div>

            <div class="form-group">
              <label for="addres">Alamat </label>
              <textarea name="address" id="address" col="30" rows="2" class="form-control {{ $errors->first('address')?'is-invalid':'' }}" required  placeholder="Masukan alamat "></textarea>
              <span class="text-danger">{{ $errors->first('address') }}</span>
            </div>

            <div class="form-group">
              <label for="phone">No Tlpn</label>
              <input
               type="number" 
               name="phone" 
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
    </div> --}}

    <div class="col-xl-12">
      
      <div class="card">

        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">List Pelanggan</h3>
            </div>
            <div class="col">
              <button type="button" class="btn btn-primary float-right btn-sm" data-toggle="modal" data-target="#exampleModal">
                Tambah
              </button>
            </div>      
          </div>
        </div>

        <div class="table-responsive">

          <table class="table align-items-center table-flush text-center">
            <thead class="thead-light">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Pelanggan</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Alamat</th>
                <th scope="col">No Tlpn</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($members as $member)
               <tr>
                 <td>{{ $members->count() * ($members->currentPage() - 1) + $loop->iteration }}</td>
                 <td>{{ $member->name }}</td>
                 <td>{{ $member->gender }}</td>
                 <td>{{ $member->address }}</td>
                 <td>{{ $member->phone }}</td>
                 <td>
                   <a href="{{ url('member/edit', $member->id) }}" class="btn btn-warning btn-sm">Edit</a>
                   <a href="#" member-id="{{ $member->id }}" class="btn btn-danger btn-sm delete">Hapus</a>
                 </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <div class="float-right">
            {{ $members->links() }}
          </div>
        </div>

      </div>

    </div>

    
  </div>

</div>


{{-- Modal Tambah --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Outlet</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ url('member') }}" method="post">
            @csrf
            
            <div class="form-group">
              <label for="name">Nama Pelanggan</label>
              <input
               type="text" 
               class="form-control {{ $errors->first('name')?'is-invalid':'' }}" 
               name="name" 
               required 
               placeholder="Masukan nama pelanggan">
              <span class="text-danger">{{ $errors->first('name') }}</span>
            </div>

            <div class="form-group">
              <label for="gender">Jenis kelamin</label>
              <select name="gender" id="gender" class="form-control">
                <option value="" selected disabled>Pilih Jenis kelamin</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
              <span class="text-danger">{{ $errors->first('gender') }}</span>
            </div>

            <div class="form-group">
              <label for="addres">Alamat </label>
              <textarea name="address" id="address" col="30" rows="2" class="form-control {{ $errors->first('address')?'is-invalid':'' }}" required  placeholder="Masukan alamat "></textarea>
              <span class="text-danger">{{ $errors->first('address') }}</span>
            </div>

            <div class="form-group">
              <label for="phone">No Tlpn</label>
              <input
               type="number" 
               name="phone" 
               class="form-control {{ $errors->first('phone')?'is-invalid':'' }}" 
               placeholder="Masukan no tlpn" 
               required>
               <span class="text-danger">{{ $errors->first('phone') }}</span>
            </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>

{{-- end Modal --}}
@endsection
@section('js')
    <script>

      @if($errors->any())
       $('#exampleModal').modal('show');
      @endif

      $('.delete').on('click',function(){
			var id = $(this).attr('member-id');
      console.log(id);
			var url = '{{URL::to('member/delete')}}/' +id;
			Swal.fire({
				title: 'Yakin?',
				text: "Yakin ingin menghapus data member?",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Hapus'
			}).then((result) => {
				if (result.value) {
					window.location = url;
				}
			})
		});
    </script>
@endsection