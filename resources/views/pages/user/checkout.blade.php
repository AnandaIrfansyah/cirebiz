@extends('layouts.user')

@section('title', 'Checkouts')

@push('style')
@endpush

@section('main')
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Checkout</h1>
                    </div>
                </div>
                <div class="col-lg-7"></div>
            </div>
        </div>
    </div>

    <div class="untree_co-section">
        <div class="container">
            <form method="POST" action="{{ route('checkout.store') }}">
                @csrf
                <div class="row">
                    <!-- Left: Billing Details -->
                    <div class="col-md-6 mb-5 mb-md-0">
                        <h2 class="h3 mb-3 text-black">Billing Details</h2>
                        <div class="p-3 p-lg-5 border bg-white">
                            <div class="form-group row">
                                <div class="col-md-12 mb-3">
                                    <label class="text-black">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="text-black">Alamat <span class="text-danger">*</span></label>
                                    <input type="text" name="c_address" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <div class="col-md-12">
                                    <label class="text-black">Kode POS <span class="text-danger">*</span></label>
                                    <input type="text" name="c_postal_zip" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <div class="col-md-6">
                                    <label class="text-black">Email <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{ auth()->user()->email }}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label class="text-black">Telephone <span class="text-danger">*</span></label>
                                    <input type="text" name="c_phone" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="text-black">Catatan Order</label>
                                <textarea name="c_order_notes" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <h2 class="h3 mb-3 text-black">Coupon Code</h2>
                                <div class="p-3 p-lg-5 border bg-white">
                                    <label class="text-black mb-3">Enter your coupon code if you have one</label>
                                    <div class="input-group w-75 couponcode-wrap">
                                        <input type="text" class="form-control me-2" id="c_code"
                                            placeholder="Coupon Code" aria-label="Coupon Code"
                                            aria-describedby="button-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-black btn-sm" type="button"
                                                id="button-addon2">Apply</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Order Summary -->
                    <div class="col-md-6">
                        <div class="row mb-5">
                            <div class="col-md-12">
                                <h2 class="h3 mb-3 text-black">Your Order</h2>
                                <div class="p-3 p-lg-5 border bg-white">
                                    <table class="table site-block-order-table mb-5">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $total = 0; @endphp
                                            @foreach ($keranjangs as $item)
                                                <tr>
                                                    <td>{{ $item->productCart->nama_product }} <strong
                                                            class="mx-2">x</strong>{{ $item->qty }}</td>
                                                    <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                                                </tr>
                                                @php $total += $item->total; @endphp
                                            @endforeach
                                            <tr>
                                                <td><strong>Order Total</strong></td>
                                                <td><strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <!-- Payment Methods -->
                                    <div class="border p-3 mb-3">
                                        <label class="d-block">
                                            <input type="radio" name="metode_pembayaran" value="transfer_bank"
                                                data-bs-toggle="collapse" data-bs-target="#collapsebank"
                                                aria-expanded="false" class="me-2" required>
                                            Transfer Bank
                                        </label>
                                        <div class="collapse mt-2" id="collapsebank">
                                            <div class="py-2">
                                                <p class="mb-0">Silakan transfer ke rekening bank kami...</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="border p-3 mb-3">
                                        <label class="d-block">
                                            <input type="radio" name="metode_pembayaran" value="dompet_digital"
                                                data-bs-toggle="collapse" data-bs-target="#collapsecheque"
                                                aria-expanded="false" class="me-2">
                                            Dompet Digital
                                        </label>
                                        <div class="collapse mt-2" id="collapsecheque">
                                            <div class="py-2">
                                                <p class="mb-0">Pembayaran via OVO, DANA, GoPay...</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="border p-3 mb-5">
                                        <label class="d-block">
                                            <input type="radio" name="metode_pembayaran" value="greai_offline"
                                                data-bs-toggle="collapse" data-bs-target="#collapsepaypal"
                                                aria-expanded="false" class="me-2">
                                            Greai Offline
                                        </label>
                                        <div class="collapse mt-2" id="collapsepaypal">
                                            <div class="py-2">
                                                <p class="mb-0">Bayar langsung di lokasi Greai Offline...</p>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-black btn-lg py-3 btn-block">Place
                                        Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
