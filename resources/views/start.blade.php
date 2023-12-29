@extends("layout.mockup")

@section("title","Muman Parabot Pembelanjaan Online Basis Web Laravel 10")

@section("header","Semua Barang")

@section("section")
<div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
@forelse($barangs as $barang)
    <div class="col mb-5">
        <div class="card h-100">
            <!-- Product image-->
            <img class="card-img-top" src="{{asset('gambarbarang/'.$barang->gambar)}}" alt="gambartidak ada" style="height:250px;">
            <!-- Product details-->
            <div class="card-body p-4">
                <div class="text-center">
                    <!-- Product name-->
                    <h5 class="fw-bolder">{{$barang->namaproduk}}</h5>
                    <!-- Product price-->
                    {{number_format($barang->hargabarang)}}
                </div>
            </div>
            <!-- Product actions-->
            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{url('detailbarang',$barang->slug)}}">View Product</a></div>
            </div>
        </div>
    </div>
@empty
<div class="alert alert-danger text-capitalize w-100">Barangnya Kosong</div>
@endforelse
</div>
@endsection