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
    <div class="col-lg-12">
        <div class="card text-white bg-success mb-3" style="max-width: 100%;">
            <div class="card-header">Penjual</div>
            <div class="card-body">
                <h5 class="card-title">{{$penjuals}}</h5>
            </div>
            </div>
        </div>
    </div>
</div>
<!-- edashboard admin -->
@endsection