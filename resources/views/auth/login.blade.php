@extends('layouts.auth')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
                <img src="{{asset('template/img/stisla-fill.svg')}}" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">
                <div class="card-header">
                    <h4>Masuk</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="Masukkan email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password" class="control-label">Kata Sandi</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password" placeholder="Masukkan kata sandi">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                Masuk
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mt-3 text-muted text-center">
                Belum mempunyai akun? <a href="{{__('register')}}">Daftar Sekarang</a>
            </div>
            <div class="simple-footer">
                Copyright &copy; Stisla 2018
            </div>
        </div>
    </div>
</div>
@endsection