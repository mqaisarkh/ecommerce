@extends('frontend.layouts.main')

@section('content')
    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Cart</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> Home</a></li>
                        <li><a href="{{ route('home') }}">Products</a></li>
                        <li>Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>



    <!-- Shopping Cart -->
    <div class="shopping-cart section">
        <div class="container">
            @php
                $cart = session()->get('cart', []);
                $totalAmount = 0;
            @endphp
            <div class="cart-list-head">
                <!-- Cart List Title -->
                <div class="cart-list-title">
                    <div class="row">
                        <div class="col-lg-1 col-md-1 col-12">

                        </div>
                        <div class="col-lg-4 col-md-3 col-12">
                            <p>Product Name</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Quantity</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Subtotal</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Total</p>
                        </div>
                        <div class="col-lg-1 col-md-2 col-12">
                            <p>Remove</p>
                        </div>
                    </div>
                </div>

                @forelse ($cart as $id => $item)
                    @php
                        $lineTotal = $item['price'] * $item['quantity'];
                        $totalAmount += $lineTotal;
                    @endphp
                    <div class="cart-single-list">
                        <div class="row align-items-center">
                            <div class="col-lg-1 col-md-1 col-12">
                                <a href="{{ route('product.detail', $id) }}">
                                    <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['title'] }}">
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-3 col-12">
                                <h5 class="product-name"><a href="product-detail">
                                        {{ $item['title'] }}</a></h5>

                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <div class="input-group">

                                    <input type="number" name="quantities[{{ $id }}]"
                                        class="form-control text-center quantity-input" min="1" max="5"
                                        value="{{ $item['quantity'] ?? 1 }}" data-id="{{ $id }}"
                                        data-price="{{ $item['price'] }}">

                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2 col-12">
                                <p>${{ number_format($item['price'], 2) }}</p>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <p>$<span class="item-total"
                                        data-id="{{ $id }}">{{ number_format($lineTotal, 2) }}</span></p>
                            </div>
                            <div class="col-lg-1 col-md-2 col-12">
                                <a class="remove-item" href="{{ route('cart.remove', $id) }}">
                                    <i class="lni lni-close"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                @empty
                    <p class="text-center py-3">Your cart is empty.</p>
                @endforelse

            </div>
            <div class="row">
                <div class="col-12">
                    <!-- Total Amount -->
                    <div class="total-amount">
                        <div class="row">
                            <div class="col-lg-8 col-md-6 col-12">
                                <div class="left">
                                    <div class="coupon">
                                        <form action="#" target="_blank">
                                            <input name="Coupon" placeholder="Enter Your Coupon">
                                            <div class="button">
                                                <button class="btn">Apply Coupon</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @php
                                $shippingFee = 0;
                                $grandTotal = $totalAmount + $shippingFee;

                                session()->put('totalPrice', $grandTotal);

                            @endphp

                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="right">
                                    <ul>
                                        <li>Cart Subtotal <span
                                                id="cart-subtotal">${{ number_format($totalAmount, 2) }}</span></li>
                                        <li>Shipping<span>
                                                @if ($shippingFee > 0)
                                                    ${{ number_format($shippingFee, 2) }}
                                                @else
                                                    Free
                                                @endif
                                            </span></li>
                                        <li class="last">You Pay <span
                                                id="grand-total">${{ number_format($grandTotal, 2) }}</span></li>
                                    </ul>
                                    <div class="button">
                                        <a href="{{ route('checkout') }}" class="btn">Checkout</a>
                                        <a href="{{ route('product.grid') }}" class="btn btn-alt">Continue shopping</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ End Total Amount -->
                </div>
            </div>
        </div>
    </div>
    <!--/ End Shopping Cart -->
@endsection


@push('scripts')
    <script>
        document.querySelectorAll('.increment-btn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const input = document.querySelector(`input.quantity-input[data-id="${id}"]`);
                let value = parseInt(input.value) || 1;
                if (value < 5) input.value = value + 1;
            });
        });

        document.querySelectorAll('.decrement-btn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const input = document.querySelector(`input.quantity-input[data-id="${id}"]`);
                let value = parseInt(input.value) || 1;
                if (value > 1) input.value = value - 1;
            });
        });
    </script>

    <script>
        function updateCartTotals() {
            let grandTotal = 0;

            document.querySelectorAll('.quantity-input').forEach(input => {
                const id = input.getAttribute('data-id');
                const price = parseFloat(input.getAttribute('data-price'));
                const quantity = parseInt(input.value) || 1;

                const itemTotal = price * quantity;

                // Update individual item total
                const totalEl = document.querySelector(`.item-total[data-id="${id}"]`);
                if (totalEl) {
                    totalEl.textContent = itemTotal.toFixed(2);
                }

                grandTotal += itemTotal;


                fetch("{{ route('cart.update') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        id: id,
                        quantity: quantity
                    })
                }).then(res => res.json()).then(data => {
                    console.log('Session updated', data);
                });
            });


            document.getElementById('cart-subtotal').textContent = `$${grandTotal.toFixed(2)}`;
            document.getElementById('grand-total').textContent = `$${grandTotal.toFixed(2)}`;
        }


        document.querySelectorAll('.quantity-input').forEach(input => {
            input.addEventListener('input', updateCartTotals);
        });

        document.querySelectorAll('.increment-btn, .decrement-btn').forEach(button => {
            button.addEventListener('click', function() {
                setTimeout(updateCartTotals, 100);
            });
        });
    </script>
@endpush
