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
            width: auto;
        }

        .btn-custom:hover {
            background-color: #157347;
            color: white;
        }

        .img-verifikasi {
            max-width: 350px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="col-lg-6 col-md-8 col-sm-12 border rounded-4 p-4 bg-white shadow">
            <div class="text-center">
                <h4 class="fw-bold mb-4">Verifikasi Akun</h4>
                <hr>

                @if (session()->has('success'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        {{ session()->get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session()->has('resent'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Link verifikasi baru telah dikirim ke email Anda.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="alert alert-primary text-dark" style="font-size: 14px">
                    Sebelum melanjutkan, silakan periksa email Anda
                    @if (Auth::check() && Auth::user()->email)
                        <b><i>{{ Auth::user()->email }}</i></b>
                    @else
                        <b><i>Email Anda</i></b>
                    @endif
                    untuk melakukan verifikasi.
                    Jika Anda belum menerima email,
                    klik tombol di bawah ini untuk mengirim ulang link verifikasi.
                </div>

                <div class="d-flex justify-content-center mb-4">
                    <img src="{{ asset('images/verificatuion.png') }}" width="200" class="img-fluid"
                        alt="Verifikasi Akun">
                </div>

                <div class="d-flex justify-content-between">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-warning">Kirim Ulang Link Verifikasi</button>
                    </form>

                    <a href="{{ route('login') }}" class="btn btn-primary">Kembali ke Halaman Login</a>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>

    <script>
        setTimeout(() => {
            const alert = document.querySelector('.alert-info');
            if (alert) {
                alert.style.display = 'none';
            }
        }, 5000);
    </script>
</body>

</html>
