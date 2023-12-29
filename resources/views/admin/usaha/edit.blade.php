@extends("layouts.design")

@section("title","Tambah Toko")

@section("section")
<h2>Tambah Toko</h2>
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
<form action="{{url('adminupdatetoko',$penjuals->id)}}" method="post">
@csrf
@method('put')
<div class="mb-3">
  <label for="nama" class="form-label">Nama Toko</label>
  <input type="text" class="form-control @error('namatoko') is-invalid @enderror" id="nama" name="namatoko" value="{{$penjuals->namatoko}}">
</div>
<div class="mb-3">
    <label for="nama" class="form-label">Pemilik Toko</label>
    <select class="form-select" name="user_id" aria-label="Default select example">
    <option selected disabled>Pilih User/Pemilik Toko</option>
    @foreach($users as $user)
    <option value="{{$user->id}}" @selected($user->id == $penjuals->user->id)>{{$user->name}} - {{$user->role}}</option>
    @endforeach
    </select>
</div>
<div class="mb-3">
  <label for="alamat" class="form-label">Alamat Toko</label>
  <textarea class="form-control @error('alamattoko') is-invalid @enderror" id="alamat" name="alamattoko" rows="3">{{$penjuals->alamattoko}}</textarea>
</div>
<div class="mb-3">
  <label for="kodepos" class="form-label">Kode Pos</label>
  <input type="number" class="form-control @error('kodepos') is-invalid @enderror" id="kodepos" name="kodepos" value="{{$penjuals->kodepos}}">
</div>
<div class="mb-3">
  <label for="cabangtoko" class="form-label">cabang Toko</label>
  <input type="number" class="form-control @error('cabangtoko') is-invalid @enderror" id="cabangtoko" name="cabangtoko" value="{{$penjuals->cabangtoko}}">
  <div id="cabangtoko" class="form-text">*note : jika anda ingin memberi tahu berapa cabang toko/tempattoko usaha anda Apakah Memiliki cabang toko atau tidak kalau ada berapa</div>
</div>
<div class="mb-3">
  <label for="modaltoko" class="form-label">Modal Toko</label>
  <input type="number" class="form-control @error('modaltoko') is-invalid @enderror" id="modaltoko" name="modaltoko" value="{{$penjuals->modaltoko}}">
</div>
<div class="mb-3">
  <label for="tahunbuka" class="form-label">Tahun Buka</label>
  <input type="number" class="form-control @error('tahunbuka') is-invalid @enderror" id="tahunbuka" name="tahunbuka" value="{{$penjuals->tahunbuka}}">
</div>
<div class="mb-3">
  <label for="metodepembayaran" class="form-label">Metode Pembayaran</label>
<select class="form-select form-control" name="metodepembayaran" aria-label="Default select example">
  <option value="fleksibel" @selected($penjuals->metodepembayaran == "flexibel")>Flexibel</option>
  <option value="online" @selected($penjuals->metodepembayaran == "online")>Online</option>
  <option value="cash" @selected($penjuals->metodepembayaran == "cash")>Cash/Offline</option>
</select>
<div id="metodepembayaran" class="form-text">
    *note
    Flexibel : pembayaran bisa dilakukan secara online/offline
    Online : pembayaran hanya bisa dilakukan secara online/transfer
    offline:tidak menerima pembayaran online/transfer
  </div>
</div>
<!-- end khusus formulir kosong -->
<button type="submit" class="btn btn-success w-100 my-3">Submit</button>
</form>
</div>
@endsection