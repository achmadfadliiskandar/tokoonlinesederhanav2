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
@php
    $totalTransaksi = $transaksis->detailkeranjang->count();
    $lunasCount = $transaksis->detailkeranjang->where('statustransaksi', 'lunas')->count();
@endphp
<form action="{{url('penjuallunas')}}" method="post" onsubmit="return confirm('yakin??')">
  @csrf
<table class="table table-bordered table table-striped">
  <thead>
    <tr>
      <th scope="col">Checkbox</th>
      <th scope="col">No</th>
      <th scope="col">Nama Barang</th>
      <th scope="col">Jumlah Barang</th>
      <th scope="col">Harga Barang</th>
      <th scope="col">Totalharga</th>
      <th scope="col">Pemilik Barang</th>
      <th scope="col">Status Pembayaran</th>
    </tr>
  </thead>
  <tbody>
    @forelse($transaksis->detailkeranjang as $transaksi)
    <tr>
        <td>
        @if($transaksi->barang->user->id == Auth::user()->id)
           <input type="checkbox" name="id[]" value="{{$transaksi->id}}" checked>
        @else
          kosong
        @endif
        </td>
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
        <td>
        @if($transaksi->statustransaksi == "lunas")
            <span class="text-success">{{$transaksi->statustransaksi}}</span>
        @else
            <span class="text-danger">{{$transaksi->statustransaksi}}</span>
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
@if($transaksis->metodepembayaran == "cod")
<button type="submit" class="btn btn-primary my-3">Lunaskan Sekarang</button>
<!-- Tampilkan tombol istimewa jika semua transaksi lunas -->
@if ($totalTransaksi > 0 && $totalTransaksi === $lunasCount)
    <button class="btn btn-light">Istimewa</button>
@endif
@endif
</form>
<a href="{{url('penjualpembayaran')}}" class='btn btn-warning'>Back</a>
@endsection

<!-- @if($transaksis->metodepembayaran == "cod")
<form action="{{url('penjuallunas/'.$transaksis->id)}}" method="post" class="d-inline-block" onsubmit="return confirm('yakin??')">
  @csrf
  @method("PUT")
<button type="submit" class="btn btn-primary my-3">Lunaskan Sekarang</button>
</form>
<a href="{{url('penjualpembayaran')}}" class='btn btn-warning'>Back</a>
@else
<a href="{{url('penjualpembayaran')}}" class='btn btn-warning'>Back</a> 
@endif -->