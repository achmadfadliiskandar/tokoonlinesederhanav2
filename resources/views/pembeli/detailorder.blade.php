@extends("layouts.design")

@section("title","Detail Transaksi")

@section("section")
<h2>Detail Transaksi : {{Auth::user()->name}}</h2>

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
<a href="{{url('pembeliorder/'.Auth::user()->id.'/'.Auth::user()->name)}}" class='btn btn-warning'>Back</a>
@endsection