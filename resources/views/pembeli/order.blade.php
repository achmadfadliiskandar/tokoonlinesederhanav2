@extends("layouts.design")

@section("title","Transaksi Anda")

@section("section")
<h2 class='text-capitalize'>Transaksi Anda</h2>
<div class="table-responsive">
<table class="table table-bordered table table-striped" id="example">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Alamat Pengiriman</th>
      <th scope="col">Tanggal Pemesanan</th>
      <th scope="col">Kode Bayar</th>
      <th scope="col">Status Pembayaran</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <tr>
    @forelse($transaksis as $transaksi)
        <td>{{$loop->iteration}}</td>
        <td>{{$transaksi->alamatpengiriman}}</td>
        <td>{{$transaksi->tanggaltransaksi}}</td>
        <td>{{$transaksi->kodebayar}}</td>
        @if($transaksi->statustransaki == "lunas")
        <td class='text-success'>{{$transaksi->statustransaksi}}</td>
        @else
        <td class='text-danger'>{{$transaksi->statustransaksi}}</td>
        @endif
        <td><a href="{{url('detailorder/'.$transaksi->kodebayar)}}" class="btn btn-info">Detail Transaksi</a></td>
    </tr>
    @empty
    <td colspan="6">kosong</td>
    @endforelse
  </tbody>
</table>
</div>
@endsection