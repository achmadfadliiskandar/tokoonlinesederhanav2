@extends("layout.mockup")

@section("title","Barang : $barang->namaproduk")

@section("header","Kategori : $kategoribarang")

@section("section")
<div class="row">
@if (session('warning'))
    <div class="alert alert-warning w-100">
        {{ session('warning') }}
    </div>
@endif
    <div class="col-6 col-md-6">
        <img src="{{asset('gambarbarang/'.$barang->gambar)}}" class="rounded img-fluid" alt="g ada gambar" style="width:600px;height:700px;">
    </div>
    <div class="col-6 col-md-6">.
        <h2 class='text-capitalize'>{{$barang->namaproduk}}</h2>
        <h4>{{number_format($barang->hargabarang)}}</h4>
        @auth
        <form action="{{url('addtocart',$barang->slug)}}" method="post">
            @csrf
            <label for="stok">Jumlah Beli</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="minus">-</span>
                <input type="number" class="form-control @error('stok') is-invalid @enderror" name="stok" placeholder="Recipient's username" value="1" id="place">
                <span class="input-group-text" id="plus">+</span>
            </div>
            @error('stok')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-outline-dark w-100">
                <i class="bi-cart-fill me-1"></i>
                Add To Cart
            </button>
            @endauth
            @guest
            <div class="alert alert-danger my-3">Silahkan Login Terlebih Dahulu Untuk Belanja</div>
            @endguest
        </form>
    </div>
    <script src="{{asset('javascript/script.js')}}" type="text/javascript"></script>
  </div>
@endsection