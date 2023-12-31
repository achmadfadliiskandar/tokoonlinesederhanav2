@extends('layouts.app')

@section('title','Dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="alert alert-info">Note* : Jika ingin mendaftar menjadi penjual silahkan hubungi nomor admin : <a href="https://wa.me/621905157614?text=sayamaudaftarjadipenjual">Hubungi Saya</a></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
