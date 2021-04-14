<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Pesanan</title>
</head>
<style>
  body{
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    font-size:18px;
    color:#333;
    text-align: center;
    margin:0;
  }
  .container{
    margin:0 auto;
    width: 750px;
    height: auto;
    background-color: #ffffff;
   
  }
   caption
   {
    font-size:28px;
    margin-bottom:15px;
    }
    table{
        border:1px solid #333;
        border-collapse:collapse;
        margin:0 auto;
        width:740px;
        text-align: center;
    }
    td, tr, th{
        padding:12px;
        border:1px solid #333;
        width:185px;
        
    }
    th{
        background-color: #f0f0f0;
        
    }
    h4, p{
        margin:0px;
    }
</style>
<body>
  <div class="container">
    <table>
            <caption>
               Laundry.IN
            </caption>
            <thead>
                <tr>
                    <th colspan="3">Invoice <strong>#{{ $transactions->invoice }}</strong></th>
                    <th>{{ $transactions->created_at->format('D, d M Y') }}</th>
                </tr>
                <tr >
                    <td colspan="2" >
                        <h4>Perusahaan: </h4>
                        <p>Laundry.IN<br>
                            JL. Rindang, Desa Prindapan Kec. Cibitung<br>
                            08989238823<br>
                            laundryli@gmail.co.id 
                        </p>
                    </td>
                    <td colspan="2">
                        <h4>Pelanggan: </h4>
                        <p>{{ $transactions->member->name }}<br>
                        {{ $transactions->member->address }}<br>
                        {{ $transactions->member->phone }} <br>
                      
                        </p>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Paket</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
                @foreach ($transactions->detail as $row)
                <tr>
                    <td>{{ $row->package->name }}</td>
                    <td>Rp {{ number_format($row->price) }}</td>
                    <td>{{ $row->qty }}</td>
                    <td>Rp {{ number_format($row->qty * $row->price) }}</td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="3">Subtotal</th>
                    <td>Rp {{ number_format($subtotal) }}</td>
                </tr>
                <tr>
                    <th colspan="3">Biaya Tambahan</th>
                    
                    <td>
                        Rp {{ ($transactions->additional_cost ? number_format($transactions->additional_cost) : '-') }}
                    </td>
                </tr>
                <tr>
                    <th colspan="3">Pajak</th>
                   
                    <td>Rp {{ ($transactions->tax ? number_format($transactions->tax) : '-') }}</td>
                </tr>
                <tr>
                    <th colspan="3">Discount</th>
                    
                    <td> 
                        {{ ($transactions->discount ? number_format($transactions->discount) : '-') }}%
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total bayar</th>
                    <td>Rp {{ number_format($transactions->total) }}</td>
                </tr>
            </tfoot>
        </table>
  </div>
</body>
</html>