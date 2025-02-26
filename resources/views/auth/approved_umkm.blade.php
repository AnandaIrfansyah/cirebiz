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

<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="col-lg-5 col-md-8 col-sm-12 card-custom">
            <img src="{{ asset('images/verify.jpg') }}" alt="Verifikasi" class="img-fluid img-verifikasi">

            <h4 class="fw-bold text-dark">Akun Anda Menunggu Verifikasi</h4>
            <p class="text-muted">Pendaftaran Anda telah berhasil. Mohon tunggu verifikasi dari admin sebelum bisa
                login.</p>

            <a href="{{ route('login') }}" class="btn btn-custom mt-3">
                <i class="fas fa-arrow-left"></i> Kembali ke Halaman Login
            </a>
        </div>
    </div>
</body>

</html>
