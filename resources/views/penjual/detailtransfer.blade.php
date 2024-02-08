@extends("layouts.design")

@section("title","Detail Transaksi")

@section("section")
<h2>Detail Transaksi : {{Auth::user()->name}}</h2>
<p>Alamat Pengiriman : {{$transaksis->alamatpengiriman}}</p>
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
      <th scope="col">Pemilik Barang</th>
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
        <td>
            @if($transaksi->barang->user->id == Auth::user()->id)
            <span class="text-success">barang ini punya saya</span>
            @else
            <span class="text-danger">bukan punya saya</span>
            @endif
        </td>
      </tr>
    @empty
    <div class="alert alert-danger">datanya kosong</div>
    @endforelse
  </tbody>
</table>
</div>
<div class="alert alert-info my-3">Total Semua : {{number_format($transaksis->totalsemuaharga)}}</div>
<form action="{{url('penjuallunas/'.$transaksis->id)}}" method="post" class="d-inline-block" onsubmit="return confirm('yakin??')">
  @csrf
  @method("PUT")
<button type="submit" class="btn btn-primary my-3">Lunaskan Sekarang</button>
</form>
<a href="{{url('penjualpembayaran')}}" class='btn btn-warning'>Back</a>
@endsection