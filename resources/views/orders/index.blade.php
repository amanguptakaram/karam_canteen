@extends('layouts.app')

@section('title', 'My Orders')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')


    @include('partials.navbar')
    @if (session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="error-message">
            {{ session('error') }}
        </div>
    @endif


    <main class="orders-page">

        <div class="home-container">

            <div class="orders-heading">
                <span class="section-label">
                    KARAM Canteen
                </span>

                <h1>My Orders</h1>

                <p>
                    View your previous and current orders.
                </p>
            </div>


            @if (session('success'))
                <div class="success-box">
                    {{ session('success') }}
                </div>
            @endif


            @if ($orders->count())

                <div class="orders-list">

                    @foreach ($orders as $order)
                        <div class="order-card">

                            <div class="order-card-header">

                                <div>
                                    <span class="order-number">
                                        Order #{{ $order->id }}
                                    </span>

                                    <p class="order-date">
                                        {{ $order->created_at->format('d M Y, h:i A') }}
                                    </p>
                                </div>


                                <span class="order-status status-{{ $order->status }}">
                                    {{ ucfirst($order->status) }}
                                </span>

                            </div>


                            <div class="order-items">

                                @foreach ($order->items as $item)
                                    <div class="order-item">

                                        <div>
                                            <strong>
                                                {{ $item->food_name }}
                                            </strong>

                                            <span>
                                                × {{ $item->quantity }}
                                            </span>
                                        </div>

                                        <strong>
                                            ₹{{ number_format($item->price * $item->quantity, 2) }}
                                        </strong>

                                    </div>
                                @endforeach

                            </div>


                            <div class="order-card-footer">

                                <span>
                                    Total
                                </span>

                                <strong>
                                    ₹{{ number_format($order->total_amount, 2) }}
                                </strong>

                            </div>

                        </div>
                    @endforeach

                </div>
            @else
                <div class="empty-orders">

                    <div class="empty-orders-icon">
                        📦
                    </div>

                    <h2>
                        No orders yet
                    </h2>

                    <p>
                        Your placed orders will appear here.
                    </p>

                    <a href="{{ route('home') }}" class="hero-btn">
                        Browse Today's Menu
                    </a>

                </div>

            @endif

        </div>

    </main>
    @include('partials.footer')

@endsection
