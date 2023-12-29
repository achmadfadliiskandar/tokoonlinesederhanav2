@extends("layouts.design")

@section("title","Logo Usaha")

@section("section")
<h2>Logo Usaha</h2>
<p>User : {{Auth::user()->role}}</p>
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="container">
@foreach($penjuals as $penjual)
@if($penjual->photo == null)
<div class="alert alert-danger text-capitalize">Belum ada logo</div>
<form action="{{url('penjualupgambar',$penjual->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method("put")
    <div class="mb-3">
        <label for="photo">Logo Usaha</label>
        <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" id="photo" required>
    </div>
<button type="submit" class="btn btn-primary my-3 w-100">Tambah Logo</button>
</form>
@else
<img src="{{asset('photousaha/'.$penjual->photo)}}" class="img-fluid" alt="gambar">
<form action="{{url('penjualupgambar',$penjual->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method("put")
    <div class="mb-3">
        <label for="photo">Logo Usaha</label>
        <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" id="photo" required>
    </div>
<button type="submit" class="btn btn-success my-3 w-100">Ubah Logo</button>
</form>
@endif
@endforeach
<a href="{{url('datausahapenjual/'.Auth::user()->id.'/'.Auth::user()->name)}}" class="btn btn-danger my-3">Back</a>
</div>
</form>
@endsection