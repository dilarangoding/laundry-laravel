@extends('layouts.master')

@section('title','User')

@section('content')
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">User</h6>
        </div>  
      </div>
    </div>
  </div>
</div>

<div class="container-fluid mt--6">
  <div class="row justify-content-center">

    <div class="col-xl-10">
      <div class="card">

        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">List User</h3>
            </div>
            <div class="col">
              <a href="{{ url('user/create') }}" class="btn btn-sm btn-primary float-right">Tambah</a>
            </div>    
          </div>
        </div>

        <div class="table-responsive">

          <table class="table align-items-center table-flush text-center">
            <thead class="thead-light">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama </th>
                <th scope="col">Email </th>
                <th scope="col">Outlet </th>
                <th scope="col">Level</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $item)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>
                      @if($item->outlet == NULL)
                        -
                      @else
                      {{ $item->outlet->name }}
                      @endif
                    </td>
                    <td>{{ $item->role }}</td>
                    <td>
                      <a href="{{ url('user/edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                      <a href="#" user-id="{{ $item->id }}" class="btn btn-danger btn-sm delete">Hapus</a>
                    </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
          <div class="float-right">
            {{ $users->links() }}
          </div>
        </div>

      </div>
    </div>
    

  </div>
</div>
@endsection
@section('js')
    <script>
      $('.delete').on('click',function(){
			var id = $(this).attr('user-id');
			var url = '{{URL::to('user/delete')}}/' +id;
			Swal.fire({
				title: 'Yakin?',
				text: "Yakin ingin menghapus data user?",
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