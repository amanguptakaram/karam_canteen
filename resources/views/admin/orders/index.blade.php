@extends('admin.layouts.app')

@section('title', 'Orders')

@section('page-title', 'Orders')

@section('content')


    <div class="admin-page-header">
        <div>
            <h2>Orders</h2>

            <p>
                Manage canteen order requests.
            </p>
        </div>
    </div>


    @if (session('success'))
        <div class="admin-alert admin-alert-success">
            <span>✓</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif


    <div class="admin-table-card">

        <div class="admin-table-header">

            <div>
                <h3>All Orders</h3>

                <span>
                    {{ $orders->count() }} total orders
                </span>
            </div>

        </div>


        @if ($orders->count())

            <div class="admin-table-wrapper">

                <table class="admin-table">

                    <thead>

                        <tr>
                            <th>Order</th>
                            <th>Customer</th>
                            <th>Department</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($orders as $order)
                            <tr>

                                <td>
                                    <strong>
                                        #{{ $order->id }}
                                    </strong>
                                </td>


                                <td>

                                    <div class="table-user">

                                        <div class="table-user-avatar">
                                            {{ strtoupper(substr($order->user->name, 0, 1)) }}
                                        </div>

                                        <div class="table-user-info">

                                            <strong>
                                                {{ $order->user->name }}
                                            </strong>

                                            <span>
                                                {{ $order->user->emp_code }}
                                            </span>

                                        </div>

                                    </div>

                                </td>


                                <td>
                                    {{ $order->user->department }}
                                </td>


                                <td>
                                    <strong>
                                        ₹{{ number_format($order->total_amount, 2) }}
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

                                    <a href="{{ route('admin.orders.show', $order) }}" class="table-action-btn">
                                        View
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

                <h3>No Orders Yet</h3>

                <p>
                    Customer orders will appear here.
                </p>

            </div>

        @endif

    </div>

@endsection
