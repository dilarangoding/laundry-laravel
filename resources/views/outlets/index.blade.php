@extends('layouts.master')

@section('title','Outlet')

@section('content')
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Outlet</h6>
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
              <h3 class="mb-0">Tambah Outlet</h3>
            </div>
          </div>
        </div>

        <div class="card-body">
         
        </div>

      </div>
    </div> --}}

    <div class="col-xl-12">
      <div class="card">

       <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">List Outlet</h3>
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
                <th scope="col">Nama</th>
                <th scope="col">Alamat</th>
                <th scope="col">No Tlpn</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
               @forelse ($outlets as $item)
               <tr>
                 <td>{{ $outlets->count() * ( $outlets->currentPage() - 1) + $loop->iteration }}</td>
                 <td>{{ $item->name }}</td>
                 <td>{{ $item->address }}</td>
                 <td>{{ $item->phone }}</td>
                 <td>
                   <a href="{{ url('outlet/edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                   <a href="#" outlet-id="{{ $item->id }}" class="btn btn-danger btn-sm delete">Hapus</a>
                 </td>
               </tr>   
               @empty
               <tr>
                 <td colspan="5" class="text-center">Tidak ada data</td>
               </tr>
               @endforelse
            </tbody>
          </table>
          <div class="float-right">
            {{ $outlets->links() }}
          </div>

        </div>

      </div>
    </div>

    
  </div>

</div>      

{{-- Modal tambah --}}
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
         <form action="{{ route('outlet.store') }}" method="post">
            @csrf

            <div class="form-group">
              <label for="name">Nama Outlet</label>
              <input
               type="text" 
               class="form-control {{ $errors->first('name')?'is-invalid':'' }}" 
               name="name" 
               required 
               placeholder="Masukan nama outlet">
              <span class="text-danger">{{ $errors->first('name') }}</span>
            </div>

            <div class="form-group">
              <label for="addres">Alamat Outlet</label>
              <textarea name="address" id="address" col="30" rows="2" class="form-control {{ $errors->first('address')?'is-invalid':'' }}"   placeholder="Masukan alamat outlet"></textarea>
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
         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>
{{-- End Modal Tambah --}}
@endsection
@section('js')

    <script>
      @if($errors->any())
       $('#exampleModal').modal('show');
      @endif

      $('.delete').on('click',function(){
			var id = $(this).attr('outlet-id');
			var url = '{{URL::to('outlet/delete')}}/' +id;
			Swal.fire({
				title: 'Yakin?',
				text: "Yakin ingin menghapus data outlet?",
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