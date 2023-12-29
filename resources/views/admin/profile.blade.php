@extends("layouts.design")

@section("title","Profile admin")

@section("section")
<h2>Profile : {{Auth::user()->name}}</h2>
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="container">
@foreach ($users as $value)
<form action="{{url('adminprofile/'.Auth::user()->id.'/'.Auth::user()->name)}}" method="post">
  @csrf
<div class="mb-3">
  <label for="nama" class="form-label">Nama</label>
  <input type="text" class="form-control" id="nama"name="name" value="{{$value->name}}">
</div>
<div class="mb-3">
  <label for="email" class="form-label">email</label>
  <input type="email" class="form-control" id="email"name="email" value="{{$value->email}}">
</div>
<div class="mb-3">
  <label for="email" class="form-label">Nomor Hp</label>
  <input type="text" class="form-control" id="nomorhp"name="nomorhp" value="{{$value->nomorhp}}">
</div>
<div class="mb-3">
  <label for="alamat" class="form-label">alamat</label>
  <textarea class="form-control" id="alamat" name="alamat" rows="3">{{$value->alamat}}</textarea>
</div>
@endforeach
<button type="submit" class="btn btn-primary w-100">Submit</button>
</div>
</form>
@endsection