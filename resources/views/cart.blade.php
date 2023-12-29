@extends("layout.mockup")

@section("title","Keranjang")

@section("header","Keranjang Anda")

@section("section")
@if (session('status'))
    <div class="alert alert-success w-100">
        {{ session('status') }}
    </div>
@endif
@if (session('warning'))
    <div class="alert alert-warning w-100">
        {{ session('warning') }}
    </div>
@endif
<div class="table-responsive">
<table class="table table-bordered table table-striped">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama Barang</th>
      <th scope="col">Harga Barang</th>
      <th scope="col">Jumlah Beli</th>
      <th scope="col">Total Harga</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <a href="{{url('allproduct')}}" class="btn btn-primary my-3">Back To Product</a>
    <?php 
    $data = Auth::user()->id;
    $jumlahcart = $keranjangs->count();
    ?>
    @if($jumlahcart > 1)
    <form action="{{url('truncatecart',$data)}}" method="post" onsubmit="return confirm('apakah ingin dihapus semua?')">
      @csrf
      @method("DELETE")
      <button type="submit" class="btn btn-danger my-3 ms-2">Remove All Cart</button>
    </form>
    @endif
  @forelse($keranjangs as $keranjang)
  <tr>
    <td>{{$loop->iteration}}</td>
    <td>{{$keranjang->barang->namaproduk}}</td>
    <td>{{number_format($keranjang->barang->hargabarang)}}</td>
    <td>
    <form action="{{url('updatecart',$keranjang->id)}}" method="post">
    <div class="input-group mb-3">
        @csrf
        @method("PUT")
        <input type="number" class="form-control @error('stok') is-invalid @enderror" name="stok" value="{{$keranjang->stok}}">
        <button type="submit" class="btn btn-success" id="button-addon2">Update Qty</button>
    </div>
    </form>
    </td>
    <td>{{number_format($keranjang->totalharga)}}</td>
    <td>
        <form action="{{url('removecart',$keranjang->id)}}" method="post" onsubmit="return confirm('yakin ingin dihapus?')">
            @csrf
            @method("DELETE")
            <button type="submit" class="btn btn-danger">Remove Cart</button>
        </form>
    </td>
  </tr>
@empty
<div class="alert alert-danger text-capitalize w-100">Barangnya Kosong</div>
@endforelse
<tfoot>
    <tr>
        <td colspan="6" class="text-capitalize text-center">Total Belanja : {{number_format(Auth::user()->keranjang->sum("totalharga"))}}</td>
    </tr>
  </tfoot>
</tbody>
</table>
@if($keranjangs->count(0))
<a href="{{url('checkout')}}" class="btn btn-primary my-3 w-100">Checkout</a>
@endif
@endsection