@extends('layout.umkm.layouts.app')

@section('title', 'Profil')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('admin/library/bootstrap-social/bootstrap-social.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/library/summernote/dist/summernote-bs4.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Profile</h1>
            </div>
            <div class="section-body">

                <div class="row mt-sm-4">
                    @foreach ($umkms as $umkm)
                            <div class="col-12 col-md-12 col-lg-5">
                                <div class="card profile-widget">
                                    <div class="profile-widget-header text-center">
                                        @if (!empty($umkm->logo))
                                            <img src="{{ asset('uploads/logo/' . $umkm->logo) }}" alt="Logo Toko"
                                                class="rounded profile-widget-picture">
                                        @else
                                            <img src="{{ asset('admin/img/avatar/avatar-1.png') }}" alt="image"
                                                class="rounded-circle profile-widget-picture">
                                        @endif

                                        <div class="profile-widget-items d-flex justify-content-center mt-3">
                                            <div class="profile-widget-item mx-3">
                                                <div class="profile-widget-item-label">Posts</div>
                                                <div class="profile-widget-item-value font-weight-bold">187</div>
                                            </div>
                                            <div class="profile-widget-item mx-3">
                                                <div class="profile-widget-item-label">Followers</div>
                                                <div class="profile-widget-item-value font-weight-bold">6,8K</div>
                                            </div>
                                            <div class="profile-widget-item mx-3">
                                                <div class="profile-widget-item-label">Following</div>
                                                <div class="profile-widget-item-value font-weight-bold">2,1K</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="profile-widget-description mt-2">
                                        <div class="profile-widget-name font-weight-bold">
                                            {{ $umkm->userUmkm->name }}
                                            <span class="text-muted font-weight-normal"> / {{ $umkm->nama_toko }}</span>
                                        </div>
                                        <p class="mb-1">{{ $umkm->userUmkm->email }}</p>
                                        <p class="mb-0">{!! $umkm->deskripsi !!}</p>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                    <div class="col-12 col-md-12 col-lg-7">
                        <div class="card shadow-sm">
                            <form method="post" action="{{ route('profile.update', $umkm->id ?? Auth::id()) }}"
                                enctype="multipart/form-data" class="needs-validation" novalidate>
                                @csrf
                                @method('PUT')
                                <div class="card-header">
                                    <h4>Edit Profile</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Logo Toko (Disarankan 500 x 500)</label>
                                        <input type="file" name="logo" class="form-control">
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-bold">Nama Toko</label>
                                            <input type="text" name="nama_toko" class="form-control"
                                                value="{{ $umkm->nama_toko ?? '' }}" required>
                                            <div class="invalid-feedback">Harap isi nama toko</div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="font-weight-bold">No. Telepon</label>
                                            <input type="tel" name="no_telp" class="form-control"
                                                value="{{ $umkm->no_telp ?? '' }}" required>
                                            <div class="invalid-feedback">Harap isi nomor telepon</div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-bold">Alamat</label>
                                            <textarea name="alamat" class="form-control summernote-simple" required>{{ $umkm->alamat ?? '' }}</textarea>
                                            <div class="invalid-feedback">Harap isi alamat toko</div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="font-weight-bold">Deskripsi Singkat Toko</label>
                                            <textarea name="deskripsi" class="form-control summernote-simple" required>{{ $umkm->deskripsi ?? '' }}</textarea>
                                            <div class="invalid-feedback">Harap isi deskripsi toko</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-end">
                                    <button class="btn btn-primary px-4">Simpan</button>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('admin/library/cleave.js/dist/cleave.min.js') }}"></script>
    <script src="{{ asset('admin/library/cleave.js/dist/addons/cleave-phone.us.js') }}"></script>
    <script src="{{ asset('admin/library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('admin/library/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('admin/library/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('admin/library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('admin/library/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin/library/selectric/public/jquery.selectric.min.js') }}"></script>

    <script src="{{ asset('admin/library/summernote/dist/summernote-bs4.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('admin/js/page/forms-advanced-forms.js') }}"></script>
@endpush
