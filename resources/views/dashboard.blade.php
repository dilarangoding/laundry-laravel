@extends('layouts.master')

@section('title','Dashboard')

@section('content')
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Dashboard</h6>
        </div>    
      </div>
    </div>
  </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">

  <div class="row">
  @if(auth()->user()->role == 'admin')

    <div class="col-xl-3 col-md-6">
      <div class="card card-stats">
        <!-- Card body -->
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">Total Outlet</h5>
              <span class="h2 font-weight-bold mb-0 ">{{ $outlet }}</span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                <i class="ni ni-shop"></i>
              </div>
            </div>
          </div>
          <p class="mt-3 mb-0 text-sm">
            <a href="{{ url('outlet') }}">Lihat Selangkapnya</a>
          </p>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6">
      <div class="card card-stats">
        <!-- Card body -->
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">Pelanggan</h5>
              <span class="h2 font-weight-bold mb-0">{{ $member }}</span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                <i class="ni ni-single-02"></i>
              </div>
            </div>
          </div>
         <p class="mt-3 mb-0 text-sm">
           <a href="{{ url('member') }}">Lihat Selangkapnya</a>
          </p>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6">
      <div class="card card-stats">
        <!-- Card body -->
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">User</h5>
              <span class="h2 font-weight-bold mb-0">{{ $user }}</span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                <i class="ni ni-badge"></i>
              </div>
            </div>
          </div>
          <p class="mt-3 mb-0 text-sm">
            <a href="{{ url('user') }}">Lihat Selangkapnya</a>
          </p>
        </div>
      </div>
    </div>

     <div class="col-xl-3 col-md-6">
      <div class="card card-stats">
        <!-- Card body -->
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">Pesanan selesai</h5>
              <span class="h2 font-weight-bold mb-0">{{ $orderComplated }}</span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-gradient-success text-white rounded-circle shadow">
                <i class="ni ni-check-bold"></i>
              </div>
            </div>
          </div>
          <p class="mt-3 mb-0 text-sm">
            <a href="{{ url('transaction') }}">Lihat Selangkapnya</a>
          </p>
        </div>
      </div>
    </div>


    @elseif(auth()->user()->role == 'kasir')
    
    <div class="col-xl-3 col-md-6">
      <div class="card card-stats">
        <!-- Card body -->
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">Pesanan Baru</h5>
              <span class="h2 font-weight-bold mb-0">{{ $baru }}</span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                <i class="ni ni-cart"></i>
              </div>
            </div>
          </div>
         <p class="mt-3 mb-0 text-sm">
            <span class="text-success mr-2"></span>
            <a href="{{ url('transaction') }}" class="text-nowrap text-primary">Lihat selengkapnya</a>
          </p>
        </div>
      </div>
    </div>

     <div class="col-xl-3 col-md-6">
      <div class="card card-stats">
        <!-- Card body -->
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">Pesanan Proses</h5>
              <span class="h2 font-weight-bold mb-0">{{ $proses }}</span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">
                <i class="ni ni-time-alarm"></i>
              </div>
            </div>
          </div>
          <p class="mt-3 mb-0 text-sm">
            <span class="text-success mr-2"></span>
            <a href="{{ url('transaction') }}" class="text-nowrap text-primary">Lihat selengkapnya</a>
          </p>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6">
      <div class="card card-stats">
        <!-- Card body -->
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">Pesanan selesai</h5>
              <span class="h2 font-weight-bold mb-0">{{ $orderComplated }}</span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-gradient-success text-white rounded-circle shadow">
                <i class="ni ni-check-bold"></i>
              </div>
            </div>
          </div>
          <p class="mt-3 mb-0 text-sm">
            <span class="text-success mr-2"></span>
            <a href="{{ url('transaction') }}" class="text-nowrap text-primary">Lihat selengkapnya</a>
          </p>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6">
      <div class="card card-stats">
        <!-- Card body -->
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0"> diambil</h5>
              <span class="h2 font-weight-bold mb-0">{{ $diambil }}</span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
                <i class="ni ni-delivery-fast"></i>
              </div>
            </div>
          </div>
          <p class="mt-3 mb-0 text-sm">
            <span class="text-success mr-2"></span>
            <a href="{{ url('transaction') }}" class="text-nowrap text-primary">Lihat selengkapnya</a>
          </p>
        </div>
      </div>
    </div>

    @else

    <div class="col-xl-3 col-md-6">
      <div class="card card-stats">
        <!-- Card body -->
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">Total Outlet</h5>
              <span class="h2 font-weight-bold mb-0 ">{{ $outlet }}</span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                <i class="ni ni-shop"></i>
              </div>
            </div>
          </div>
         <p class="mt-3 mb-0 text-sm">
         
          <a href="#" class="text-nowrap text-primary " data-toggle="modal" data-target="#outlet">Lihat selengkapnya</a>
        </p>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6">
      <div class="card card-stats">
        <!-- Card body -->
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">Pelanggan</h5>
              <span class="h2 font-weight-bold mb-0">{{ $member }}</span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                <i class="ni ni-single-02"></i>
              </div>
            </div>
          </div>
         <p class="mt-3 mb-0 text-sm">
            <span class="text-success mr-2"></span>
            <a class="text-nowrap text-primary" data-toggle="modal" data-target="#pelanggan">Lihat selengkapnya</a>
          </p>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6">
      <div class="card card-stats">
        <!-- Card body -->
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">User</h5>
              <span class="h2 font-weight-bold mb-0">{{ $user }}</span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                <i class="ni ni-badge"></i>
              </div>
            </div>
          </div>
          <p class="mt-3 mb-0 text-sm">
            <span class="text-success mr-2"></span>
            <a href="#" class="text-nowrap text-primary" data-toggle="modal" data-target="#pengguna">Lihat selengkapnya</a>
          </p>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6">
      <div class="card card-stats">
        <!-- Card body -->
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">Pendapatan</h5>
              <span class="h2 font-weight-bold mb-0">Rp {{ number_format($pendapatan) }}</span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-gradient-success text-white rounded-circle shadow">
                <i class="ni ni-credit-card"></i>
              </div>
            </div>
          </div>
          <p class="mt-3 mb-0 text-sm">
            <span class="text-success mr-2"></span>
            <a href="#" class="text-nowrap text-primary" data-toggle="modal" data-target="#income">Lihat selengkapnya</a>
          </p>
        </div>
      </div>
    </div>

    @endif

  </div>


  <div class="row">
    <div class="col-xl-12">
       @if(auth()->user()->role == 'admin' || auth()->user()->role == 'kasir')
      <div class="card">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Pesanan Baru</h3>
            </div>
            <div class="col text-right">
              <a href="{{ url('transaction') }}" class="btn btn-sm btn-primary">Lihat</a>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center text-center">
            <thead class="thead-light">
              <tr>
              
                <th scope="col">Invoice</th>
                <th scope="col">Nama Pelanggan</th>
                <th scope="col">Outlet</th>
                <th scope="col">Status</th>
                <th scope="col">Total</th>
              </tr>
            </thead>
            <tbody>
            @forelse ($order as $item)
            <tr>
                <td>{{ $item->invoice }}</td>
                <td>{{ $item->member->name }}</td>
                <td>{{ $item->outlet->name }}</td>
                <td><span class="badge badge-primary">{{ $item->status }}</span></td>
                <td>Rp {{ number_format($item->total) }}</td>
            </tr>
            @empty 
            <tr>
                <td colspan="4" class="text-center">Tidak ada pesanan terbaru</td>
            </tr>   
            @endforelse
            </tbody>
          </table>
        </div>
      </div>
    @endif
  </div>

</div>    


{{-- Modal outlet --}}
<div class="modal fade" id="outlet" tabindex="-1" aria-labelledby="ouletLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ouletLabel">List Outlet</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card">

          <div class="card-body">
            <table class="table  table-bordered  table-hover text-center">
              <thead class="thead-light">
                <tr>
                  <th>No</th>
                  <th>Nama Outlet</th>
                  <th>Alamat Outlet</th>
                  <th>Telepon Outlet</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($cabang as $cbng)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $cbng->name }}</td>
                  <td>{{ $cbng->address }}</td>
                  <td>{{ $cbng->phone }}</td>
                </tr>
                @empty
                <tr>
                  <td colspan="4">Tidak ada data</td>
                </tr>    
                @endforelse
              </tbody>
            </table>
           
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
{{-- End Modal outlet --}}


{{-- Modal Pelanggan --}}
<div class="modal fade" id="pelanggan" tabindex="-1" aria-labelledby="pelangganLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="pelangganLabel">List Pelanggan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card">

          <div class="card-body">
            <table class="table  table-bordered  table-hover text-center">
              <thead class="thead-light">
                <tr>
                  <th>No</th>
                  <th>Nama </th>
                  <th>Jenis Kelamin</th>
                  <th>Alamat </th>
                  <th>Telepon </th>
                </tr>
              </thead>
              <tbody>
                @forelse ($pelanggan as $plg)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $plg->name }}</td>
                  <td>{{ $plg->gender }}</td>
                  <td>{{ $plg->address }}</td>
                  <td>{{ $plg->phone }}</td>
                </tr>
                @empty
                <tr>
                  <td colspan="5">Tidak ada data</td>
                </tr>    
                @endforelse
              </tbody>
            </table>
           
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
{{-- End modal pelanggan--}}

{{-- modal user --}}
<div class="modal fade" id="pengguna" tabindex="-1" aria-labelledby="penggunaLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="penggunaLabel">List User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card">

          <div class="card-body">
            <table class="table  table-bordered  table-hover text-center">
              <thead class="thead-light">
                <tr>
                  <th>No</th>
                  <th>Nama </th>
                  <th>Email</th>
                  <th>Outlet</th>
                  <th>Level</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($pengguna as $pgn)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $pgn->name }}</td>
                  <td>{{ $pgn->email }}</td>
                  <td>{{( $pgn->outlet_id ? $pgn->outlet->name : '-')  }}</td>
                  <td>{{ $pgn->role }}</td>
                </tr>
                @empty
                <tr>
                  <td colspan="5">Tidak ada data</td>
                </tr>    
                @endforelse
              </tbody>
            </table>
           
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
{{-- end modal user --}}

{{-- modal pendapatan --}}

<div class="modal fade" id="income" tabindex="-1" aria-labelledby="incomeLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="incomeLabel">List Pendapatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card">

          <div class="card-body">
            <table class="table  table-bordered  table-hover text-center">
              <thead class="thead-light">
                <tr>
                  <th>No</th>
                  <th>Kode Invoice</th>
                  <th>Nama Pelanggan</th>
                  <th>Outlet</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($income as $im)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $im->invoice }}</td>
                  <td>{{ $im->member->name }}</td>
                  <td>{{ $im->outlet->name  }}</td>
                  <td>Rp {{ number_format($im->total) }}</td>
                </tr>
                @empty
                <tr>
                  <td colspan="5">Tidak ada data</td>
                </tr>    
                @endforelse
              </tbody>
              <tfoot>
                <tr>
                  <td class="text-center bg-secondary " colspan="4">Total Pendapatan</td>
                  <td>Rp {{ number_format($pendapatan)  }}</td>
                </tr>
              </tfoot>
            </table>
           
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

{{-- end modal pendapatan --}}
@endsection

@section('js')
    <script>
        $(document).ready(function() {
          $('.table').DataTable( {
      
              "paging": false,
              "info"  : false,
          } );
      } );

  </script>
@endsection