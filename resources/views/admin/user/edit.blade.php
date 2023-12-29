@extends("layouts.design")

@section("title","Ubah Data $userss->name")

@section("section")
<h2>Ubah Data User : {{$userss->name}}</h2>
<p>User : {{Auth::user()->role}}</p>
<div class="container">
<div class="card-body">
    <form method="POST" action="{{ url('adminupdateuser',$userss->id.$userss->name) }}">
    @csrf
    @method('put')
    <div class="row mb-3">
    <label for="name" class="col-md-12 col-form-label text-md-start">{{ __('Name') }}</label>

    <div class="col-md-12">
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $userss->name }}" required autocomplete="name" autofocus>

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
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $userss->email }}" required autocomplete="email">

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    </div>

    <div class="row mb-3">
        <label for="nomorhp" class="col-md-12 col-form-label text-md-start">{{ __('Nomor Hp') }}</label>

        <div class="col-md-12">
            <input id="nomorhp" type="nomorhp" class="form-control @error('nomorhp') is-invalid @enderror" name="nomorhp" value="{{$userss->nomorhp}}" required autocomplete="nomorhp">

            @error('nomorhp')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>


    <div class="row mb-3">
    <label for="alamat" class="col-md-4 col-form-label text-md-start">{{ __('Alamat') }}</label>

    <div class="col-md-12">
        <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" value="{{$userss->alamat}}" name="alamat" required>
    </div>
    </div>

    <div class="row mb-3">
    <label for="role" class="col-md-12 col-form-label text-md-start">{{ __('Role') }}</label>

    <div class="col-md-12">
    <select class="form-select @error('role') is-invalid @enderror" name="role" aria-label="Default select example">
        <option value="admin" {{$userss->role == 'admin' ? 'selected' : ''}}>Admin</option>
        <option value="penjual" {{$userss->role == 'penjual' ? 'selected' : ''}}>Penjual</option>
        <option value="pembeli" {{$userss->role == 'pembeli' ? 'selected' : ''}}>Pembeli</option>
    </select>
    </div>
    </div>

    <div class="row mb-0">
    <div class="col-md- offset-md-12">
        <button type="submit" class="btn btn-success w-100 my-3">
            {{ __('Update Sekarang') }}
        </button>
    </div>
    </div>
    </form>
</div>
</div>
@endsection