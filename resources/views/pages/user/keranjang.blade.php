@extends('layouts.user')

@section('title', 'Keranjang')

@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
@endpush

@section('main')
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Cart</h1>
                    </div>
                </div>
                <div class="col-lg-7">
                </div>
            </div>
        </div>
    </div>

    <div class="untree_co-section before-footer-section">
        <div class="container">
            <div class="row mb-5">
                <form id="checkout-form" method="GET" action="{{ route('checkout.index') }}">
                    <div class="site-blocks-table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="product-select">Pilih</th>
                                    <th class="product-thumbnail">Foto Product</th>
                                    <th class="product-name">Nama Product</th>
                                    <th class="product-price">Harga</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-total">Total</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($keranjangs as $keranjang)
                                    <tr>
                                        <td class="product-select">
                                            <input type="checkbox" name="keranjang_id[]" value="{{ $keranjang->id }}"
                                                class="product-checkbox" data-total="{{ $keranjang->total }}">
                                        </td>
                                        <td class="product-thumbnail">
                                            <img src="{{ asset('uploads/product_images/' . $keranjang->productCart->foto_product) }}"
                                                alt="Image" class="img-fluid">
                                        </td>
                                        <td class="product-name">
                                            <h2 class="h5 text-black">{{ $keranjang->productCart->nama_product }}</h2>
                                        </td>
                                        <td>Rp {{ number_format($keranjang->productCart->harga, 0, ',', '.') }}</td>
                                        <td>{{ $keranjang->qty }}</td>
                                        <td>Rp {{ number_format($keranjang->total, 0, ',', '.') }}</td>
                                        <td>
                                            <form action="{{ route('keranjang.destroy', $keranjang->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $keranjangs->onEachSide(1)->links('pagination::bootstrap-5') }}

                    <div class="row mt-5">
                        <div class="col-md-12 text-right">
                            <h3>Total: <strong id="cart-total">Rp 0</strong></h3>
                        </div>
                        <div class="col-md-12 mt-3">
                            <button type="submit" id="checkout-btn" class="btn btn-black btn-lg btn-block" disabled>
                                Proceed to Checkout
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const checkboxes = document.querySelectorAll(".product-checkbox");
            const totalDisplay = document.getElementById("cart-total");
            const checkoutBtn = document.getElementById("checkout-btn");

            function updateState() {
                let total = 0;
                let checkedCount = 0;

                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        total += parseFloat(checkbox.dataset.total);
                        checkedCount++;
                    }
                });

                totalDisplay.textContent = "Rp " + total.toLocaleString("id-ID");
                checkoutBtn.disabled = checkedCount === 0;
            }

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener("change", updateState);
            });
        });
    </script>
@endpush
