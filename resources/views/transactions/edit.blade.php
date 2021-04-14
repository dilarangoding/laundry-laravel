@extends('layouts.transaction')

@section('title','Transaksi')

@section('content')

<div class="container-fluid mt-3">

  

  <div class="items">
    <form action="{{ url('transaction/update', $transactions->id) }}" method="post">
      @csrf
      <div class="row">

        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              
                <div class="form-group row mb-2 ">
                    <label for="invoice" class="col-md-4 col-form-label text-md-left  ">Kode Invoice</label>
                    <div class="col-md-8">
                    <input id="invoice" type="text" class="form-control @error('invoice') is-invalid @enderror" name="invoice" value="{{ $transactions->invoice }}" readonly >
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="user_id" class="col-md-4 col-form-label text-md-left  ">Kasir</label>
                    <div class="col-md-8">
                        <input id="user_id" type="text" class="form-control @error('user_id') is-invalid @enderror" name="user_id" value="{{ auth()->user()->name }}" readonly >
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="member_id" class="col-md-4 col-form-label text-md-left  ">Pelanggan</label>
                    <div class="col-md-8">
                        <input id="member_id" type="text" class="form-control @error('member_id') is-invalid @enderror" name="member_id" value="{{ $transactions->member->name }}" readonly >
                    </div>
                </div>
              
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              @if(auth()->user()->outlet_id == NULL)
                <div class="form-group row mb-2">
                    <label for="outlet_id" class="col-md-4 col-form-label text-md-left  ">Outlet</label>
                    <div class="col-md-8">
                        <select name="outlet_id" id="outlet_id" class="form-control">
                          <option value="" selected disabled>Pilih Outlet</option>
                          @foreach ($outlets as $outlet)
                          <option value="{{ $outlet->id }}">{{ $outlet->name }}</option>    
                          @endforeach
                        </select>
                        <span class="text-danger">{{ $errors->first('outlet_id') }}</span>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="package_id" class="col-md-4 col-form-label text-md-left  ">Paket</label>
                    <div class="col-md-8">
                        <select name="package_id" id="package_id" class="form-control">
                          <option value="" selected disabled>Pilih Paket</option>
                        </select>
                        <span class="text-danger">{{ $errors->first('package_id') }}</span>
                    </div>
                </div>
                @else

                <div class="form-group row mb-2">
                    <label for="outlet_id" class="col-md-4 col-form-label text-md-left  ">Outlet</label>
                    <div class="col-md-8">
                        <input type="text"  class="form-control" value="{{ $outlets->name }}" readonly>
                        <input type="hidden" name="outlet_id" class="form-control" value="{{ $outlets->id }}" readonly>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label for="package_id" class="col-md-4 col-form-label text-md-left  ">Paket</label>
                    <div class="col-md-8">
                        <select name="package_id" id="package_id" class="form-control">
                          <option value="" selected disabled>Pilih Paket</option>
                          @foreach ($packages as $package)
                          <option value="{{ $package->id }}">{{ $package->name }} - {{ $package->type }} </option>
                          @endforeach
                        </select>
                        <span class="text-danger">{{ $errors->first('package_id') }}</span>
                    </div>
                </div>
                @endif
                <div class="form-group row mb-2">
                    <label for="price" class="col-md-4 col-form-label text-md-left  ">Harga</label>
                    <div class="col-md-8">
                        <input type="text" id="price" value="0"  class="form-control" readonly>
                        <span class="text-danger">{{ $errors->first('price') }}</span>
                    </div>
                </div>
              
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
            
                <div class="form-group row mb-2">
                    <label for="status" class="col-md-4 col-form-label text-md-left ">
                      <h5 class="">Tanggal pesan</h5>
                    </label>
                    <div class="col-md-8">
                    <input type="text" value="{{ date('d-m-Y') }}"  readonly id="date"  class="form-control">
                    <input type="hidden" name="date" value="{{ date('Y-m-d') }}">
                    <span class="text-danger">{{ $errors->first('date') }}</span>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="qty" class="col-md-4 col-form-label text-md-left  ">Qty</label>
                    <div class="col-md-8">
                        <input id="qty" type="number" class="form-control @error('qty') is-invalid @enderror" name="qty" value="1" min="1"  >
                        <span class="text-danger">{{ $errors->first('qty') }}</span>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="" class="col-md-4 col-form-label text-md-left  "></label>
                    <div class="col-md-8">
                        <button href="#" class="btn btn-primary"><i class="ni ni-cart"></i> Add</button>
                    </div>
                </div>
            
            </div>
          </div>
        </div>

      </div>
    </form>
  </div>

  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">

          <table class="table align-items-center table-bordered  text-center">
            <thead class="thead-light">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Paket</th>
                <th>Tipe Paket</th>
                <th scope="col">Harga</th>
                <th scope="col">Qty </th>
                <th scope="col">Total</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($transactions->detail as $item)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $item->package->name }}</td>
                  <td>{{ $item->package->type }}</td>
                  <td>Rp {{ number_format( $item->package->price) }}</td>
                  <td>{{ $item->qty }}</td>
                  <td >Rp {{ number_format( $item->qty * $item->package->price) }}</td>
                  <td>
                    <a href="#" data-id="{{ $item->id }}" class="btn btn-info btn-sm">Update</a>
                    <a href="# " item-id="{{ $item->id }}" class="btn btn-danger btn-sm item">Hapus</a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>

        </div>
        </div>
      </div>
    </div>
  </div>

  <div class="save">

    <form action="{{ url('transaction/save', $transactions->id) }}" method="post">
      @csrf
      <div class="row">

        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              
                <div class="form-group row mb-2">
                    <label for="subtotal" class="col-md-4 col-form-label text-md-left  ">Subtotal</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control @error('subtotal') is-invalid @enderror"  value="Rp {{ number_format($subtotal) }}" readonly >
                        <input type="hidden" value="{{ $subtotal }}" id="subtotal" >
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label for="additional_cost" class="col-md-4 col-form-label text-md-left  ">Biaya Tambahan</label>
                    <div class="col-md-8">
                        <input id="additional_cost" value="{{ $transactions->additional_cost }}" type="number" class="harga form-control @error('additional_cost') is-invalid @enderror" name="additional_cost">
                    </div>           
                </div>
                

                <div class="form-group row mb-2">
                    <label for="tax" class="col-md-4 col-form-label text-md-left  ">Pajak</label>
                    <div class="col-md-8">
                        <input id="tax" type="number" value="{{ $transactions->tax }}"  class="harga form-control @error('tax') is-invalid @enderror" name="tax">
                    </div>           
                </div>

                <div class="form-group row mb-2">
                    <label for="discount" class="col-md-4 col-form-label text-md-left  ">Diskon</label>
                    <div class="col-md-8">
                        <input id="discount" value="{{ $transactions->discount }}" max="100" min="0" type="number" class="harga form-control @error('discount') is-invalid @enderror" name="discount">
                    </div>           
                </div>

                

                <div class="form-group row mb-2">
                    <label for="total" class="col-md-4 col-form-label text-md-left  ">Total</label>
                    <div class="col-md-8">
                      @if($transactions->total ==  0)
                         <input id="tot" readonly  type="text" class="harga form-control @error('total') is-invalid @enderror" name="total" value="Rp {{ number_format($subtotal) }}">
                          <input id="total" type="hidden" name="total" value="{{ $subtotal }}">
                      @else
                          <input id="tot" readonly  type="text" class="harga form-control @error('total') is-invalid @enderror" name="total" value="Rp {{ number_format($transactions->total) }}">
                          <input id="total" type="hidden" name="total" value="{{ $transactions->total }}">
                      @endif
                       
                    </div>           
                </div>
              
            
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              

                <div class="form-group row mb-2">
                    <label for="note" class="col-md-4 col-form-label text-md-left ">Tanggal bayar</label>
                    <div class="col-md-8">
                      <input type="date" class="form-control" value="{{ $transactions->payment_date }}" name="payment_date" class="form-control">
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label for="note" class="col-md-4 col-form-label text-md-left ">Keterangan</label>
                    <div class="col-md-8">
                      <textarea name="note" id="note" cols="30" rows="3" class="form-control">{{ $transactions->note }}</textarea>
                    </div>
                </div>
                
                
            
            </div>
          </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
              <a href="#" order-id="{{ $transactions->id }}" class="delete btn btn-warning"><i class="ni ni-fat-remove"></i> Cancel</a>
            </div>
          <div class="form-group">
              <button type="submit" class="btn btn-success"><i class="ni ni-send"></i> Simpan pesanan</button>
          </div>
        </div>

      </div>
    </form>

  </div>
  
</div>   





{{-- modal update item --}}
  <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Update Item </h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="" method="post" id="form">
					@csrf
					<div class="modal-body">
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>

						<button type="button" class="btn btn-primary btn-update">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
{{-- end modal --}}
@endsection

@section('js')
<script>

    $('.delete').on('click',function(){
			var id = $(this).attr('order-id');
			var url = '{{URL::to('transaction/cancel')}}/' +id;
			Swal.fire({
				title: 'Yakin?',
				text: "Yakin ingin membatalkan pesanan?",
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

    $('.item').on('click',function(){
			var id = $(this).attr('item-id');
			var url = '{{URL::to('transaction/deleteItem')}}/' +id;
			Swal.fire({
				title: 'Yakin?',
				text: "Yakin ingin menghapus item?",
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

    	$('.btn-info').on('click',function(){

			let id = $(this).data('id');
			var url = '{{URL::to('transaction/updateItem')}}/' +id;

			$.ajax({
				url:url,
				method:"GET",
				success:function(data){
					$('#editmodal').find('.modal-body').html(data);
					$('#editmodal').modal('show');
				},
				error:function(error){
					console.log(error);
				}
			});
		});

		$('.btn-update').on('click',function(){
			
			var id = $('.form-group').find('.id').val()
			var url = '{{URL::to('transaction/saveUpdate')}}/' +id;
			var data = $("#form").serialize();
		

			$.ajax({
				data:data,
				url:url,
				method:"POST",
				success:function(data){
					$('#editmodal').modal('hide');
					window.location.reload();
				},
				error:function(error){
					
				}
			});
		});
      
   
       
      function addPeriod(nStr)
      {
          nStr += '';
          x = nStr.split('.');
          x1 = x[0];
          x2 = x.length > 1 ? '.' + x[1] : '';
          var rgx = /(\d+)(\d{3})/;
          while (rgx.test(x1)) {
              x1 = x1.replace(rgx, '$1' + ',' + '$2');
          }
          return x1 + x2;
      }


      $(document).on('change','#additional_cost', function(){
          var additional_cost  = parseInt($('#additional_cost').val());
              total            = parseInt($('#total').val());

          var total             = total + additional_cost;
          
          var bayar  = $('#tot').val('Rp ' + addPeriod(total));
              bayarr = $('#total').val(total);
      
      });


      $(document).on('change','#tax', function(){
          var subtotal         = parseInt($('#subtotal').val());
              tax              = parseInt($('#tax').val());
              total            = parseInt($('#total').val());

          var total             = total + tax;
          
          var bayar  = $('#tot').val('Rp ' + addPeriod(total));
              bayarr = $('#total').val(total);
      });

      $(document).on('change','#discount', function(){
          var subtotal             = parseInt($('#subtotal').val());
              tax                  = $('#tax').val();
              discount             = $('#discount').val();
              total                = $('#total').val();

          var dc                   =  total * discount / 100;
          var total                =  total - dc ;
          
          var bayar   = $('#tot').val('Rp ' + addPeriod(total));
              bayarr  = $('#total').val(total);
      });


      
      
      
        
      $('#outlet_id').on('change', function() {
            $.ajax({
                url: "{{ url('/api/package') }}",
                type: "GET",
                data: { outlet_id: $(this).val() },
                success: function(html){
                    $('#package_id').empty()
                    $('#package_id').append('<option value="">Pilih Paket</option>')
                    $.each(html.data, function(key, item) {
                        $('#package_id').append('<option value="'+item.id+'">'+item.name+' - '+item.type+'</option>')
                    });
                }
            });
        });

     
        $("#package_id").change(function(){
            var id = $(this).val();
          
            var url = '{{URL::to('transaction/getPricePackage')}}/' +id;
            $.ajax({
              url:url,
              type:'get',
              dataType:'json',
              success:function(response){
                $('#price').val(response.price);
                var num = $('#price').val()
                num = addPeriod(num);
                $('#price').val('Rp '+num)
              }
            })
        });

       

  
    </script>
@endsection