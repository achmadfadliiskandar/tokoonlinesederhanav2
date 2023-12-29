@extends("layouts.design")

@section("title","Tambah Barang")

@section("section")
<h2>Tambah Barang</h2>
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
<form action="{{url('penjualstorebarang')}}" method="POST" enctype="multipart/form-data">
    @csrf
  <div class="mb-3">
    <label for="namaproduk" class="form-label">Nama Barang</label>
    <input type="text" class="form-control  @error('namaproduk') is-invalid @enderror" id="namaproduk" name="namaproduk" value="{{old('namaproduk')}}">
  </div>
  <div class="mb-3">
    <label for="gambar" class="form-label">Gambar</label>
    <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar" value="{{old('gambar')}}">
  </div>
  <div class="mb-3">
    <label for="hargabarang" class="form-label">Harga Barang</label>
    <input type="number" class="form-control @error('hargabarang') is-invalid @enderror" id="hargabarang" name="hargabarang" value="{{old('hargabarang')}}">
  </div>
  <div class="mb-3">
    <label for="stokbarang" class="form-label">Stok Barang</label>
    <input type="number" class="form-control @error('stokbarang') is-invalid @enderror" id="stokbarang" name="stokbarang" value="{{old('stokbarang')}}">
  </div>
  <div class="mb-3">
    <label for="kategoriproduk" class="form-label">Kategori Produk</label>
    <select name="kategories_id" id="kategories_id" class="form-select form-control" required>
    @foreach($kategoris as $kategori)
    <option value="{{$kategori->id}}">{{$kategori->kategori}}</option>
    @endforeach
    </select>
</div>
  <div class="mb-3">
    <label for="kondisibarang" class="form-label">Kondisi Barang</label>
    <select name="kondisibarang" class="form-select" id="kondisibarang">
      <option value="Baru">Baru</option>
      <option value="Bekas">Bekas</option>
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
@endsection