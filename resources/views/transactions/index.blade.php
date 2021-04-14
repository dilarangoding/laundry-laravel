@extends('layouts.master')

@section('title','Pesanan')

@section('content')
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Pesanan</h6>
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
              <h3 class="mb--5">List Pesanan</h3>
            </div>
            <div class="col">
              <button type="button" class="btn btn-primary float-right btn-sm" data-toggle="modal" data-target="#tambah">
                Buat Pesanan
              </button>
            </div>
          </div>
        </div>

        <div class="table-responsive">

          <table class="table align-items-center table-flush text-center">
            <thead class="thead-light">
              <tr>
                
                <th scope="col">No</th>
                <th scope="col">Invoice</th>
                <th scope="col">Nama </th>
                <th scope="col">Outlet</th>
                <th scope="col">Status</th>
                <th scope="col">Total </th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
             @foreach ($transactions as $item)
             
               <tr>
                 <td>
                   {{ $transactions->count() * ($transactions->currentPage() - 1) + $loop->iteration }}
                </td>
                 <td>{{ $item->invoice }}</td>
                 <td>{{ $item->member->name }}</td>
                 <td>{{ $item->outlet->name }}</td>
                 <td>
                  @if ($item->status == 'Baru')
                      <span class="badge badge-info">{{ $item->status }}</span>
                  @elseif($item->status == 'Proses')
                      <span class="badge badge-warning">{{ $item->status }}</span>
                  @elseif($item->status == 'Selesai')
                      <span class="badge badge-success">{{ $item->status }}</span>
                  @elseif($item->status == 'Diambil')
                      <span class="badge badge-primary">{{ $item->status }}</span>
                  @endif
                  </td>
                 <td>Rp {{ number_format($item->total) }}</td>
                 <td>
                   <div class="dropdown">
                      <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item detail" href="#" detail-id="{{ $item->id }}">Detail</a>
                        <a class="dropdown-item "  data-toggle="modal" data-target="#exampleModal-{{ $item->id }}">Update</a>
                        <a class="dropdown-item" href="{{ route('transaction.edit', ['id' => $item->id]) }}">Edit</a>
                        <a class="dropdown-item delete" order-id="{{ $item->id }}" href="#" >Hapus</a>
                      </div>
                   </div>
                  
                   <a href="{{ url('transaction/print', $item->id) }}" target="_blank" class="btn btn-success btn-sm">Print</a>
                 </td>
               </tr>
          
             @endforeach
            </tbody>
          </table>
          <div class="float-right">
            {{ $transactions->links() }}
          </div>
        </div>

      </div>
    </div>

    
  </div>

</div>


{{-- Modal Tambah order --}}
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Buat Pesanan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{ url('transaction') }}" method="post">
            @csrf
            <div class="form-group">
              <label for="member_id">Pilih Pelanggan</label>
               <select name="member_id" id="member_id" class="form-control {{ $errors->first('member_id')?'is-invalid':'' }}">
                  <option value="" selected disabled>Pilih Pelanggan</option>
                  @foreach ($members as $member)
                  <option value="{{ $member->id }}">{{ $member->name }}</option>
                  @endforeach
               </select>
              <span class="text-danger">{{ $errors->first('member_id') }}</span>
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Buat Pesanan</button>
        </form>
      </div>
    </div>
  </div>
</div>
{{-- End modla Tambah order --}}

{{-- modal detail order --}}
<div class="modal fade" id="detailModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Pesanan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>

{{-- end modal  --}}


{{-- modal update order --}}
@foreach ($transactions as $data)
<div class="modal modal-update fade" id="exampleModal-{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ url('transaction/saveUpdateOrder', $data->id) }}" method="post">
          @csrf
          <div class="form-group mt--4">
            <label for="invoice">Kode Invoice</label>
            <input type="text" name="invoice" class="form-control" value="{{ $data->invoice }}" readonly>
          </div>

          <div class="form-group">
            <label for="member_id">Nama Pelanggan</label>
            <input type="text" name="member_id" class="form-control" value="{{ $data->member->name }}" readonly>
          </div>

          <div class="form-group">
            <label for="outlet_id">Outlet</label>
            <input type="text" name="outlet_id" class="form-control" value="{{ $data->outlet->name }}" readonly>
          </div>

          <div class="form-group">
            <label for="status">Status Pesanan</label>
            <select name="status" id="status" class="form-control">
              <option value="" selected disabled>Pilih status</option>
              <option value="Baru" {{ $data->status == 'Baru'?'selected': '' }}>Baru</option>
              <option value="Proses" {{ $data->status == 'Proses'?'selected': '' }}>Proses</option>
              <option value="Selesai" {{ $data->status == 'Selesai'?'selected': '' }}>Selesai</option>
              <option value="Diambil" {{ $data->status == 'Diambil'?'selected': '' }}>Diambil</option>
            </select>
          </div>

          <div class="form-group">
            <label for="payment_date">Tanggal pembayaran</label>
            @if($data->payment_date != NULL)
            <input type="date" id="payment_date" value="{{ $data->payment_date }}" name="payment_date" class="form-control" readonly>
            @else
            <input type="date" id="payment_date" value="" class="form-control" name="payment_date">
            @endif
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach
{{-- end modal --}}
@endsection
@section('js')
    <script>

        @if($errors->any())
          $('#tambah').modal('show');
        @endif

        $('.detail').on('click',function(){

        let id = $(this).attr('detail-id');
        var url = '{{URL::to('transaction/detailOrder')}}/'+id;

        $.ajax({
          url:url,
          method:"GET",
          success:function(data){
            $('#detailModal').find('.modal-body').html(data);
            $('#detailModal').modal('show');
          },
          error:function(error){
            console.log(error);
          }
        });
      });

      $('.delete').on('click',function(){
        var id = $(this).attr('order-id');
        var url = '{{URL::to('transaction/cancel')}}/' +id;
        Swal.fire({
          title: 'Yakin?',
          text: "Yakin ingin menghapus pesanan?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya',
          cancelButtonText:'Tidak'
        }).then((result) => {
          if (result.value) {
            window.location = url;
          }
        })
      });

    </script>
@endsection
