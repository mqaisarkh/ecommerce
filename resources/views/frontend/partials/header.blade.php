<header class="header navbar-area">
    <!-- Start Topbar -->
    <div class="topbar">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="top-left">
                        <ul class="menu-top-link">
                            <li>
                                <div class="select-position">
                                    <select id="select4">
                                        <option value="0" selected>$ USD</option>
                                        <option value="1">€ EURO</option>
                                        <option value="2">$ CAD</option>
                                        <option value="3">₹ INR</option>
                                        <option value="4">¥ CNY</option>
                                        <option value="5">৳ BDT</option>
                                    </select>
                                </div>
                            </li>
                            <li>
                                <div class="select-position">
                                    <select id="select5">
                                        <option value="0" selected>English</option>
                                        <option value="1">Español</option>
                                        <option value="2">Filipino</option>
                                        <option value="3">Français</option>
                                        <option value="4">العربية</option>
                                        <option value="5">हिन्दी</option>
                                        <option value="6">বাংলা</option>
                                    </select>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="top-middle">
                        <ul class="useful-links">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('about') }}">About Us</a></li>
                            <li><a href="{{ route('contact') }}">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="top-end">
                        <div class="user">
                            <i class="lni lni-user"></i>
                            Hello
                        </div>
                        <ul class="user-login">
                            <li>
                                <a href="{{ route('custom.login') }}">Sign In</a>
                            </li>
                            <li>
                                <a href="{{ route('custom.register') }}">Register</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Topbar -->
    <!-- Start Header Middle -->
    <div class="header-middle">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-3 col-7">
                    <!-- Start Header Logo -->
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ asset('storage/' . setting('logo_dark')) }}" alt="Logo">
                    </a>
                    <!-- End Header Logo -->
                </div>
                <div class="col-lg-5 col-md-7 d-xs-none">
                    <!-- Start Main Menu Search -->
                    <div class="main-menu-search">
                        <!-- navbar search start -->
                        <div class="navbar-search search-style-5">
                            <div class="search-select">
                                <div class="select-position">
                                    <select id="select1">
                                        <option selected>All</option>
                                        <option value="1">option 01</option>
                                        <option value="2">option 02</option>
                                        <option value="3">option 03</option>
                                        <option value="4">option 04</option>
                                        <option value="5">option 05</option>
                                    </select>
                                </div>
                            </div>
                            <form action="{{ route('product.grid') }}" method="GET" class="d-flex">
                                <div class="search-input">
                                    <input type="text" name="q" placeholder="Search"
                                        value="{{ request('q') }}">
                                </div>
                                <div class="search-btn">
                                    <button type="submit"><i class="lni lni-search-alt"></i></button>
                                </div>
                            </form>


                        </div>
                        <!-- navbar search Ends -->
                    </div>
                    <!-- End Main Menu Search -->
                </div>
                <div class="col-lg-4 col-md-2 col-5">
                    <div class="middle-right-area">
                        <div class="nav-hotline">
                            <i class="lni lni-phone"></i>
                            <h3>Hotline:
                                <span>(+100) 123 456 7890</span>
                            </h3>
                        </div>

                        <div class="navbar-cart">
                            <div class="wishlist">
                                <a href="javascript:void(0)">
                                    <i class="lni lni-heart"></i>
                                    <span class="total-items">0</span>
                                </a>
                            </div>
                            @php
                                $cart = session()->get('cart', []);
                                $totalItems = array_sum(array_column($cart, 'quantity'));
                                $totalAmount = 0;
                            @endphp

                            <div class="cart-items">
                                <a href="javascript:void(0)" class="main-btn">
                                    <i class="lni lni-cart"></i>
                                    <span class="total-items">{{ $totalItems }}</span>
                                </a>

                                <!-- Shopping Item -->
                                <div class="shopping-item">
                                    <div class="dropdown-cart-header">
                                        <span>{{ $totalItems }} {{ Str::plural('Item', $totalItems) }}</span>
                                        <a href="{{ route('cart') }}">View Cart</a>
                                    </div>

                                    <ul class="shopping-list">

                                        @forelse ($cart as $id => $item)
                                            @php
                                                $lineTotal = $item['price'] * $item['quantity'];
                                                $totalAmount += $lineTotal;
                                            @endphp
                                            <li>
                                                <a href="{{ route('cart.remove', $id) }}" class="remove"
                                                    title="Remove this item">
                                                    <i class="lni lni-close"></i>
                                                </a>
                                                <div class="cart-img-head">
                                                    <a class="cart-img" href="#">
                                                        <img src="{{ asset('storage/' . $item['image']) }}"
                                                            alt="{{ $item['title'] }}">
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h4><a href="#">{{ $item['title'] }}</a></h4>
                                                    <p class="quantity">{{ $item['quantity'] }}x -
                                                        <span
                                                            class="amount">${{ number_format($item['price'], 2) }}</span>
                                                    </p>
                                                </div>
                                            </li>
                                        @empty
                                            <li class="text-center py-3">Your cart is empty.</li>
                                        @endforelse
                                    </ul>

                                    <div class="bottom">
                                        <div class="total">
                                            <span>Total</span>
                                            <span class="total-amount">${{ number_format($totalAmount, 2) }}</span>
                                        </div>
                                        <div class="button">
                                            <a href="{{ route('checkout') }}" class="btn animate">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                                <!--/ End Shopping Item -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Middle -->
    <!-- Start Header Bottom -->
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 col-md-6 col-12">
                <div class="nav-inner">
                    <!-- Start Mega Category Menu -->
                    <div class="mega-category-menu">
                        <span class="cat-button"><i class="lni lni-menu"></i>All Categories</span>
                        <ul class="sub-category">
                            @php
                                use App\Models\Category;
                                $categories = Category::all();
                            @endphp

                            <ul class="ms-1">
                                @foreach ($categories as $category)
                                    <li class="">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="{{ route('product.grid', $category->slug) }}"
                                                class="{{ request()->route('slug') == $category->slug ? 'fw-bold text-primary' : 'text-dark' }}">
                                                {{ $category->name }}
                                            </a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </ul>
                    </div>
                    <!-- End Mega Category Menu -->
                    <!-- Start Navbar -->
                    <nav class="navbar navbar-expand-lg">
                        <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                            <ul id="nav" class="navbar-nav ms-auto">
                                <li class="nav-item">
                                    <a href="{{ route('home') }}" class="active"
                                        aria-label="Toggle navigation">Home</a>
                                </li>

                                <li class="nav-item">
                                    <a class="dd-menu collapsed" href="javascript:void(0)" data-bs-toggle="collapse"
                                        data-bs-target="#submenu-1-3" aria-controls="navbarSupportedContent"
                                        aria-expanded="false" aria-label="Toggle navigation">Products</a>
                                    <ul class="sub-menu collapse" id="submenu-1-3">
                                        <li class="nav-item"><a href="{{ route('product.grid') }}">Products</a>
                                        </li>

                                        <li class="nav-item"><a href="{{ route('cart') }}">Cart</a></li>
                                        <li class="nav-item"><a href="{{ route('checkout') }}">Checkout</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('blog.grid.sidebar') }}">Blogs</a>
                                </li>
                                <li class="nav-item">
                                    <a class="dd-menu collapsed" href="javascript:void(0)" data-bs-toggle="collapse"
                                        data-bs-target="#submenu-1-2" aria-controls="navbarSupportedContent"
                                        aria-expanded="false" aria-label="Toggle navigation">Pages</a>
                                    <ul class="sub-menu collapse" id="submenu-1-2">
                                        <li class="nav-item"><a href="{{ route('about') }}">About Us</a></li>
                                        <li class="nav-item"><a href="{{ route('faq') }}">Faq</a></li>
                                        <li class="nav-item"><a href="{{ route('login') }}">Login</a></li>
                                        <li class="nav-item"><a href="{{ route('custom.register') }}">Register</a>
                                        </li>
                                        <li class="nav-item"><a href="{{ route('mail.success') }}">Mail Success</a>
                                        </li>
                                        <li class="nav-item"><a href="{{ route('error') }}">404 Error</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('contact') }}" aria-label="Toggle navigation">Contact Us</a>
                                </li>
                            </ul>
                        </div> <!-- navbar collapse -->
                    </nav>
                    <!-- End Navbar -->
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Start Nav Social -->
                <div class="nav-social">
                    <h5 class="title">Follow Us:</h5>
                    <ul>
                        <li>
                            <a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><i class="lni lni-instagram"></i></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><i class="lni lni-skype"></i></a>
                        </li>
                    </ul>
                </div>
                <!-- End Nav Social -->
            </div>
        </div>
    </div>
    <!-- End Header Bottom -->
</header>
