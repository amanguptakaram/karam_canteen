@extends('admin.layouts.app')

@section('title', 'Order #' . $order->id)

@section('page-title', 'Order Details')

@section('content')

    <div class="admin-page-header order-detail-heading">

        <div>

            <div class="order-back-link">
                <a href="{{ route('admin.orders.index') }}">
                    ← Back to Orders
                </a>
            </div>

            <h2>
                Order #{{ $order->id }}
            </h2>

            <p>
                Placed on {{ $order->created_at->format('d M Y, h:i A') }}
            </p>

        </div>


        <div>

            @if ($order->status === 'pending')
                <span class="status-badge status-pending large-status">
                    Pending
                </span>
            @else
                <span class="status-badge status-accepted large-status">
                    Accepted
                </span>
            @endif

        </div>

    </div>


    @if (session('success'))
        <div class="admin-alert admin-alert-success">
            <span>✓</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif


    <div class="order-detail-grid">


        {{-- Customer Information --}}

        <div class="admin-detail-card">

            <div class="detail-card-header">

                <div>
                    <h3>Customer Information</h3>
                    <p>Order placed by</p>
                </div>

            </div>


            <div class="customer-profile">

                <div class="customer-avatar">
                    {{ strtoupper(substr($order->user->name, 0, 1)) }}
                </div>

                <div>

                    <h4>
                        {{ $order->user->name }}
                    </h4>

                    <span>
                        {{ $order->user->email }}
                    </span>

                </div>

            </div>


            <div class="customer-details">

                <div class="customer-detail-item">

                    <span>
                        Employee Code
                    </span>

                    <strong>
                        {{ $order->user->emp_code }}
                    </strong>

                </div>


                <div class="customer-detail-item">

                    <span>
                        Department
                    </span>

                    <strong>
                        {{ $order->user->department }}
                    </strong>

                </div>


                <div class="customer-detail-item">

                    <span>
                        Email
                    </span>

                    <strong>
                        {{ $order->user->email }}
                    </strong>

                </div>

            </div>

        </div>


        {{-- Order Summary --}}

        <div class="admin-detail-card">

            <div class="detail-card-header">

                <div>
                    <h3>Order Summary</h3>
                    <p>Order information</p>
                </div>

            </div>


            <div class="order-summary-row">

                <span>
                    Order ID
                </span>

                <strong>
                    #{{ $order->id }}
                </strong>

            </div>


            <div class="order-summary-row">

                <span>
                    Order Date
                </span>

                <strong>
                    {{ $order->created_at->format('d M Y') }}
                </strong>

            </div>


            <div class="order-summary-row">

                <span>
                    Order Time
                </span>

                <strong>
                    {{ $order->created_at->format('h:i A') }}
                </strong>

            </div>


            <div class="order-summary-row">

                <span>
                    Status
                </span>

                @if ($order->status === 'pending')
                    <span class="status-badge status-pending">
                        Pending
                    </span>
                @else
                    <span class="status-badge status-accepted">
                        Accepted
                    </span>
                @endif

            </div>

        </div>

    </div>


    {{-- Ordered Foods --}}

    <div class="admin-detail-card order-items-card">

        <div class="detail-card-header">

            <div>
                <h3>Ordered Foods</h3>

                <p>
                    {{ $order->items->sum('quantity') }} total items
                </p>
            </div>

        </div>


        <div class="admin-table-wrapper">

            <table class="admin-table order-items-table">

                <thead>

                    <tr>
                        <th>Food</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach ($order->items as $item)
                        <tr>

                            <td>

                                <div class="food-order-name">

                                    <div class="food-order-icon">
                                        🍴
                                    </div>

                                    <strong>
                                        {{ $item->food->name }}
                                    </strong>

                                </div>

                            </td>


                            <td>
                                {{ $item->food->category }}
                            </td>


                            <td>
                                ₹{{ number_format($item->price, 2) }}
                            </td>


                            <td>

                                <span class="quantity-badge">
                                    {{ $item->quantity }}
                                </span>

                            </td>


                            <td>

                                <strong>
                                    ₹{{ number_format($item->price * $item->quantity, 2) }}
                                </strong>

                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

        </div>


        <div class="order-total-row">

            <span>
                Total Amount
            </span>

            <strong>
                ₹{{ number_format($order->total_amount, 2) }}
            </strong>

        </div>

    </div>


    {{-- Accept Order --}}

    @if ($order->status === 'pending')
        <div class="order-action-card">

            <div>

                <h3>
                    Confirm this order?
                </h3>

                <p>
                    Once accepted, the order status will change to Accepted.
                </p>

            </div>


            <form method="POST" action="{{ route('admin.orders.accept', $order) }}">

                @csrf
                @method('PATCH')

                <button type="submit" class="accept-order-btn">
                    ✓ Accept Order
                </button>

            </form>

        </div>
    @endif

@endsection
