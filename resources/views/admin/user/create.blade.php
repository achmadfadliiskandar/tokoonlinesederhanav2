@extends("layouts.design")

@section("title","Tambah User Baru")

@section("section")
<h2>Tambah User Baru</h2>
<p>User : {{Auth::user()->role}}</p>
<div class="container">
<div class="card-body">
    <form method="POST" action="{{ url('storeuser') }}">
    @csrf

    <div class="row mb-3">
    <label for="name" class="col-md-12 col-form-label text-md-start">{{ __('Name') }}</label>

    <div class="col-md-12">
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    </div>

    <div class="row mb-3">
    <label for="email" class="col-md-12 col-form-label text-md-start">{{ __('Email Address') }}</label>

    <div class="col-md-12">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    </div>

    <div class="row mb-3">
    <label for="password" class="col-md-12 col-form-label text-md-start">{{ __('Password') }}</label>

    <div class="col-md-12">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{old('password')}}" required autocomplete="new-password">

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    </div>

    <div class="row mb-3">
        <label for="nomorhp" class="col-md-4 col-form-label text-md-end">{{ __('Nomor Hp') }}</label>
        <div class="col-md-12">
            <input id="nomorhp" type="nomorhp" class="form-control @error('nomorhp') is-invalid @enderror" name="nomorhp" value="{{ old('nomorhp') }}" required autocomplete="nomorhp">
            @error('nomorhp')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>


    <div class="row mb-3">
    <label for="password-confirm" class="col-md-12 col-form-label text-md-start">{{ __('Confirm Password') }}</label>

    <div class="col-md-12">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
    </div>
    </div>

    <div class="row mb-3">
    <label for="alamat" class="col-md-4 col-form-label text-md-start">{{ __('Alamat') }}</label>

    <div class="col-md-12">
        <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" value="{{old('alamat')}}" name="alamat" required>
    </div>
    </div>

    <div class="row mb-3">
    <label for="role" class="col-md-12 col-form-label text-md-start">{{ __('Role') }}</label>

    <div class="col-md-12">
    <select class="form-select @error('role') is-invalid @enderror" name="role" aria-label="Default select example">
        <option value="">Open this select menu</option>
        <option value="admin">Admin</option>
        <option value="penjual">Penjual</option>
        <option value="pembeli">Pembeli</option>
    </select>
    </div>
    </div>

    <div class="row mb-0">
    <div class="col-md- offset-md-12">
        <button type="submit" class="btn btn-primary w-100 my-3">
            {{ __('Tambahkan Sekarang') }}
        </button>
    </div>
    </div>
    </form>
</div>
</div>
@endsection