@extends("layouts.design")

@section("title","Data Pembayaran")

@section("section")
<h2>Ruang Pembayaran</h2>
<p>User : {{Auth::user()->role}}</p>
<ul class="nav nav-pills nav-fill my-3">
  <li class="nav-item">
    <a class="nav-link {{request()->is('adminpay')?'active':''}}" aria-current="page" href="{{url('adminpay')}}">Pembayaran W Cod</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{request()->is('adminpaytf')?'active':''}}" href="{{url('adminpaytf')}}">Pembayaran W Transfer</a>
  </li>
</ul>
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
<form action="{{url('adminlunas')}}" method="post">
  @csrf
<button type="submit" class="btn btn-primary my-3">Lunaskan Semua</button>
</form>
<div class="table-responsive">
<table class="table table-bordered table table-striped" id="example">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">User</th>
      <th scope="col">Tanggal Pembayaran</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($transaksisss as $transaksi)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$transaksi->user->name}}</td>
        <td>{{$transaksi->tanggaltransaksi}}</td>
        <td>
            @if($transaksi->statustransaksi == "pending")
            <span class="text-danger">{{$transaksi->statustransaksi}}</span>
            @else 
            <span class="text-info">{{$transaksi->statustransaksi}}</span>
            @endif
        </td>
        <td>
            <form action="{{url('adminupdatepembayaran/'.$transaksi->id)}}" method="post">
                @csrf
                @method("PUT")
                <button type="submit" class="btn btn-success">Lunaskan</button>
            </form>
        </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
</div>
@endsection