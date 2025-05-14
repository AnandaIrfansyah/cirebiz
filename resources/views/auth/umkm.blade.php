@extends('auth.layouts.auth')

@section('title', 'Register UMKM')

@section('main')
    <div class="card card-primary">
        <div class="card-header text-center">
            <h4>Daftar Sebagai UMKM</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('register.umkm.post') }}">
                @csrf

                <div class="form-group">
                    <label for="name">Nama Pemilik</label>
                    <input id="name" type="text" class="form-control" name="name" required autofocus>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control" name="password" required>
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="terms" class="custom-control-input" id="terms" required>
                        <label class="custom-control-label" for="terms">
                            Saya menyetujui <a href="#" class="text-primary font-weight-bold">syarat dan tujuan</a>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        Daftar
                    </button>
                </div>

                <div class="text-center mt-4 mb-3">
                    <div class="text-muted">Sudah Punya Akun?</div>
                </div>
                <div class="text-center">
                    <a class="btn btn-secondary btn-lg btn-block" href="{{ route('login') }}">
                        Login
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
