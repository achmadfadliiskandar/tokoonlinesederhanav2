@extends("layouts.design")

@section("title","Data User")

@section("section")
<h2>Ruang User</h2>
<p>User : {{Auth::user()->role}}</p>
<a href="{{url('adminadduser')}}" class="btn btn-primary my-3">Tambah User</a>
<div class="container">
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="table-responsive">
<table class="table table-bordered table table-striped" id="example">
<caption> Jumlah data ada : {{$users->count()}}</caption>
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama</th>
      <th scope="col">email</th>
      <th scope="col">Peran</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $user)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->role}}</td>
        <td>
            @if($user->role == 'admin')
            <a href="{{url('adminedituser',$user->id.$user->name)}}" class="btn btn-success">edit</a>
            <p>anda adalah admin</p>
            @else
            <a href="{{url('adminedituser',$user->id.$user->name)}}" class="btn btn-success">edit</a>
            <form action="{{url('admindeleteuser',$user->id.$user->name)}}" method="post" class="my-3" onsubmit="return confirm('apa kamu yakin ?');">
              @csrf
              @method('delete')
                <button class="btn btn-danger">hapus</button>
            </form>
            @endif
        </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
</div>
@endsection