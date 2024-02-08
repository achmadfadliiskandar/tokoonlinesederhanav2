@extends("layouts.design")

@section("title","Data Pembayaran")

@section("section")
<h2>Ruang Pembayaran</h2>
<p>User : {{Auth::user()->role}}</p>
<div class="container">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="table-responsive">
<table class="table table-bordered table table-striped" id="example">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">User</th>
      <th scope="col">Tanggal Pembayaran</th>
      <th scope="col">Status</th>
      <th scope="col">Kode Pembayaran</th>
      <th scope="col">Metode Pembayaran</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($transaksis as $transaksi)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$transaksi->user->name}}</td>
        <td>{{$transaksi->tanggaltransaksi}}</td>
        <td><span class="text-dark">{{$transaksi->statustransaksi}}</span></td>
        <td>{{$transaksi->kodebayar}}</td>
        <td>{{$transaksi->metodepembayaran}}</td>
        <td>
            <a href="{{url('detailtransfer/'.$transaksi->id)}}" class="btn btn-info">Detail Transaksi</a>
        </td>
    </tr>
    @endforeach
  </tbody>
</table>
<h3>Note</h3>
<p>*pending : tunggu sampai anda  menyatakan statusnya lunas lalu silahkan siap2 mengantarkan barang</p>
<p>*lunas :  pembeli sudah membayar barangnya silahkan bersiap untuk mengantarkan</p>
</div>
</div>
@endsection