@extends("layouts.design")

@section("title","$barang->namaproduk")

@section("section")
<h2>Edit Barang {{$barang->namaproduk}}</h2>
<p>User : {{Auth::user()->role}}</p>
<div class="container">
<form action="{{url('adminupdatebarang',$barang->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')
  <div class="mb-3">
    <label for="namaproduk" class="form-label">Nama Barang</label>
    <input type="text" class="form-control  @error('namaproduk') is-invalid @enderror" id="namaproduk" name="namaproduk" value="{{$barang->namaproduk}}">
  </div>
  <div class="mb-3">
    <label for="gambar" class="form-label">Gambar</label>
    <input type="file" class="form-control" id="gambar" name="gambar">
 </div>
  <div class="mb-3">
    <label for="hargabarang" class="form-label">Harga Barang</label>
    <input type="number" class="form-control @error('hargabarang') is-invalid @enderror" id="hargabarang" name="hargabarang" value="{{$barang->hargabarang}}">
  </div>
  <div class="mb-3">
    <label for="stokbarang" class="form-label">Stok Barang</label>
    <input type="number" class="form-control @error('stokbarang') is-invalid @enderror" id="stokbarang" name="stokbarang" value="{{$barang->stokbarang}}">
  </div>
  <div class="mb-3">
    <label for="kondisibarang" class="form-label">Kondisi Barang</label>
    <select name="kondisibarang" class="form-select" id="kondisibarang">
      <option value="Baru" {{$barang->kondisibarang == 'Baru' ? 'selected': ''}}>Baru</option>
      <option value="Bekas" {{$barang->kondisibarang == 'Bekas' ? 'selected': ''}}>Bekas</option>
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<a href="{{url('adminbarang')}}" class="btn btn-warning my-3">Back</a>
</div>
@endsection