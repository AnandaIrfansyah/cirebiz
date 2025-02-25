@extends('layout.umkm.layouts.app')

@section('title', 'Produk')

@push('style')
    <link rel="stylesheet" href="{{ asset('admin/library/select2/dist/css/select2.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between align-items-center">
                <h1>Produk</h1>
                <a href="{{ route('product.create') }}" class="btn btn-primary">Tambah Produk</a>
            </div>
            <div class="section-body">
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                            <div class="card shadow-sm border-0 rounded-lg">
                                <div class="d-flex justify-content-center mt-3">
                                    <img src="{{ asset('uploads/product_images/' . $product->foto_product) }}"
                                        class="card-img-top mb-2" alt="{{ $product->foto_product }}"
                                        style="width: 150px; height: 150px; object-fit: cover; border-radius: 10px;">
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h5 class="card-title mb-0">{{ $product->nama_product }}</h5>
                                        <p class="text-dark font-weight-bold mb-0" style="font-size: 1.2rem;">Rp
                                            {{ number_format($product->harga, 0, ',', '.') }}</p>
                                    </div>
                                    <p class="text-muted mb-1">Kategori : {{ $product->kategori->kategori }}</p>
                                    <p class="text-muted mb-2">{!! $product->deskripsi !!}</p>

                                    <div class="d-flex justify-content-between align-items-center">

                                        <div class="dropdown">
                                            <button
                                                class="btn btn-sm dropdown-toggle {{ $product->status == 'available' ? 'btn-success' : 'btn-warning' }}"
                                                type="button" id="statusDropdown{{ $product->id }}" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                {{ $product->status == 'available' ? 'Tersedia' : 'Tidak Tersedia' }}
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="statusDropdown{{ $product->id }}">
                                                <a class="dropdown-item" href="#"
                                                    onclick="changeStatus('{{ $product->id }}', 'available')">Tersedia</a>
                                                <a class="dropdown-item" href="#"
                                                    onclick="changeStatus('{{ $product->id }}', 'finished')">Tidak
                                                    Tersedia</a>
                                            </div>
                                        </div>

                                        <a href="" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>

                                        <form action="" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger confirm-delete">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>


                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center">
                    {{ $products->onEachSide(1)->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('admin/library/select2/dist/js/select2.full.min.js') }}"></script>
    <script>
        function changeStatus(id, status) {
            $.ajax({
                url: '/product/' + id + '/update-status',
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: status
                },
                success: function() {
                    location.reload();
                }
            });
        }
    </script>
@endpush
