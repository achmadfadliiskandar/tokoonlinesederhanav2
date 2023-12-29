@extends("layouts.design")

@section("title","Data Usaha")

@section("section")
<h2>Data Usaha</h2>
<p>User : {{Auth::user()->role}}</p>
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
@if (session('teguran'))
    <div class="alert alert-warning">
        {{ session('teguran') }} 
    </div>
@endif
<div class="container">
@forelse($penjuals as $penjual)
@if($penjual->photo == null)
<a href="{{url('penjualgambarusaha',$penjual->id.'/'.Auth::user()->id.'/'.Auth::user()->name)}}" class="btn btn-warning my-3">Tambah Gambar</a>
@else
<a href="{{url('penjualgambarusaha',$penjual->id.'/'.Auth::user()->id.'/'.Auth::user()->name)}}" class="btn btn-secondary my-3">Ubah Gambar</a>
@endif
<form action="{{url('penjualformulirsubmit/'.Auth::user()->id.'/'.Auth::user()->name)}}" method="post">
  @csrf
  @method('put')
<div class="mb-3">
  <label for="nama" class="form-label">Nama Toko</label>
  <input type="text" class="form-control" id="nama" name="namatoko" value="{{$penjual->namatoko}}">
</div>
<div class="mb-3">
  <label for="alamat" class="form-label">Alamat Toko</label>
  <textarea class="form-control" id="alamat" name="alamattoko" rows="3">{{$penjual->alamattoko}}</textarea>
</div>
<div class="mb-3">
  <label for="kodepos" class="form-label">Kode Pos</label>
  <input type="number" class="form-control" id="kodepos" name="kodepos" value="{{$penjual->kodepos}}">
</div>
<div class="mb-3">
  <label for="cabangtoko" class="form-label">cabang Toko</label>
  <input type="number" class="form-control" id="cabangtoko" name="cabangtoko" value="{{$penjual->cabangtoko}}">
  <div id="cabangtoko" class="form-text">*note : jika anda ingin memberi tahu berapa cabang toko/tempattoko usaha anda Apakah Memiliki cabang toko atau tidak kalau ada berapa</div>
</div>
<div class="mb-3">
  <label for="nomorrekening" class="form-label">Nomor Rekening</label>
  <input type="text" class="form-control" id="nomorrekening" name="nomorrekening" value="{{$penjual->nomorrekening}}">
  <div id="nomorrekening" class="form-text">*note : sebagai nomor yang tertera untuk pembeli/customer membayarkan belanjaanya kepada anda</div>
</div>
<div class="mb-3">
  <label for="bank" class="form-label">Bank</label>
  <select name="bank_id" class="form-select" id="banks_id">
    @foreach($banks as $bank)
    <option value="{{$bank->id}}" @selected($bank->id == $penjual->banks_id)>{{$bank->namabank}}</option>
    @endforeach
  </select>
  <div id="bank" class="form-text">*note : sebagai bank/ tujuan customer untuk membayar secara online dengan salah satu kartu bank yang anda punya</div>
</div>
<div class="mb-3">
  <label for="modaltoko" class="form-label">Modal Toko</label>
  <input type="number" class="form-control" id="modaltoko" name="modaltoko" value="{{$penjual->modaltoko}}">
</div>
<div class="mb-3">
  <label for="modaltoko" class="form-label">Photo Usaha</label>
  <input type="file" class="form-control" id="photousaha" name="photo">
</div>
<div class="mb-3">
  <label for="tahunbuka" class="form-label">Tahun Buka</label>
  <input type="number" class="form-control" id="tahunbuka" name="tahunbuka" value="{{$penjual->tahunbuka}}">
</div>
<div id="kategoriproduk" class="form-text">
  *note kategori  produk itu  menandakan bidang usaha anda dibidang apa seperti tokomumanparabot yang bergerak disektor parabot/jenis usaha barang parabotan/perabot
  boleh dipilih ataupun tidak
</div>
<!-- khusus formulir isi kosong -->
@empty
<div class="container">
<form action="{{url('penjualformulirsubmit/'.Auth::user()->id.'/'.Auth::user()->name)}}" method="post" enctype="multipart/form-data">
@csrf
<div class="mb-3">
  <label for="nama" class="form-label">Nama Toko</label>
  <input type="text" class="form-control" id="nama" name="namatoko" value="{{old('namatoko')}}">
</div>
<div class="mb-3">
  <label for="alamat" class="form-label">Alamat Toko</label>
  <textarea class="form-control" id="alamat" name="alamattoko" rows="3">{{old('alamattoko')}}</textarea>
</div>
<div class="mb-3">
  <label for="kodepos" class="form-label">Kode Pos</label>
  <input type="number" class="form-control" id="kodepos" name="kodepos" value="{{old('kodepos')}}">
</div>
<div class="mb-3">
  <label for="cabangtoko" class="form-label">cabang Toko</label>
  <input type="number" class="form-control" id="cabangtoko" name="cabangtoko" value="">
  <div id="cabangtoko" class="form-text">*note : jika anda ingin memberi tahu berapa cabang toko/tempattoko usaha anda Apakah Memiliki cabang toko atau tidak kalau ada berapa</div>
</div>
<div class="mb-3">
  <label for="nomorrekening" class="form-label">Nomor Rekening</label>
  <input type="text" class="form-control" id="nomorrekening" name="nomorrekening" value="{{old('nomorrekening')}}">
  <div id="nomorrekening" class="form-text">*note : sebagai nomor yang tertera untuk pembeli/customer membayarkan belanjaanya kepada anda</div>
</div>
<div class="mb-3">
  <label for="bank" class="form-label">Bank</label>
  <select name="bank_id" class="form-select" id="banks_id" required>
    @foreach($banks as $bank)
    <option value="{{$bank->id}}">{{$bank->namabank}}</option>
    @endforeach
  </select>
  <div id="bank" class="form-text">*note : sebagai bank/ tujuan customer untuk membayar secara online dengan salah satu kartu bank yang anda punya</div>
</div>
<div class="mb-3">
  <label for="modaltoko" class="form-label">Modal Toko</label>
  <input type="number" class="form-control" id="modaltoko" name="modaltoko" value="{{old('modaltoko')}}">
</div>
<div class="mb-3">
  <label for="modaltoko" class="form-label">Photo Usaha</label>
  <input type="file" class="form-control" id="photousaha" name="photo" value="">
</div>
<div class="mb-3">
  <label for="tahunbuka" class="form-label">Tahun Buka</label>
  <input type="number" class="form-control" id="tahunbuka" name="tahunbuka" value="">
</div>
<div id="kategoriproduk" class="form-text">
  *note kategori  produk itu  menandakan bidang usaha anda dibidang apa seperti tokomumanparabot yang bergerak disektor parabot/jenis usaha barang parabotan/perabot
  boleh dipilih ataupun tidak
</div>
<!-- end khusus formulir kosong -->
@endforelse
<button type="submit" class="btn btn-primary w-100 my-3">Submit</button>
</div>
</form>
@endsection