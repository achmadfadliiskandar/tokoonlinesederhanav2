@extends("layouts.design")

@section("title","Data Kategori")

@section("section")
<h2>Ruang Kategori</h2>
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
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="table-responsive">
<table class="table table-bordered table table-striped" id="example">
<caption> Jumlah data ada : {{$kategories->count()}}</caption>
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Kategori</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($kategories as $kategori)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$kategori->kategori}}</td>
        <td>
            <form action="{{url('admindeletekategori',$kategori->id)}}" method="post" onsubmit="return confirm('yakin datanya mau dihapus ? ')">
              @csrf
              @method("DELETE")
                <button type="submit" class="btn btn-danger my-3 w-100">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
  </tbody>
  <tr>
        <td colspan="3">
        <form action="{{url('adminaddkategori')}}" method="post">
        @csrf
        <div class="mb-3">
            <label for="kategori">Kategori</label>
            <input type="text" placeholder="isi Kategori Disini" name="kategori" id="kategori" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </td>
    </tr>
</table>
</div>
</div>
@endsection