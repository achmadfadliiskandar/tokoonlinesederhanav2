@extends("layouts.design")

@section("title","Ubah Password")

@section("section")
<h2>Ubah Password</h2>
<p>User : {{Auth::user()->role}}</p>
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<div class="container">
<form action="{{url('adminchpwd')}}" method="post">
  @csrf
<div class="mb-3">
  <label for="passwordlama" class="form-label">Password Lama</label>
  <input type="password" class="form-control @error('passwordlama') is-invalid @enderror" id="passwordlama" name="passwordlama" value="{{old('passwordlama')}}">
  @error('passwordlama')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
</div>
<div class="mb-3">
  <label for="passwordbaru" class="form-label">Password Baru</label>
  <input type="password" class="form-control @error('passwordbaru') is-invalid @enderror" id="passwordbaru" name="passwordbaru">
  @error('passwordbaru')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
</div>
<div class="mb-3">
  <label for="konfirmasipassword" class="form-label">Konfirmasi Password</label>
  <input type="password" class="form-control @error('konfirmasipassword') is-invalid @enderror" id="konfirmasipassword" name="konfirmasipassword">
</div>
<button type="submit" class="btn btn-primary w-100">Submit</button>
</div>
</form>
@endsection