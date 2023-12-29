@extends("layouts.design")

@section("title","penjual")

@section("section")
<h2>Ruang Penjual</h2>
<p>User : {{Auth::user()->role}}</p>
@endsection