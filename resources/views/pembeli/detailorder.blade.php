@extends("layouts.design")

@section("title","Detail Transaksi")

@section("section")
<h2>Detail Transaksi : {{Auth::user()->name}}</h2>
@if (session('fail'))
    <div class="alert alert-danger">
        {{ session('fail') }}
    </div>
@endif

<div class="table-responsive">
<table class="table table-bordered table table-striped">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama Barang</th>
      <th scope="col">Jumlah Barang</th>
      <th scope="col">Harga Barang</th>
      <th scope="col">Totalharga</th>
    </tr>
  </thead>
  <tbody>
    @forelse($transaksis->detailkeranjang as $transaksi)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$transaksi->barang->namaproduk}}</td>
        <td>{{$transaksi->stok}}</td>
        <td>{{number_format($transaksi->barang->hargabarang)}}</td>
        <td>{{number_format($transaksi->barang->hargabarang * $transaksi->stok)}}</td>
      </tr>
    @empty
    <div class="alert alert-danger">datanya kosong</div>
    @endforelse
  </tbody>
</table>
</div>
<div class="alert alert-info my-3">Total Semua : {{number_format($transaksis->totalsemuaharga)}}</div>
<!-- metode pembayaran : transfer dan statustfnya : pending -->
@if($transaksis->metodepembayaran == 'transfer' && $transaksis->statustransaksi == "pending")
<h2 class="text-capitalize">Pembayaran {{$transaksis->metodepembayaran}}</h2>
<h4>Total Yang Harus Dibayar : {{number_format($transaksis->totalsemuaharga)}}</h4>
<h5>Metode Pembayaran : {{$transaksis->metodepembayaran}}</h5>
@if($transaksis->statustransaksi == "lunas")
<h6 class='text-capitalize text-success'>status transaksi : {{$transaksis->statustransaksi}}</h6>
@else
<h6 class='text-capitalize text-danger'>status transaksi : {{$transaksis->statustransaksi}}</h6>
@endif
<form action="{{url('pembayarantf')}}" method="post" enctype="multipart/form-data">
  
</form>
<!-- end if statustransaksi -->
<!-- batas -->
@endif
<!-- metode pembayaran : cod dan statustfnya : pending -->
@if($transaksis->metodepembayaran == 'cod' && $transaksis->statustransaksi == "pending")
<h2 class="text-capitalize">Pembayaran {{$transaksis->metodepembayaran}}</h2>
<h4>Total Yang Harus Dibayar : {{number_format($transaksis->totalsemuaharga)}}</h4>
<h5>Metode Pembayaran : {{$transaksis->metodepembayaran}}</h5>
@if($transaksis->statustransaksi == "lunas")
<h6 class='text-capitalize text-success'>status transaksi : {{$transaksis->statustransaksi}}</h6>
@else
<h6 class='text-capitalize text-danger'>status transaksi : {{$transaksis->statustransaksi}}</h6>
@endif
<form action="{{url('pembayarancod/'.$transaksi->kodebayar)}}" method="post" class="d-inline-block" onsubmit="return confirm('are you sure ? ')">
@csrf
<div class="mb-3">
    <label for="kurir" class="form-label">Pilih Kurir</label>
    <select class="form-select @error('kurirs_id') is-invalid @enderror" name="kurirs_id" aria-label="Default select example">
    <option selected disabled>Open this select menu</option>
    @foreach($kurirs as $kurir)
    <option value="{{$kurir->id}}">{{$kurir->namaperusahaan}}</option>
    @endforeach
  </select>
  </div>
<button type="submit" class="btn btn-primary my-3">Konfirmasi Pembayaran</button>
</form>
<!-- end if statustransaksi -->
<!-- batas -->
@endif

<a href="{{url('pembeliorder/'.Auth::user()->id.'/'.Auth::user()->name)}}" class='btn btn-warning'>Back</a>
@endsection