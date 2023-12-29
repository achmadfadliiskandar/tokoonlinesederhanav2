@extends("layouts.design")

@section("title","Detail Toko $penjuall->namatoko")

@section("section")
<h2>Detail Toko ID : {{$penjuall->id}}</h2>
<p>User : {{Auth::user()->role}}</p>
<div class="card">
  <div class="card-header">
    {{$penjuall->namatoko}}
  </div>
  <div class="card-body">
    <h5 class="card-title">Pemilik : {{$penjuall->user->name}}</h5>
    <p class="card-text">Alamat : {{$penjuall->alamattoko}}</p>
    <p class="card-text">KodePos : {{$penjuall->kodepos}}</p>
    <p class="card-text">Cabang Toko : {{$penjuall->cabangtoko}}</p>
    <p class="card-text">Modal Toko : {{$penjuall->modaltoko}}</p>
    <p class="card-text">Tahun Buka : {{$penjuall->tahunbuka}}</p>
    <p class="card-text">Metode Pembayaran : {{$penjuall->metodepembayaran}}</p>
    <a href="{{url('adminchcktoko')}}" class="btn btn-danger">Back</a>
  </div>
  <div class="card-footer text-muted">
    Dibuat : {{$penjuall->created_at}}
  </div>
</div>
@endsection