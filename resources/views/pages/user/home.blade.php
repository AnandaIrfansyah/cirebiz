@extends('layouts.user')

@section('title', 'Dashboard')

@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>

    </style>
@endpush

@section('main')
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Modern Interior <span clsas="d-block">Design Studio</span></h1>
                        <p class="mb-4">Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam
                            vulputate velit imperdiet dolor tempor tristique.</p>
                        <p><a href="" class="btn btn-secondary me-2">Shop Now</a><a href="#"
                                class="btn btn-white-outline">Explore</a></p>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="hero-img-wrap">
                        <img src="{{ asset('images/couch.png') }}" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Product Section -->
    <div class="product-section">
        <div class="container">
            <div class="row">
                <!-- Start Column 1 -->
                <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
                    <h2 class="mb-4 section-title">Crafted with excellent material.</h2>
                    <p class="mb-4">
                        Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit.
                        Aliquam vulputate velit imperdiet dolor tempor tristique.
                    </p>
                    <p><a href="shop.html" class="btn btn-dark">Explore</a></p>
                </div>
                <!-- End Column 1 -->

                <!-- Start Swiper Slider -->
                <div class="col-md-9">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            @foreach ($kategoris as $kategori)
                                <div class="swiper-slide text-center">
                                    <div class="card p-4 shadow-sm">
                                        <div class="author-pic mx-auto"
                                            style="width: 100px; height: 100px; overflow: hidden;">
                                            <img src="{{ asset('uploads/kategori/' . $kategori->foto_kategori) }}"
                                                alt="{{ $kategori->kategori }}" class="img-fluid rounded-circle"
                                                style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                        <h5 class="mt-3 font-weight-bold">{{ $kategori->kategori }}</h5>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Navigasi -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>

                    </div>
                </div>
                <!-- End Swiper Slider -->
            </div>
        </div>
    </div>
    <!-- End Product Section -->

    <!-- Start Product Section -->
    <div class="product-section">
        <div class="container">
            <div class="row">

                @foreach ($products as $product)
                    <!-- Start Column 1 -->
                    <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                        <a class="product-item card rounded" href="{{ route('detail.show', ['detail' => $product->id]) }}">
                            <img src="{{ asset('uploads/product_images/' . $product->foto_product) }}"
                                class="img-fluid product-thumbnail">
                            <h3 class="product-title">{{ $product->nama_product }}</h3>
                            <strong class="product-price">Rp {{ number_format($product->harga, 0, ',', '.') }}</strong>

                            <span class="icon-cross">
                                <img src="{{ asset('images/cross.svg') }}" class="img-fluid">
                            </span>
                        </a>
                    </div>
                    <!-- End Column 1 -->
                @endforeach

            </div>
        </div>
    </div>
    <!-- End Product Section -->

    <!-- Start Testimonial Slider -->
    <div class="testimonial-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mx-auto text-center">
                    <h2 class="section-title">Testimonials</h2>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="testimonial-slider-wrap text-center">

                        <div id="testimonial-nav">
                            <span class="prev" data-controls="prev"><span class="fa fa-chevron-left"></span></span>
                            <span class="next" data-controls="next"><span class="fa fa-chevron-right"></span></span>
                        </div>

                        <div class="testimonial-slider">
                            @foreach ($kategoris as $kategori)
                                <div class="item">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-8 mx-auto">

                                            <div class="testimonial-block text-center">


                                                <div class="author-info">
                                                    <div class="author-pic">
                                                        <img src="{{ asset('uploads/kategori/' . $kategori->foto_kategori) }}"
                                                            alt="Maria Jones" class="img-fluid">
                                                    </div>
                                                    <h3 class="font-weight-bold">{{ $kategori->kategori }}</h3>
                                                    <span class="position d-block mb-3">CEO, Co-Founder, XYZ Inc.</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Testimonial Slider -->
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 3,
            spaceBetween: 20,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                768: {
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 3
                },
                1200: {
                    slidesPerView: 4
                }
            }
        });
    </script>
@endpush
