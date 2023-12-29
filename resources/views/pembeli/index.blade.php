@extends("layouts.design")

@section("title","pembeli")

@section("section")
<h2>Ruang Pembeli</h2>
<p>User : {{Auth::user()->role}}</p>
@endsection