@extends("layouts.design")

@section("title","Pengaturan WarungWeb")

@section("section")
<h2>Profile : {{Auth::user()->name}}</h2>
<p class='text-capitalize'>ubah web/kreasi web <b>sementara</b> disini</p>
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="container">
<form action="{{url('adminchangesetting')}}" method="post">
  @csrf
<div class="mb-3">
  <label for="navbar" class="form-label">Navbar</label>
  <input type="color" class="form-control" id="navbar"name="navbar" value="{{session('navbar')}}">
</div>
<div class="mb-3">
  <label for="sidebar" class="form-label">Sidebar</label>
  <input type="color" class="form-control" id="sidebar"name="sidebar" value="{{session('sidebar')}}">
</div>
<div class="mb-3">
  <label for="footer" class="form-label">Footer</label>
  <input type="color" class="form-control" id="footer"name="footer" value="{{session('footer')}}">
</div>
<button type="submit" class="btn btn-primary w-100">Submit</button>
</div>
</form>
@endsection