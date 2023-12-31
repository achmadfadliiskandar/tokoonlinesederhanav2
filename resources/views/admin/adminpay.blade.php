@extends("layouts.design")

@section("title","Data Bank")

@section("section")
<h2>Ruang Bank</h2>
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