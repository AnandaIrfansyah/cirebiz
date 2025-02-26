<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verifikasi Akun</title>
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            background: #f8f9fa;
            height: 100vh;
        }

        .card-custom {
            border-radius: 15px;
            padding: 30px;
            background: #ffffff;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            border-top: 5px solid #198754;
        }

        .btn-custom {
            background-color: #198754;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            color: white;
        }

        .btn-custom:hover {
            background-color: #157347;
            color: white;
        }

        .alert-custom {
            font-size: 14px;
        }
    </style>
</head>

<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="col-lg-6 col-md-8 col-sm-12 p-4 bg-white rounded-4 shadow card-custom">
        <div class="text-center">
            <h4 class="fw-bold mb-4">Verifikasi Akun</h4>
            <hr>
            @if (session()->has('success'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    {{ session()->get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if (session()->has('resent'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Link verifikasi baru telah dikirim ke email Anda.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            <div class="alert alert-primary alert-custom">
                Sebelum melanjutkan, silakan periksa email Anda
                <b><i>{{ Auth::check() && Auth::user()->email ? Auth::user()->email : 'Email Anda' }}</i></b>
                untuk melakukan verifikasi. Jika belum menerima email, klik tombol di bawah ini.
            </div>
            <div class="alert alert-danger alert-custom">
                Silakan kirim ulang verifikasi atau klik tombol verifikasi di email jika login masih belum berhasil.
            </div>
            <img src="{{ asset('images/verificatuion.png') }}" width="200" class="img-fluid mb-4"
                alt="Verifikasi Akun">
            <div class="d-flex justify-content-between">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-custom">Kirim Ulang Link</button>
                </form>
                <a href="{{ route('login') }}" class="btn btn-custom">Kembali ke Login</a>
            </div>
        </div>
    </div>
    <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
