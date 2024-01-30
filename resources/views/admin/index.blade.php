@extends("layouts.design")

@section("title","admin")

@section("section")
<h2>Ruang Admin</h2>
<p>User : {{Auth::user()->role}}</p>

<!-- sdashboard admin -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
        <div class="card text-white bg-primary mb-3" style="max-width: 100%;">
            <div class="card-header">User</div>
            <div class="card-body">
                <h5 class="card-title">{{$cuser}}</h5>
            </div>
            </div>
        </div>
        <div class="col-sm-6">
        <div class="card text-white bg-secondary mb-3" style="max-width: 100%;">
            <div class="card-header">Daftar Usaha</div>
            <div class="card-body">
                <h5 class="card-title">{{$penjual}}</h5>
            </div>
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col-sm-6">
    <div class="card text-white bg-warning mb-3" style="max-width: 100%;">
            <div class="card-header">Kategori</div>
            <div class="card-body">
                <h5 class="card-title">{{$kategori}}</h5>
            </div>
            </div>
    </div>
    <div class="col-sm-6">
    <div class="card text-white bg-danger mb-3" style="max-width: 100%;">
        <div class="card-header">Bank</div>
        <div class="card-body">
            <h5 class="card-title">{{$bank}}</h5>
        </div>
        </div>
    </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
        <div class="card text-white bg-dark mb-3" style="max-width: 100%;">
            <div class="card-header">Barang</div>
            <div class="card-body">
                <h5 class="card-title">{{$barang}}</h5>
            </div>
            </div>
        </div>
        <div class="col-lg-6">
        <div class="card text-white bg-info mb-3" style="max-width: 100%;">
            <div class="card-header">Pembeli</div>
            <div class="card-body">
                <h5 class="card-title">{{$pembeli}}</h5>
            </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
        <div class="card text-white bg-success mb-3" style="max-width: 100%;">
            <div class="card-header">Barang Yang Terjual</div>
            <div class="card-body">
                <h5 class="card-title">{{$transaksii}}</h5>
            </div>
            </div>
        </div>
        <div class="col-lg-6">
        <div class="card text-dark bg-light mb-3" style="max-width: 100%;">
            <div class="card-header">Transaksi</div>
            <div class="card-body">
                <h5 class="card-title">{{$transaksi}}</h5>
            </div>
            </div>
        </div>
    </div>
<div class="row">
    <div class="col-lg-12">
       <div class="card">
       <div class="card-header">
       <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation" style="width:50%;">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Barang Yang Paling Banyak Terjual</button>
            </li>
            <li class="nav-item" role="presentation" style="width:50%;">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Penjual Terlaris</button>
            </li>
            </ul>
        </div>
        <div class="card-body">
           <div class="container-fluid">
           <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
            <h2>Barang</h2>
            @forelse($detailbarang as $data)
               <p>{{$data->barang->namaproduk}} : Total : {{$data->total}}</p>
               @empty
               <div class="alert alert-danger">belum ada pembelian</div>
               @endforelse
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
            <h2>Penjual</h2>
            @forelse($detailkeranjang as $data)
               <p>{{$data->penjuals->namatoko}} : Total : {{$data->total}} -> {{$data->penjuals->user->name}}</p>
               @empty
               <div class="alert alert-danger">belum ada pembelian</div>
               @endforelse
            </div>
            </div>
           </div>
        </div>
    </div>
    </div>
    </div>
</div>
<!-- edashboard admin -->
@endsection