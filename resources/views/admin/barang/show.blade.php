@extends("layouts.design")

@section("title","$barang->namaproduk")

@section("section")
<h2>{{$barang->namaproduk}}</h2>
<div class="container-fluid">
<div class="card mb-3" style="max-width: 1040px;">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="{{asset('gambarbarang/'.$barang->gambar)}}" class="img-fluid rounded-start" alt="gambar hidden">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">{{$barang->namaproduk}}</h5>
        <p class="card-text">Harga : {{number_format($barang->hargabarang)}}</p>
        <p class="card-text">stok : {{$barang->stokbarang}}</p>
        <p class="card-text">penjual : {{$barang->user->name}}</p>
        <p class="card-text">Toko Penyedia : {{$barang->penjual->namatoko}}</p>
        <p class="card-text">KondisiBarang : {{$barang->kondisibarang}}</p>
        <p class="card-text"><small class="text-body-secondary">dibuat :  {{$barang->created_at}}</small></p>
        <p class="card-text"><small class="text-body-secondary">diubah : {{$barang->updated_at}}</small></p>
      </div>
    </div>
  </div>
</div>
<a href="{{url('adminbarang')}}" class="btn btn-warning my-3">Back</a>
</div>
@endsection