@extends("layouts.design")

@section("title","penjual")

@section("section")
<h2>Data Barang</h2>
<p>User : {{Auth::user()->role}}</p>
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<a href="{{url('penjualaddbarang')}}" class="btn btn-primary my-3">Tambah Barang</a>
<div class="container">
    <div class="table-responsive">
    <table class="table table-bordered table table-striped" id="example">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama Barang</th>
      <th scope="col">Jumlah Barang</th>
      <th scope="col">Harga Barang</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
   @forelse($barangs as $barang)
<tr>
   <td>{{$loop->iteration}}</td>
   <td>{{$barang->namaproduk}}</td>
   <td>{{$barang->stokbarang}}</td>
   <td>{{number_format($barang->hargabarang)}}</td>
   <td>
    <a href="{{url('penjualshowbarang',$barang->slug)}}" class="btn btn-info">Detail</a>
    <a href="{{url('penjualeditbarang',$barang->slug)}}" class="btn btn-success">Edit</a>
    <form action="{{url('penjualdeletebarang',$barang->id)}}" method="post" onsubmit="return confirm('yakin mau dihapus')">
      @csrf
      @method("DELETE")
        <button type="submit" class="btn btn-danger my-3">Hapus</button>
    </form>
   </td>
   @empty
   <td colspan=5 class="text-center">Datanya Belum ada</td>
</tr>
   @endforelse
  </tbody>
</table>
    </div>
</div>
@endsection