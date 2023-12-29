@extends("layouts.design")

@section("title","Data Toko")

@section("section")
<h2>Ruang Toko</h2>
<p>User : {{Auth::user()->role}}</p>
<div class="alert alert-info">note* : Data ini Berisi informasi penjual/pedagang/pengelola yang telah mendaftarkan usahanya ke situs ini</div>
<a href="{{url('adminaddtoko')}}" class="btn btn-primary my-3">Tambah User</a>
<div class="container">
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="table-responsive">
<table class="table table-bordered table table-striped" id="example">
<caption> Jumlah data ada : {{$penjuals->count()}}</caption>
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama Usaha</th>
      <th scope="col">Alamat</th>
      <th scope="col">Pengelola/Pemilik</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($penjuals as $penjual)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$penjual->namatoko}}</td>
        <td>{{$penjual->alamattoko}}</td>
        <td>{{$penjual->user->name}}</td>
        <td class="text-center">
            <a href="{{url('adminshowtoko',$penjual->id)}}" class="btn btn-secondary">Detail</a>
            <a href="{{url('adminedittoko',$penjual->id)}}" class="btn btn-success">Edit</a>
            <form action="{{url('adminhapustoko',$penjual->id)}}" method="post" onsubmit="return confirm('yakin datanya mau dihapus ? ')">
              @csrf
              @method("DELETE")
                <button type="submit" class="btn btn-danger my-3">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
</div>
@endsection