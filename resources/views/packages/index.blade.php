@extends('layouts.master')

@section('title','Paket')

@section('content')
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Paket</h6>
        </div>  
      </div>
    </div>
  </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">


  <div class="row">
    <div class="col-xl-12">
      <div class="card">

        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">List Paket</h3>
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
                <th scope="col">Nama Paket</th>
                <th scope="col">Tipe </th>
                <th scope="col">Harga </th>
                <th scope="col">Outlet</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($packages as $item)
                  <tr>

                    <td>{{ $packages->count() * ($packages->currentPage() - 1) + $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->type }}</td>
                    <td>Rp {{ number_format($item->price) }}</td>
                    <td>{{ $item->outlet->name }}</td>
                    <td>
                      <a href="{{ url('package/edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                      <a href="#" package-id="{{ $item->id }}" class="btn btn-danger btn-sm delete">Hapus</a>
                    </td>
                  </tr>
              @empty
                  <tr>
                    <td colspan="6" class="text-center">Tidak ada data</td>
                  </tr>
              @endforelse
            </tbody>
          </table>
          <div class="float-right">
            {{ $packages->links() }}
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Paket</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ url('package') }}" method="post">
            @csrf
            
            <div class="form-group">
              <label for="name">Nama Paket</label>
              <input
               type="text" 
               class="form-control {{ $errors->first('name')?'is-invalid':'' }}" 
               name="name" 
               required 
               placeholder="Masukan nama paket">
              <span class="text-danger">{{ $errors->first('name') }}</span>
            </div>

            <div class="form-group">
              <label for="type">Tipe Paket</label>
               <select name="type" id="type" class="form-control {{ $errors->first('type')?'is-invalid':'' }}">
                  <option value="" selected disabled>Pilih Tipe Paket</option>
                  <option value="Kiloan">Kiloan</option>
                  <option value="Selimut">Selimut</option>
                  <option value="Bed Cover">Bed Cover</option>
                  <option value="Kaos">Kaos</option>
                  <option value="Lain">Lain</option>
               </select>
              <span class="text-danger">{{ $errors->first('type') }}</span>
            </div>

            <div class="form-group">
              <label for="price">Harga</label>
              <input
               type="number" 
               name="price" 
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
                  <option value="{{ $outlet->id }}">{{ $outlet->name }}</option>
                  @endforeach
               </select>
              <span class="text-danger">{{ $errors->first('outlet_id') }}</span>
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

{{-- end Modal --}}
@endsection
@section('js')
    <script>

      @if($errors->any())
       $('#exampleModal').modal('show');
      @endif

      $('.delete').on('click',function(){
			var id = $(this).attr('package-id');
			var url = '{{URL::to('package/delete')}}/' +id;
			Swal.fire({
				title: 'Yakin?',
				text: "Yakin ingin menghapus data paket?",
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