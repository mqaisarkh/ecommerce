 @extends('frontend.layouts.main')

 @section('content')
     <!-- Start Hero Area -->
     @include('frontend.partials.hero')
     <!-- End Hero Area -->


     <!-- Start Trending Product Area -->
     <section class="trending-product section" style="margin-top: 12px;">
         <div class="container">
             <div class="row">
                 <div class="col-12">
                     <div class="section-title">
                         <h2>Trending Product</h2>
                         <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                             suffered alteration in some form.</p>
                     </div>
                 </div>
             </div>
             <div class="row">
                 @foreach ($products as $product)
                     <div class="col-lg-3 col-md-6 col-12">
                         <!-- Start Single Product -->
                         <div class="single-product">
                             <div class="product-image">
                                 <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->title }}">

                                 {{-- Show sale tag if product is on sale --}}
                                 @if ($product->is_on_sale && $product->discount_percentage)
                                     <span class="sale-tag">-{{ $product->discount_percentage }}%</span>
                                 @endif

                                 <div class="button">
                                     <form action="{{ route('cart.add') }}" method="POST" style="display:inline-block;">
                                         @csrf
                                         <input type="hidden" name="product_id" value="{{ $product->id }}">
                                         <button type="submit" class="btn px-4 text-nowrap" style="width: 100%;">
                                             <i class="lni lni-cart"></i> Add to Cart
                                         </button>
                                     </form>
                                 </div>
                             </div>
                             <div class="product-info">
                                 <span class="category">{{ $product->category->name }}</span>
                                 <h4 class="title">
                                     <a
                                         href="{{ route('product.show', ['slug' => $product->slug]) }}">{{ $product->title }}</a>

                                 </h4>



                                 {{-- Price Section --}}
                                 <div class="price">
                                     @if ($product->is_on_sale && $product->original_price)
                                         <span>${{ number_format($product->price, 2) }}</span>
                                         <span
                                             class="discount-price">${{ number_format($product->original_price, 2) }}</span>
                                     @else
                                         <span>${{ number_format($product->price, 2) }}</span>
                                     @endif
                                 </div>
                             </div>
                         </div>
                         <!-- End Single Product -->
                     </div>
                 @endforeach

             </div>

         </div>
     </section>
     <!-- End Trending Product Area -->

     <!-- Start Call Action Area -->
     <section class="call-action section">
         <div class="container">
             <div class="row ">
                 <div class="col-lg-8 offset-lg-2 col-12">
                     <div class="inner">
                         <div class="content">
                             <h2 class="wow fadeInUp" data-wow-delay=".4s">Currently You are using free<br>
                                 Lite version of ShopGrids</h2>
                             <p class="wow fadeInUp" data-wow-delay=".6s">Please, purchase full version of the template
                                 to get all pages,<br> features and commercial license.</p>
                             <div class="button wow fadeInUp" data-wow-delay=".8s">
                                 <a href="javascript:void(0)" class="btn">Purchase Now</a>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section>
     <!-- End Call Action Area -->

     <!-- Start Banner Area -->
     <section class="banner section">
         <div class="container">
             <div class="row">
                 <div class="col-lg-6 col-md-6 col-12">
                     <div class="single-banner"
                         style="background-image:url('frontend/assets/images/banner/banner-1-bg.jpg')">
                         <div class="content">
                             <h2>Smart Watch 2.0</h2>
                             <p>Space Gray Aluminum Case with <br>Black/Volt Real Sport Band </p>
                             <div class="button">
                                 <a href="{{ route('product.grid') }}" class="btn">View Details</a>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-lg-6 col-md-6 col-12">
                     <div class="single-banner custom-responsive-margin"
                         style="background-image:url('frontend/assets/images/banner/banner-2-bg.jpg')">
                         <div class="content">
                             <h2>Smart Headphone</h2>
                             <p>Lorem ipsum dolor sit amet, <br>eiusmod tempor
                                 incididunt ut labore.</p>
                             <div class="button">
                                 <a href="{{ route('product.grid') }}" class="btn">Shop Now</a>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section>
     <!-- End Banner Area -->

     <!-- Start Shipping Info -->
     <section class="shipping-info">
         <div class="container">
             <ul>
                 <!-- Free Shipping -->
                 <li>
                     <div class="media-icon">
                         <i class="lni lni-delivery"></i>
                     </div>
                     <div class="media-body">
                         <h5>Free Shipping</h5>
                         <span>On order over $99</span>
                     </div>
                 </li>
                 <!-- Money Return -->
                 <li>
                     <div class="media-icon">
                         <i class="lni lni-support"></i>
                     </div>
                     <div class="media-body">
                         <h5>24/7 Support.</h5>
                         <span>Live Chat Or Call.</span>
                     </div>
                 </li>
                 <!-- Support 24/7 -->
                 <li>
                     <div class="media-icon">
                         <i class="lni lni-credit-cards"></i>
                     </div>
                     <div class="media-body">
                         <h5>Online Payment.</h5>
                         <span>Secure Payment Services.</span>
                     </div>
                 </li>
                 <!-- Safe Payment -->
                 <li>
                     <div class="media-icon">
                         <i class="lni lni-reload"></i>
                     </div>
                     <div class="media-body">
                         <h5>Easy Return.</h5>
                         <span>Hassle Free Shopping.</span>
                     </div>
                 </li>
             </ul>
         </div>
     </section>
     <!-- End Shipping Info -->
 @endsection
