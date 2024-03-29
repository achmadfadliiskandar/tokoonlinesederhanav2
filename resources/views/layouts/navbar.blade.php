<div class="col-lg-10" id="kanan">
<div id="tempakanan">
<nav class="navbar border-bottom border-body" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand text-capitalize" href="#">{{Auth::user()->name}}</a>
    <button class="btn btn-primary" id="canvassmb" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">Enable body scrolling</button>
    <!-- ovv canvas for mobile -->
    <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasScrollingLabel">WarungWeb</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
        <ul class="nav flex-column nav nav-pills text-left">
        @if(Auth::user()->role == 'admin')
        <li class="nav-item">
            <a class="nav-link {{(request()->is('admin')) ? 'active' : '' }}" aria-current="page" href="{{url('admin')}}">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-capitalize {{(request()->is('adminprofile/'.Auth::user()->id.'/'.Auth::user()->name)) ? 'active' : '' }}" href="{{url('adminprofile/'.Auth::user()->id.'/'.Auth::user()->name)}}">Profile {{Auth::user()->name}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-capitalize {{(request()->is('adminuser')) ? 'active' : '' }}" href="{{url('adminuser')}}">Data User</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-capitalize {{(request()->is('adminchangepwd')) ? 'active' : '' }}" href="{{url('adminchangepwd')}}">Ubah Password</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-capitalize {{(request()->is('adminchcktoko')) ? 'active' : '' }}" href="{{url('adminchcktoko')}}">Data Toko</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-capitalize {{(request()->is('adminbarang')) ? 'active' : '' }}" href="{{url('adminbarang')}}">Data Barang</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-capitalize {{(request()->is('adminkategori')) ? 'active' : '' }}" href="{{url('adminkategori')}}">Data Kategori</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-capitalize {{(request()->is('adminbank')) ? 'active' : '' }}" href="{{url('adminbank')}}">Data Bank</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-capitalize {{(request()->is('adminpay')) ? 'active' : '' }}" href="{{url('adminpay')}}">Data Pembayaran</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-capitalize {{(request()->is('adminkurir')) ? 'active' : '' }}" href="{{url('adminkurir')}}">Data Kurir</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-capitalize {{(request()->is('adminsetting')) ? 'active' : '' }}" href="{{url('adminsetting')}}">Pengaturan WarungWeb</a>
        </li>
        @endif
        @if(Auth::user()->role == 'penjual')
        <li class="nav-item">
            <a class="nav-link {{(request()->is('penjual')) ? 'active' : '' }}" aria-current="page" href="{{url('penjual')}}">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-capitalize {{(request()->is('penjualprofile/'.Auth::user()->id.'/'.Auth::user()->name)) ? 'active' : '' }}" href="{{url('penjualprofile/'.Auth::user()->id.'/'.Auth::user()->name)}}">Profile {{Auth::user()->name}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-capitalize {{(request()->is('datausahapenjual/'.Auth::user()->id.'/'.Auth::user()->name)) ? 'active' : '' }}" href="{{url('datausahapenjual/'.Auth::user()->id.'/'.Auth::user()->name)}}">Daftar Usaha</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-capitalize {{(request()->is('penjualchangepwd')) ? 'active' : '' }}" href="{{url('penjualchangepwd')}}">Ubah Password</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-capitalize {{(request()->is('penjualbarang')) ? 'active' : '' }}" href="{{url('penjualbarang')}}">Penjual Barang</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-capitalize {{(request()->is('penjualpembayaran')) ? 'active' : '' }}" href="{{url('penjualpembayaran')}}">Kelola Pembayaran</a>
        </li>
        @endif
        @if(Auth::user()->role == 'pembeli')
        <li class="nav-item">
            <a class="nav-link {{(request()->is('pembeli')) ? 'active' : '' }}" aria-current="page" href="{{url('pembeli')}}">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-capitalize {{(request()->is('pembeliprofile/'.Auth::user()->id.'/'.Auth::user()->name)) ? 'active' : '' }}" href="{{url('pembeliprofile/'.Auth::user()->id.'/'.Auth::user()->name)}}">Profile {{Auth::user()->name}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-capitalize {{(request()->is('pembelichangepwd')) ? 'active' : '' }}" href="{{url('pembelichangepwd')}}">Ubah Password</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-capitalize {{(request()->is('pembeliorder/'.Auth::user()->id.'/'.Auth::user()->name)) ? 'active' : '' }}" href="{{url('pembeliorder/'.Auth::user()->id.'/'.Auth::user()->name)}}">Pembeli Order</a>
        </li>
        @endif

        <li class="nav-item">
            <a class="nav-link" href="{{url('/home')}}">Back To Home</a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" href="#">Log out</a>
        </li> -->
        </ul>
        </div>
        <!-- ovv canfas for mobile -->
        </div>
  </div>
</nav>