<section class="hero-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-12 custom-padding-right">
                <div class="slider-head">
                    <!-- Start Hero Slider -->
                    <div class="hero-slider">
                        @php
                            $discountedProducts = $products->filter(function ($product) {
                                return $product->is_on_sale && $product->discount_percentage;
                            });
                        @endphp

                        @foreach ($discountedProducts->take(3) as $product)
                            <div class="single-slider py-5" style="background-color: #f8f8f8;">
                                <div class="container">
                                    <div class="row align-items-center">
                                        <!-- Left: Text Content -->
                                        <div class="col-md-6">
                                            <div class="content">
                                                <h2>
                                                    <span class="bg-danger text-white px-2 py-1 rounded d-inline-block"
                                                        style="width: fit-content; font-size: 0.9rem;">
                                                        {{ $product->discount_percentage }}% Off
                                                    </span><br>
                                                    {{ $product->title }}
                                                </h2>
                                                <h3>
                                                    <span>Now Only</span> ${{ number_format($product->price, 2) }}
                                                    @if ($product->original_price)
                                                        <del
                                                            class="text-muted ms-2">${{ number_format($product->original_price, 2) }}</del>
                                                    @endif
                                                </h3>
                                                <div class="button mt-3">
                                                    <a href="{{ route('product.show', ['slug' => $product->slug]) }}"
                                                        class="btn btn-primary">Shop Now</a>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Right: Product Image -->
                                        <div class="col-md-6 text-center">
                                            <img src="{{ asset('storage/' . $product->main_image) }}"
                                                alt="{{ $product->title }}" class="img-fluid"
                                                style="max-height: 400px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- End Hero Slider -->
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="row">
                    <div class="col-lg-12 col-md-6 col-12 md-custom-padding">
                        <!-- Start Small Banner -->
                        <div class="hero-small-banner"
                            style="background-image: url('frontend/assets/images/hero/slider-bnr.jpg');">
                            <div class="content">
                                <h2>
                                    <span>New line required</span>
                                    iPhone 12 Pro Max
                                </h2>
                                <h3>$259.99</h3>
                            </div>
                        </div>
                        <!-- End Small Banner -->
                    </div>
                    <div class="col-lg-12 col-md-6 col-12">
                        <!-- Start Small Banner -->
                        <div class="hero-small-banner style2">
                            <div class="content">
                                <h2>Weekly Sale!</h2>
                                <p>Saving up to 50% off all online store items this week.</p>
                                <div class="button">
                                    <a class="btn" href="{{ route('product.grid') }}">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <!-- Start Small Banner -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
