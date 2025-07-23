@extends('frontend.layouts.main')

@section('content')
    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">checkout</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> Home</a></li>
                        <li><a href="{{ route('home') }}">Products</a></li>
                        <li>checkout</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!--====== Checkout Form Steps Part Start ======-->

    <section class="checkout-wrapper section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="checkout-steps-form-style-1">
                        <ul id="accordionExample">
                            <li>
                                <h6 class="title collapsed" data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                    aria-expanded="false" aria-controls="collapseFour">Shipping Address</h6>

                                <section class="checkout-steps-form-content " id="collapseFour"
                                    aria-labelledby="headingFour" data-bs-parent="#accordionExample">

                                    <form action="{{ route('shipping.store') }}" method="POST">
                                        @csrf
                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="single-form form-default">
                                                    <label>User Name</label>
                                                    <div class="row">
                                                        <div class="col-md-6 form-input form">
                                                            <input type="text" name="first_name" placeholder="First Name"
                                                                required>
                                                        </div>
                                                        <div class="col-md-6 form-input form">
                                                            <input type="text" name="last_name" placeholder="Last Name"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Email Address</label>
                                                    <div class="form-input form">
                                                        <input type="email" name="email" placeholder="Email Address"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Phone Number</label>
                                                    <div class="form-input form">
                                                        <input type="text" name="phone" placeholder="Phone Number"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="single-form form-default">
                                                    <label>Mailing Address</label>
                                                    <div class="form-input form">
                                                        <input type="text" name="address" placeholder="Mailing Address"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>City</label>
                                                    <div class="form-input form">
                                                        <input type="text" name="city" placeholder="City" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Province/State</label>
                                                    <div class="form-input form">
                                                        <input type="text" name="state" placeholder="State/Province"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Country</label>
                                                    <div class="form-input form">
                                                        <input type="text" name="country" placeholder="Country" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="steps-form-btn button mt-3">
                                                    <button type="submit" class="btn btn-alt">Save & Continue</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </section>
                            </li>


                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="checkout-sidebar">
                        <div class="checkout-sidebar-coupon">
                            <p>Appy Coupon to get discount!</p>
                            <form action="#">
                                <div class="single-form form-default">
                                    <div class="form-input form">
                                        <input type="text" placeholder="Coupon Code">
                                    </div>
                                    <div class="button">
                                        <button class="btn">apply</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="checkout-sidebar-price-table mt-30">
                            <h5 class="">Pricing Table</h5>

                            @php
                                $cart = session()->get('cart', []);
                                $totalAmount = 0;

                                foreach ($cart as $item) {
                                    $totalAmount += $item['price'] * $item['quantity'];
                                }

                                $shippingFee = 0;
                                $grandTotal = $totalAmount + $shippingFee;

                                session()->put('totalPrice', $grandTotal);
                            @endphp

                            <div class="checkout-sidebar-price-table mt-30">
                                <h5 class="">Pricing Table</h5>

                                <div class="total-payable">
                                    <div class="payable-price">
                                        <p class="value">Subtotal Price:</p>
                                        <p class="price">${{ number_format($totalAmount, 2) }}</p>
                                    </div>
                                    <div class="payable-price">
                                        <p class="value">Shipping:</p>
                                        <p class="price">
                                            @if ($shippingFee > 0)
                                                ${{ number_format($shippingFee, 2) }}
                                            @else
                                                Free
                                            @endif
                                        </p>
                                    </div>
                                    <div class="payable-price">
                                        <p class="value">Total:</p>
                                        <p class="price">${{ number_format($grandTotal, 2) }}</p>
                                    </div>
                                </div>

                                <div class="price-table-btn button">
                                    <a href="{{ route('checkout.stripe') }}" class="btn btn-alt">Checkout</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!--====== Checkout Form Steps Part Ends ======-->
@endsection
