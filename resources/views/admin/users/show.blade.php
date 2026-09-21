@extends('admin.layouts.app')

@section('title', $user->name)

@section('page-title', 'User Details')

@section('content')

    <div class="admin-page-header">

        <div>

            <div class="order-back-link">
                <a href="{{ route('admin.users.index') }}">
                    ← Back to Users
                </a>
            </div>

            <h2>
                {{ $user->name }}
            </h2>

            <p>
                User profile and order history.
            </p>

        </div>

    </div>


    <div class="user-detail-grid">


        {{-- User Information --}}

        <div class="admin-detail-card">

            <div class="detail-card-header">

                <div>
                    <h3>User Information</h3>

                    <p>
                        Registered account details
                    </p>
                </div>

            </div>


            <div class="customer-profile">

                <div class="customer-avatar">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>

                <div>

                    <h4>
                        {{ $user->name }}
                    </h4>

                    <span>
                        {{ $user->email }}
                    </span>

                </div>

            </div>


            <div class="customer-details">

                <div class="customer-detail-item">

                    <span>
                        Employee Code
                    </span>

                    <strong>
                        {{ $user->emp_code }}
                    </strong>

                </div>


                <div class="customer-detail-item">

                    <span>
                        Name
                    </span>

                    <strong>
                        {{ $user->name }}
                    </strong>

                </div>


                <div class="customer-detail-item">

                    <span>
                        Department
                    </span>

                    <strong>
                        {{ $user->department }}
                    </strong>

                </div>


                <div class="customer-detail-item">

                    <span>
                        Email
                    </span>

                    <strong>
                        {{ $user->email }}
                    </strong>

                </div>


                <div class="customer-detail-item">

                    <span>
                        Role
                    </span>

                    @if ($user->role === 'admin')

                        <span class="status-badge status-admin">
                            Admin
                        </span>

                    @else

                        <span class="status-badge status-user">
                            User
                        </span>

                    @endif

                </div>


                <div class="customer-detail-item">

                    <span>
                        Registered On
                    </span>

                    <strong>
                        {{ $user->created_at->format('d M Y, h:i A') }}
                    </strong>

                </div>

            </div>

        </div>


        {{-- User Statistics --}}

        <div class="admin-detail-card">

            <div class="detail-card-header">

                <div>
                    <h3>Account Summary</h3>

                    <p>
                        User activity
                    </p>
                </div>

            </div>


            <div class="user-stat-box">

                <span>
                    Total Orders
                </span>

                <strong>
                    {{ $user->orders->count() }}
                </strong>

            </div>


            <div class="user-stat-box">

                <span>
                    Pending Orders
                </span>

                <strong>
                    {{ $user->orders->where('status', 'pending')->count() }}
                </strong>

            </div>


            <div class="user-stat-box">

                <span>
                    Accepted Orders
                </span>

                <strong>
                    {{ $user->orders->where('status', 'accepted')->count() }}
                </strong>

            </div>

        </div>

    </div>


    {{-- Order History --}}

    <div class="admin-detail-card user-orders-card">

        <div class="detail-card-header">

            <div>

                <h3>
                    Order History
                </h3>

                <p>
                    Orders placed by {{ $user->name }}.
                </p>

            </div>

        </div>


        @if ($user->orders->count())

            <div class="admin-table-wrapper">

                <table class="admin-table">

                    <thead>

                        <tr>
                            <th>Order</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>

                    </thead>


                    <tbody>

                        @foreach ($user->orders as $order)

                            <tr>

                                <td>
                                    <strong>
                                        #{{ $order->id }}
                                    </strong>
                                </td>


                                <td>

                                    {{ $order->items->sum('quantity') }}
                                    item(s)

                                </td>


                                <td>

                                    <strong>
                                        ₹{{ number_format($order->total, 2) }}
                                    </strong>

                                </td>


                                <td>

                                    @if ($order->status === 'pending')

                                        <span class="status-badge status-pending">
                                            Pending
                                        </span>

                                    @else

                                        <span class="status-badge status-accepted">
                                            Accepted
                                        </span>

                                    @endif

                                </td>


                                <td>
                                    {{ $order->created_at->format('d M Y, h:i A') }}
                                </td>


                                <td>

                                    <a
                                        href="{{ route('admin.orders.show', $order) }}"
                                        class="table-action-btn"
                                    >
                                        View Order
                                    </a>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="admin-empty-state">

                <div class="empty-icon">
                    📦
                </div>

                <h3>No Orders</h3>

                <p>
                    This user has not placed any orders yet.
                </p>

            </div>

        @endif

    </div>

@endsection