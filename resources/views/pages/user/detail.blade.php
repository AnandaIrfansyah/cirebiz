@extends('layouts.user')

@section('title', 'Detail')

@push('style')
    <style>
        .colorlib-product {
            padding: 5em 0;
            clear: both;
        }

        .product-detail-wrap .product-img img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .product-detail-wrap .product-desc {
            padding-left: 2em;
        }

        .product-detail-wrap .product-desc h3 {
            text-transform: uppercase;
            font-size: 22px;
            font-weight: bold;
        }

        .product-detail-wrap .price span {
            font-weight: 700;
            font-size: 20px;
            color: #000;
        }

        .product-detail-wrap .quantity-container {
            display: flex;
            align-items: center;
            max-width: 150px;
        }

        .product-detail-wrap .quantity-container .btn {
            border: 1px solid #ddd;
            padding: 10px;
        }

        .nav-pills .nav-link {
            border-radius: 0;
            color: #333;
            cursor: pointer;
        }

        .nav-pills .nav-link.active {
            background-color: #3b5d50;
            color: #fff;
        }
    </style>
@endpush

@section('main')
    <div class="colorlib-product">
        <div class="container">
            <div class="row product-detail-wrap">
                <div class="col-md-7">
                    <img src="{{ asset('uploads/product_images/' . $products->foto_product) }}" alt="Product Image"
                        class="img-fluid">
                </div>
                <div class="col-md-5">
                    <div class="product-desc">
                        <h3>{{ $products->nama_product }}</h3>
                        <p class="price"><span>Rp {{ number_format($products->harga, 0, ',', '.') }}</span></p>
                        <p>{!! $products->deskripsi !!}</p>
                        <form action="{{ route('detail.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $products->id }}">
                            <div class="quantity-container">
                                <button type="button" class="btn btn-outline-secondary decrease">&minus;</button>
                                <input type="text" name="qty" class="form-control text-center mx-2 quantity-amount"
                                    value="1" min="1">
                                <button type="button" class="btn btn-outline-secondary increase">&plus;</button>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-sm-12">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-description-tab" data-bs-toggle="pill"
                                href="#pills-description" role="tab">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-manufacturer-tab" data-bs-toggle="pill" href="#pills-manufacturer"
                                role="tab">Manufacturer</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-review-tab" data-bs-toggle="pill" href="#pills-review"
                                role="tab">Review</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active border p-3" id="pills-description" role="tabpanel">
                            <p>Product description goes here.</p>
                        </div>
                        <div class="tab-pane fade border p-3" id="pills-manufacturer" role="tabpanel">
                            <p>Manufacturer details here.</p>
                        </div>
                        <div class="tab-pane fade border p-3" id="pills-review" role="tabpanel">
                            <h3 class="head">23 Reviews</h3>
                            <p>Review content here.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let tabLinks = document.querySelectorAll(".nav-pills .nav-link");
            tabLinks.forEach(tab => {
                tab.addEventListener("click", function(e) {
                    e.preventDefault();
                    document.querySelector(".nav-pills .nav-link.active").classList.remove(
                        "active");
                    this.classList.add("active");

                    document.querySelector(".tab-pane.show.active").classList.remove("show",
                        "active");
                    let target = document.querySelector(this.getAttribute("href"));
                    target.classList.add("show", "active");
                });
            });
        });
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelector(".increase").addEventListener("click", function() {
                let qtyInput = document.querySelector(".quantity-amount");
                qtyInput.value = parseInt(qtyInput.value) + 1;
            });

            document.querySelector(".decrease").addEventListener("click", function() {
                let qtyInput = document.querySelector(".quantity-amount");
                if (qtyInput.value > 1) {
                    qtyInput.value = parseInt(qtyInput.value) - 1;
                }
            });
        });
    </script>
@endpush
