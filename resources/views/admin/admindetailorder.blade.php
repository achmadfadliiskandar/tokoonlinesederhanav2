@extends("layouts.design")

@section("title","Admin Detail Transaksi")

@section("section")
<h2>Detail Transaksi : {{Auth::user()->name}} && {{$transaksis->kodebayar}}</h2>
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
<p>tunggu barang dan persiapkan uangnya sebesar jumlah yang perlu dibayarkan di tempat/alamat yang anda inputkan</p>
<a href="{{url('adminpay')}}" class='btn btn-warning'>Back</a>
@endsection