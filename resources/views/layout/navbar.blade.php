<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!">Warung Web</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{url('/')}}">Home</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Kategori</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{url('/allproduct')}}">All Products</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                @foreach($kategoris as $kategori)
                                <li><a class="dropdown-item" href="{{url('detailkategori',$kategori->kategori)}}">{{$kategori->kategori}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <form method="GET" action="{{url('filterprice')}}" class="d-flex me-2" role="search">
                        <select class="form-select" aria-label="Default select example" name="filterprice">
                            <option selected disabled>Pilih Filter Harga</option>
                            <option value="Harga-Tertinggi-Terendah">Harga Tertinggi-Terendah</option>
                            <option value="Harga-Terendah-Tertinggi">Harga Terendah-Tertinggi</option>
                            <option value="Harga-Dibawah-10rb">Harga < 10 Ribu</option>
                        </select>
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                        <form method="GET" action="{{url('searchproduct')}}" class="d-flex" role="search">
                            <input class="form-control @error('search') is-invalid @enderror" type="search" name="search" required placeholder="Search nama barang" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </ul>
                    @auth
                    <a href="{{url('cart')}}" class="btn btn-outline-dark ms-3">
                        <i class="bi-cart-fill me-l"></i>
                        Cart
                        <span class="badge bg-dark text-white ms-1 rounded-pill">{{Auth::user()->keranjang->count()}}</span>
                    </a>
                    @endauth
                </div>
            </div>
</nav>