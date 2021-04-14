@extends('layouts.master')

@section('title','Laporan')

@section('content')

<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Laporan</h6>
        </div>   
      </div>
    </div>
  </div>
</div>

<div class="container-fluid mt--6">
  <div class="row  justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <form action="{{ url('report') }}" method="post">
            @csrf
            <div class="form-group">
              <label for="start">Tanggal awal</label>
              <input type="date" name="date_start" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="end">Tanggal akhir</label>
              <input type="date" name="date_end" class="form-control" required>
            </div>
            @if (auth()->user()->role == 'owner' || auth()->user()->role == 'admin' )
                <div class="form-group">
                  <label for="outlet_id">Outlet</label>
                  <select name="outlet_id" id="outlet_id" class="form-control" required>
                    <option value="" selected disabled>Pilih Outlet</option>
                    <option value="all">Semua Outlet</option>
                    @foreach ($outlets as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                  </select>
                </div>
            @else

            <div class="form-group">
              <label for="outlet_id">Outlet</label>
              <input type="text" id="outlet_id" class="form-control" disabled  value="{{ $outlets->outlet->name  }}" >
              <input type="hidden" name="outlet_id" value="{{ $outlets->outlet->id}}">
            </div>
                
            @endif

            <div class="form-group">
              <button class="btn btn-danger float-right">Print PDF</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection