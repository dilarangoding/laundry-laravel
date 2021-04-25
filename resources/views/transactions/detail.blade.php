<div class="row mt--4">
  <div class="col-md-6">
    <table class="table table-borderless ">
      <tr>
        <td width="55%">Kode Invoice</td>
        <td width="20px">:</td>
        <td>{{ $order->invoice }}</td>
      </tr>
      <tr>
        <td>Kasir</td>
        <td>:</td>
        <td>{{ $order->user->name }}</td>
      </tr>
      <tr>
        <td width="45%">Pelanggan</td>
        <td width="20px">:</td>
        <td>{{ $order->member->name }}</td>
      </tr>
      <tr>
        <td>Outlet</td>
        <td>:</td>
        <td>{{ $order->outlet->name }}</td>
      </tr>
      <tr>
        <td>Status Pesanan</td>
        <td>:</td>
        <td><span class="badge badge-success">{{ $order->status }}</span></td>
      </tr>
    </table>
  </div>
  <div class="col-md-6">
    <div class="table-responsive">
      <table class="table table-borderless">
     
      <tr>
        <td>Tanggal Pemesanan</td>
        <td>:</td>
        <td>{{ date('d-m-Y', strtotime($order->date)) }}</td>
      </tr>
      <tr>
        <td>Tanggal Selesai</td>
        <td>:</td>
        <td>{{ date('d-m-Y', strtotime($order->expired)) }}</td>
      </tr>
      <tr>
        <td>Tanggal Bayar</td>
        <td>:</td>
        <td>{{ ($order->payment_date != NULL? date('d-m-Y', strtotime($order->payment_date)) : '-') }}</td>
      </tr>
      <tr>
        <td>Keterangan Bayar</td>
        <td>:</td>
        <td>{{ $order->paid }}</td>
      </tr>
      <tr>
        <td>Catatan</td>
        <td>:</td>
        <td>{{ ($order->note != NULL? $order->note : '-') }}</td>
      </tr>
    </table>
    </div>
  </div>
</div>
<hr>
<div class="row">
  <div class="col-md-12">
    <table class="table table-borderless text-center">
      
         <tr>
          <th>No</th>
          <th>Paket</th>
          <th>Harga</th>
          <th>Qty</th>
          <th>Subtotal</th>
        </tr>
      
      <tbody>
        @foreach ($order->detail as $item)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $item->package->name }}</td>
          <td>Rp {{ number_format($item->package->price) }}</td>
          <td>{{ $item->qty }}</td>
          <td>Rp {{ number_format($item->qty * $item->package->price) }}</td>
        </tr>    
        @endforeach
      </tbody>
      
    </table>
  </div>
  <div class="col-md-6 offset-6 text-center mt-3 mb--5">
    <table class="table table-borderless">
      <tr>
        <td>Biaya Tambahan</td>
        <td>:</td>
        <td>Rp {{($order->additional_cost != NULL? number_format($order->additional_cost) : '-') }}</td>
      </tr>
      <tr>
        <td>Pajak</td>
        <td>:</td>
        <td>Rp {{ ($order->tax != NULL? number_format($order->tax) : '-') }} </td>
      </tr>
      <tr>
        <td >Diskon</td>
        <td >:</td>
        <td>{{ ($order->discount != NULL? $order->discount : '-')}}%</td>
      </tr>
      <tr>
        <td>Total</td>
        <td>:</td>
        <td>Rp {{ number_format($order->total) }}</td>
      </tr>
      
    </table>
    <hr style="border: 1px solid rgb(201, 201, 201); margin-top:-15px;">
  </div>
</div>