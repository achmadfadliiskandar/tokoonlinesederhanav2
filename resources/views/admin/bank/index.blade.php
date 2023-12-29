@extends("layouts.design")

@section("title","Data Bank")

@section("section")
<h2>Ruang Bank</h2>
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
<caption> Jumlah data ada : {{$banks->count()}}</caption>
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama Bank</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($banks as $bank)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$bank->namabank}}</td>
        <td>
            <form action="{{url('admindeletebank',$bank->id)}}" method="post" onsubmit="return confirm('yakin datanya mau dihapus ? ')">
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
        <form action="{{url('adminaddbank')}}" method="post">
        @csrf
        <div class="mb-3">
            <label for="kategori">Nama Bank</label>
            <input type="text" placeholder="isi Bank Disini" name="namabank" id="namabank" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </td>
    </tr>
</table>
</div>
</div>
@endsection