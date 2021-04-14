<div class="form-group mt--4 mb-0">
  <input type="hidden" name="id" value="{{ $item->id }}" class="id">
  <label for="package_id">Nama Paket</label>
  <input type="text" readonly value="{{ $item->package->name }}" class="form-control">
</div>
<div class="form-group mb-1">
  <label for="price">Harga paket</label>
  <input type="text" readonly value="{{ $item->package->price }}" class="form-control">
</div>
<div class="form-group mb-1 ">
  <label for="qty">Qty</label>
  <input type="number" min="0" value="{{ $item->qty }}" name="qty" class="form-control">
</div>