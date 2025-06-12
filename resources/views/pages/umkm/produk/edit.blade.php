@extends('layouts.umkm')

@section('title', 'Edit Produk')

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
                <h1>Edit Produk</h1>
                <div class="section-header-button">
                    <a href="{{ route('product.index') }}" class="btn btn-primary">Kembali</a>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Form Edit Produk</h2>

                <div class="card">
                    <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label>Foto Produk Saat Ini</label><br>
                                @if ($product->foto_product)
                                    <img src="{{ asset('uploads/product_images/' . $product->foto_product) }}"
                                        width="150" alt="Foto Produk">
                                @else
                                    <p>Tidak ada foto.</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Ubah Foto Produk (opsional)</label>
                                <input type="file" class="form-control" name="foto_product" id="foto_product">
                            </div>
                            <div class="form-group">
                                <label>Nama Produk</label>
                                <input type="text" class="form-control" name="nama_product" id="nama_product"
                                    value="{{ old('nama_product', $product->nama_product) }}" required>
                            </div>
                            <div class="form-group">
                                <label><i class="fas fa-box"></i> Kategori</label>
                                <select name="kategori_id" id="kategori_id" class="form-control selectric" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}"
                                            {{ $kategori->id == $product->kategori_id ? 'selected' : '' }}>
                                            {{ $kategori->kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control summernote-simple" required>{{ old('deskripsi', $product->deskripsi) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Harga</label>
                                <input type="number" class="form-control" name="harga" id="harga"
                                    value="{{ old('harga', $product->harga) }}" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Produk</button>
                        </div>
                    </form>
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
    <script src="{{ asset('admin/js/page/forms-advanced-forms.js') }}"></script>
@endpush
