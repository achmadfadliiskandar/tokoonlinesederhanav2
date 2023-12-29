@extends("layout.mockup")

@section("title","Form Checkout")

@section("header","Checkout Form")

@section("section")
<div class="row">
    <div class="col-sm-6">
        <form action="{{url('fixedcheckout')}}" method="post" onsubmit="return confirm('are you sure?')">
            @csrf
            <div class="mb-3">
                <label for="alamat pengiriman">Alamat Pengiriman</label>
                <textarea class="form-control @error('alamatpengiriman') is-invalid @enderror" placeholder="Leave a comment here" id="floatingTextarea2" name="alamatpengiriman"></textarea>
            </div>
            <div class="mb-3">
                <label for="methodepembayaran">Metode Pembayaran</label>
                <select class="form-select @error('metodepembayaran') is-invalid @enderror" aria-label="Default select example" name="metodepembayaran">
                    <option value="" selected disabled>Pilih Metode Pembayaran</option>
                    <option value="cod">Cash On Delivery</option>
                    <option value="transfer">Transfer</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
    </div>
    <div class="col-sm-6">
    <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-primary">Your cart</span>
          <span class="badge bg-primary rounded-pill">{{Auth::user()->keranjang->count()}}</span>
        </h4>
    <div class="card" style="width: 100%;">
        <div class="card-header">
            Barang Belanjaan Anda
        </div>
        <ul class="list-group list-group-flush">
        @foreach($keranjangs as $keranjang)
        <li class="list-group-item">{{$keranjang->barang->namaproduk}} : {{number_format($keranjang->barang->hargabarang)}} * {{$keranjang->stok}} = {{number_format($keranjang->barang->hargabarang * $keranjang->stok)}}</li>
        @endforeach
        </ul>
        <div class="card-footer text-body-secondary">
    Total : {{number_format(Auth::user()->keranjang->sum("totalharga"))}}
    </div>
    </div>
    </div>
</div>
@endsection