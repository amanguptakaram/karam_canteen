@extends('layouts.app')

@section('title', 'KARAM Canteen')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')

    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Hero Section -->
    <section class="hero-section">

        <div class="home-container hero-content">

            <div class="hero-text">

                <span class="hero-tag">
                    🍽️ Today's Fresh Menu
                </span>

                <h1>
                    Good Food.
                    <br>
                    <span>Simple Ordering.</span>
                </h1>

                <p>
                    Discover today's menu at KARAM Canteen.
                    Choose your favourite food and enjoy a simple
                    ordering experience.
                </p>

                <a href="#menu" class="hero-btn">
                    Explore Today's Menu
                    <span>→</span>
                </a>

            </div>

        </div>

    </section>


    <!-- Today's Menu -->
    <section class="menu-section" id="menu">

        <div class="home-container">

            <div class="section-heading">

                <div>
                    <span class="section-label">
                        KARAM Canteen
                    </span>

                    <h2>Today's Menu</h2>

                    <p>
                        Freshly available items for today.
                    </p>
                </div>

                {{-- ================= SEARCH ================= --}}
                <form method="GET" action="{{ route('home') }}" class="food-search-form" id="foodSearchForm">

                    <div class="search-input-wrapper">

                        <span class="search-icon">
                            🔍
                        </span>

                        <input type="text" name="search" id="foodSearchInput" value="{{ request('search') }}"
                            placeholder="Search food..." autocomplete="off">

                        <button type="button" id="clearFoodSearch" class="clear-search-btn"
                            style="{{ request('search') ? '' : 'display:none;' }}">
                            &times;
                        </button>

                    </div>

                </form>

            </div>


            {{-- ================= FOOD RESULTS ================= --}}
            <div id="foodResults">

                @if ($foods->count())

                    <div class="food-grid">

                        @foreach ($foods as $food)
                            <div class="food-card">

                                <div class="food-card-top">

                                    <div class="food-icon">
                                        🍽️
                                    </div>

                                    <span class="available-badge">
                                        Available
                                    </span>

                                </div>


                                <div class="food-card-content">

                                    <span class="food-category">
                                        {{ $food->category }}
                                    </span>

                                    <h3>
                                        {{ $food->name }}
                                    </h3>

                                    <p>
                                        {{ $food->description ?: 'Freshly prepared and available today.' }}
                                    </p>

                                </div>


                                <div class="food-card-bottom">

                                    <span class="food-price">
                                        ₹{{ number_format($food->price, 2) }}
                                    </span>

                                    <form method="POST" action="{{ route('cart.add', $food->id) }}" class="add-cart-form">
                                        @csrf

                                        <button type="submit" class="add-cart-btn">
                                            Add to Cart
                                        </button>

                                    </form>

                                </div>

                            </div>
                        @endforeach

                    </div>
                @else
                    <div class="empty-menu">

                        <div class="empty-icon">
                            🍽️
                        </div>

                        <h3>
                            @if (request('search'))
                                No food found.
                            @else
                                Today's menu is being prepared.
                            @endif
                        </h3>

                        <p>
                            @if (request('search'))
                                No available food matches your search.
                            @else
                                Please check back soon for available food items.
                            @endif
                        </p>

                    </div>

                @endif

            </div>


            {{-- ================= CART DRAWER ================= --}}

            @php

                $cart = session('cart', []);

                $cartTotal = 0;
                $cartCount = 0;

                foreach ($cart as $item) {
                    $cartTotal += $item['price'] * $item['quantity'];

                    $cartCount += $item['quantity'];
                }

            @endphp


            <div class="cart-overlay" id="cartOverlay"></div>


            <aside class="cart-drawer" id="cartDrawer">

                <div class="cart-header">

                    <div>

                        <h2>Your Cart</h2>

                        <span class="cart-count-text">

                            {{ $cartCount }}
                            {{ $cartCount == 1 ? 'item' : 'items' }}

                        </span>

                    </div>

                    <button type="button" class="close-cart" id="closeCart">
                        &times;
                    </button>

                </div>


                <div class="cart-body">

                    @if (count($cart) > 0)

                        @foreach ($cart as $item)
                            @php
                                $itemTotal = $item['price'] * $item['quantity'];
                            @endphp

                            <div class="cart-item" data-food-id="{{ $item['id'] }}">

                                <div class="cart-item-info">

                                    <h4>
                                        {{ $item['name'] }}
                                    </h4>

                                    <p>
                                        ₹{{ number_format($item['price'], 2) }}
                                        each
                                    </p>

                                </div>


                                <div class="cart-item-actions">

                                    {{-- Quantity --}}

                                    <div class="quantity-control">

                                        {{-- Decrease --}}

                                        <form method="POST" action="{{ route('cart.update', $item['id']) }}"
                                            class="cart-update-form">

                                            @csrf

                                            <input type="hidden" name="action" value="decrease">

                                            <button type="submit">
                                                −
                                            </button>

                                        </form>


                                        <span class="cart-item-quantity">
                                            {{ $item['quantity'] }}
                                        </span>


                                        {{-- Increase --}}

                                        <form method="POST" action="{{ route('cart.update', $item['id']) }}"
                                            class="cart-update-form">

                                            @csrf

                                            <input type="hidden" name="action" value="increase">

                                            <button type="submit">
                                                +
                                            </button>

                                        </form>

                                    </div>


                                    {{-- Item Total --}}

                                    <strong class="cart-item-total" data-food-id="{{ $item['id'] }}">
                                        ₹{{ number_format($itemTotal, 2) }}
                                    </strong>


                                    {{-- Remove --}}

                                    <form method="POST" action="{{ route('cart.remove', $item['id']) }}"
                                        class="cart-remove-form">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="remove-cart-item">
                                            Remove
                                        </button>

                                    </form>

                                </div>

                            </div>
                        @endforeach
                    @else
                        <div class="empty-cart">

                            <div class="empty-cart-icon">
                                🛒
                            </div>

                            <h3>
                                Your cart is empty
                            </h3>

                            <p>
                                Add some delicious food to get started.
                            </p>

                        </div>

                    @endif

                </div>


                @if (count($cart) > 0)
                    <div class="cart-footer">

                        <div class="cart-total">

                            <span>
                                Total
                            </span>

                            <strong id="cartTotal">
                                ₹{{ number_format($cartTotal, 2) }}
                            </strong>

                        </div>


                        <form method="POST" action="{{ route('cart.clear') }}" class="clear-cart-form">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="clear-cart-btn">
                                Clear Cart
                            </button>

                        </form>


                        <form method="POST" action="{{ route('orders.store') }}">

                            @csrf

                            <button type="submit" class="checkout-btn">
                                Place Order
                            </button>

                        </form>

                    </div>
                @endif

            </aside>

        </div>

    </section>


    <!-- Simple Footer -->
    @include('partials.footer')

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const cartDrawer = document.getElementById('cartDrawer');
            const cartOverlay = document.getElementById('cartOverlay');
            const openCart = document.getElementById('openCart');
            const closeCart = document.getElementById('closeCart');


            // =====================================================
            // OPEN CART
            // =====================================================

            if (openCart) {
                openCart.addEventListener('click', function(event) {
                    event.preventDefault();

                    if (cartDrawer) {
                        cartDrawer.classList.add('active');
                    }

                    if (cartOverlay) {
                        cartOverlay.classList.add('active');
                    }

                    document.body.classList.add('cart-open');
                });
            }


            // =====================================================
            // CLOSE CART
            // =====================================================

            if (closeCart) {
                closeCart.addEventListener('click', function() {

                    if (cartDrawer) {
                        cartDrawer.classList.remove('active');
                    }

                    if (cartOverlay) {
                        cartOverlay.classList.remove('active');
                    }

                    document.body.classList.remove('cart-open');
                });
            }


            // =====================================================
            // OVERLAY
            // =====================================================

            if (cartOverlay) {
                cartOverlay.addEventListener('click', function() {

                    if (cartDrawer) {
                        cartDrawer.classList.remove('active');
                    }

                    cartOverlay.classList.remove('active');

                    document.body.classList.remove('cart-open');
                });
            }


            // =====================================================
            // ESC
            // =====================================================

            document.addEventListener('keydown', function(event) {

                if (event.key === 'Escape') {

                    if (cartDrawer) {
                        cartDrawer.classList.remove('active');
                    }

                    if (cartOverlay) {
                        cartOverlay.classList.remove('active');
                    }

                    document.body.classList.remove('cart-open');
                }
            });


            // =====================================================
            // ADD TO CART AJAX
            // =====================================================

            document.querySelectorAll('.add-cart-form').forEach(function(form) {

                form.addEventListener('submit', function(event) {

                    event.preventDefault();

                    const button = form.querySelector('.add-cart-btn');

                    if (!button) {
                        return;
                    }

                    button.disabled = true;
                    button.textContent = 'Adding...';

                    const url = form.getAttribute('action');

                    fetch(url, {
                            method: 'POST',

                            headers: {
                                'X-CSRF-TOKEN': getCsrfToken(),
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })

                        .then(function(response) {

                            if (!response.ok) {
                                throw new Error(
                                    'Request failed: ' + response.status
                                );
                            }

                            return response.json();
                        })

                        .then(function(data) {

                            if (data.success) {

                                updateCartUI(data);

                                showCartMessage(
                                    data.message || 'Food added to cart.'
                                );

                            } else {

                                showCartMessage(
                                    data.message || 'Unable to add item.',
                                    'error'
                                );
                            }
                        })

                        .catch(function(error) {

                            console.error('Add cart error:', error);

                            showCartMessage(
                                'Something went wrong. Please try again.',
                                'error'
                            );
                        })

                        .finally(function() {

                            button.disabled = false;
                            button.textContent = 'Add to Cart';
                        });
                });
            });


            // =====================================================
            // CART UPDATE AJAX (+ / -)
            // =====================================================

            document.addEventListener('submit', function(event) {

                const form = event.target;

                if (!form.classList.contains('cart-update-form')) {
                    return;
                }

                event.preventDefault();

                const button = form.querySelector('button');

                if (button) {
                    button.disabled = true;
                }

                /*
                IMPORTANT:
                form.action use nahi kar rahe.
                getAttribute('action') use kar rahe hain.
                */

                const url = form.getAttribute('action');

                console.log('Cart update URL:', url);

                if (!url || url === '[object HTMLInputElement]') {

                    console.error(
                        'Invalid cart update URL:',
                        url
                    );

                    showCartMessage(
                        'Cart update URL is invalid.',
                        'error'
                    );

                    if (button) {
                        button.disabled = false;
                    }

                    return;
                }


                const formData = new FormData(form);


                fetch(url, {
                        method: 'POST',

                        headers: {
                            'X-CSRF-TOKEN': getCsrfToken(),
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },

                        body: formData
                    })

                    .then(function(response) {

                        console.log(
                            'Cart update response status:',
                            response.status
                        );

                        if (!response.ok) {
                            throw new Error(
                                'Request failed: ' + response.status
                            );
                        }

                        return response.json();
                    })

                    .then(function(data) {

                        console.log(
                            'Cart update response:',
                            data
                        );

                        if (data.success) {

                            updateCartUI(data);

                        } else {

                            showCartMessage(
                                data.message || 'Unable to update cart.',
                                'error'
                            );
                        }
                    })

                    .catch(function(error) {

                        console.error(
                            'Cart update error:',
                            error
                        );

                        showCartMessage(
                            'Something went wrong. Please try again.',
                            'error'
                        );
                    })

                    .finally(function() {

                        if (button) {
                            button.disabled = false;
                        }
                    });
            });


            // =====================================================
            // REMOVE ITEM AJAX
            // =====================================================

            document.addEventListener('submit', function(event) {

                const form = event.target;

                if (!form.classList.contains('cart-remove-form')) {
                    return;
                }

                event.preventDefault();

                const button = form.querySelector('button');

                if (button) {
                    button.disabled = true;
                }


                const url = form.getAttribute('action');

                console.log(
                    'Remove cart URL:',
                    url
                );


                if (!url || url === '[object HTMLInputElement]') {

                    console.error(
                        'Invalid remove URL:',
                        url
                    );

                    showCartMessage(
                        'Remove URL is invalid.',
                        'error'
                    );

                    if (button) {
                        button.disabled = false;
                    }

                    return;
                }


                fetch(url, {
                        method: 'DELETE',

                        headers: {
                            'X-CSRF-TOKEN': getCsrfToken(),
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })

                    .then(function(response) {

                        if (!response.ok) {
                            throw new Error(
                                'Request failed: ' + response.status
                            );
                        }

                        return response.json();
                    })

                    .then(function(data) {

                        if (data.success) {

                            updateCartUI(data);

                            showCartMessage(
                                data.message ||
                                'Item removed from cart.'
                            );

                        } else {

                            showCartMessage(
                                data.message ||
                                'Unable to remove item.',
                                'error'
                            );
                        }
                    })

                    .catch(function(error) {

                        console.error(
                            'Remove cart error:',
                            error
                        );

                        showCartMessage(
                            'Something went wrong. Please try again.',
                            'error'
                        );
                    })

                    .finally(function() {

                        if (button) {
                            button.disabled = false;
                        }
                    });
            });


            // =====================================================
            // UPDATE CART UI
            // =====================================================

            function updateCartUI(data) {

                const cart = data.cart || {};

                const cartBody =
                    document.querySelector('.cart-body');


                // -------------------------------------------------
                // UPDATE CART COUNT
                // -------------------------------------------------

                document
                    .querySelectorAll('.cart-count-text')
                    .forEach(function(element) {

                        element.textContent =
                            data.cartCount +
                            (
                                data.cartCount === 1 ?
                                ' item' :
                                ' items'
                            );
                    });


                // -------------------------------------------------
                // CART BODY CHECK
                // -------------------------------------------------

                if (!cartBody) {
                    return;
                }


                // -------------------------------------------------
                // EMPTY CART
                // -------------------------------------------------

                if (Number(data.cartCount) === 0) {

                    cartBody.innerHTML = `
                <div class="empty-cart">

                    <div class="empty-cart-icon">
                        🛒
                    </div>

                    <h3>
                        Your cart is empty
                    </h3>

                    <p>
                        Add some delicious food to get started.
                    </p>

                </div>
            `;


                    const existingFooter =
                        document.querySelector('.cart-footer');


                    if (existingFooter) {
                        existingFooter.remove();
                    }


                    return;
                }


                // -------------------------------------------------
                // BUILD CART ITEMS
                // -------------------------------------------------

                let cartHTML = '';


                Object.values(cart).forEach(function(item) {

                    const itemTotal =
                        Number(item.price) *
                        Number(item.quantity);


                    cartHTML += `

                <div
                    class="cart-item"
                    data-food-id="${item.id}"
                >

                    <div class="cart-item-info">

                        <h4>
                            ${item.name}
                        </h4>

                        <p>
                            ₹${Number(item.price).toFixed(2)} each
                        </p>

                    </div>


                    <div class="cart-item-actions">


                        <!-- QUANTITY -->

                        <div class="quantity-control">


                            <!-- DECREASE -->

                            <form
                                method="POST"
                                action="/cart/update/${item.id}"
                                class="cart-update-form"
                            >

                                <input
                                    type="hidden"
                                    name="_token"
                                    value="${getCsrfToken()}"
                                >

                                <input
                                    type="hidden"
                                    name="action"
                                    value="decrease"
                                >

                                <button type="submit">
                                    −
                                </button>

                            </form>


                            <!-- QUANTITY -->

                            <span class="cart-item-quantity">
                                ${item.quantity}
                            </span>


                            <!-- INCREASE -->

                            <form
                                method="POST"
                                action="/cart/update/${item.id}"
                                class="cart-update-form"
                            >

                                <input
                                    type="hidden"
                                    name="_token"
                                    value="${getCsrfToken()}"
                                >

                                <input
                                    type="hidden"
                                    name="action"
                                    value="increase"
                                >

                                <button type="submit">
                                    +
                                </button>

                            </form>


                        </div>


                        <!-- ITEM TOTAL -->

                        <strong class="cart-item-total">
                            ₹${itemTotal.toFixed(2)}
                        </strong>


                        <!-- REMOVE -->

                        <form
                            method="POST"
                            action="/cart/remove/${item.id}"
                            class="cart-remove-form"
                        >

                            <input
                                type="hidden"
                                name="_token"
                                value="${getCsrfToken()}"
                            >

                            <button
                                type="submit"
                                class="remove-cart-item"
                            >
                                Remove
                            </button>

                        </form>


                    </div>

                </div>

            `;
                });


                cartBody.innerHTML = cartHTML;


                // -------------------------------------------------
                // UPDATE / CREATE FOOTER
                // -------------------------------------------------

                let cartFooter =
                    document.querySelector('.cart-footer');


                if (!cartFooter) {

                    cartFooter =
                        document.createElement('div');

                    cartFooter.className =
                        'cart-footer';


                    if (cartDrawer) {
                        cartDrawer.appendChild(
                            cartFooter
                        );
                    }
                }


                cartFooter.innerHTML = `

            <div class="cart-total">

                <span>
                    Total
                </span>

                <strong id="cartTotal">
                    ₹${Number(data.cartTotal).toFixed(2)}
                </strong>

            </div>


            <!-- CLEAR CART -->

            <form
                method="POST"
                action="/cart/clear"
                class="clear-cart-form"
            >

                <input
                    type="hidden"
                    name="_token"
                    value="${getCsrfToken()}"
                >

                <input
                    type="hidden"
                    name="_method"
                    value="DELETE"
                >

                <button
                    type="submit"
                    class="clear-cart-btn"
                >
                    Clear Cart
                </button>

            </form>


            <!-- PLACE ORDER -->

            <form
                method="POST"
                action="/orders"
            >

                <input
                    type="hidden"
                    name="_token"
                    value="${getCsrfToken()}"
                >

                <button
                    type="submit"
                    class="checkout-btn"
                >
                    Place Order
                </button>

            </form>

        `;
            }


            // =====================================================
            // CSRF TOKEN
            // =====================================================

            function getCsrfToken() {

                const meta =
                    document.querySelector(
                        'meta[name="csrf-token"]'
                    );


                if (meta) {

                    return meta.getAttribute(
                        'content'
                    );
                }


                const input =
                    document.querySelector(
                        'input[name="_token"]'
                    );


                return input ?
                    input.value :
                    '';
            }


            // =====================================================
            // MESSAGE
            // =====================================================

            function showCartMessage(
                message,
                type = 'success'
            ) {

                const oldMessage =
                    document.querySelector(
                        '.cart-message'
                    );


                if (oldMessage) {
                    oldMessage.remove();
                }


                const messageBox =
                    document.createElement('div');


                messageBox.className =
                    'cart-message ' +
                    (
                        type === 'error' ?
                        'cart-message-error' :
                        ''
                    );


                messageBox.textContent =
                    message;


                document.body.appendChild(
                    messageBox
                );


                setTimeout(function() {

                    messageBox.classList.add(
                        'show'
                    );

                }, 10);


                setTimeout(function() {

                    messageBox.classList.remove(
                        'show'
                    );


                    setTimeout(function() {

                        if (messageBox) {
                            messageBox.remove();
                        }

                    }, 300);

                }, 2500);
            }

        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const searchForm = document.getElementById('foodSearchForm');
            const searchInput = document.getElementById('foodSearchInput');
            const clearButton = document.getElementById('clearFoodSearch');
            const foodResults = document.getElementById('foodResults');

            if (!searchForm || !searchInput || !foodResults) {
                return;
            }

            let searchTimer = null;


            function searchFoods() {

                const search = searchInput.value.trim();

                const url = new URL(
                    "{{ route('home') }}",
                    window.location.origin
                );

                if (search !== '') {
                    url.searchParams.set('search', search);
                }

                foodResults.style.opacity = '0.5';


                fetch(url.toString(), {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => {

                        if (!response.ok) {
                            throw new Error('Search request failed.');
                        }

                        return response.text();

                    })
                    .then(html => {

                        const parser = new DOMParser();

                        const doc = parser.parseFromString(
                            html,
                            'text/html'
                        );

                        const newResults =
                            doc.getElementById('foodResults');

                        if (newResults) {

                            foodResults.innerHTML =
                                newResults.innerHTML;

                        }

                        foodResults.style.opacity = '1';

                        window.history.replaceState({},
                            '',
                            url.toString()
                        );

                    })
                    .catch(error => {

                        console.error(error);

                        foodResults.style.opacity = '1';

                    });

            }


            searchInput.addEventListener('input', function() {

                const value = searchInput.value.trim();

                if (value !== '') {

                    clearButton.style.display = 'block';

                } else {

                    clearButton.style.display = 'none';

                }


                clearTimeout(searchTimer);

                searchTimer = setTimeout(function() {

                    searchFoods();

                }, 300);

            });


            searchForm.addEventListener('submit', function(event) {

                event.preventDefault();

                clearTimeout(searchTimer);

                searchFoods();

            });


            clearButton.addEventListener('click', function() {

                searchInput.value = '';

                clearButton.style.display = 'none';

                searchFoods();

                searchInput.focus();

            });

        });
    </script>
@endpush
