@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="admin-dashboard">

        {{-- ================================
         PAGE HEADER
    ================================= --}}

        <div class="dashboard-heading">

            <div>
                <span class="dashboard-eyebrow">
                    KARAM CANTEEN
                </span>

                <h1>Dashboard</h1>

                <p>
                    Welcome back, {{ auth()->user()->name }}.
                    Here's what's happening today.
                </p>
            </div>

            <div class="dashboard-date">
                <span>Today</span>
                <strong>{{ now()->format('d M Y') }}</strong>
            </div>

        </div>


        {{-- ================================
         STAT CARDS
    ================================= --}}

        <div class="dashboard-stats">

            {{-- USERS --}}

            <div class="dashboard-stat-card">

                <div class="stat-card-top">

                    <div class="stat-icon stat-icon-users">
                        👥
                    </div>

                    <span class="stat-label">
                        Total Users
                    </span>

                </div>

                <div class="stat-card-bottom">

                    <strong>
                        {{ $totalUsers }}
                    </strong>

                    <span>
                        Registered users
                    </span>

                </div>

            </div>


            {{-- FOODS --}}

            <div class="dashboard-stat-card">

                <div class="stat-card-top">

                    <div class="stat-icon stat-icon-food">
                        🍔
                    </div>

                    <span class="stat-label">
                        Total Foods
                    </span>

                </div>

                <div class="stat-card-bottom">

                    <strong>
                        {{ $totalFoods }}
                    </strong>

                    <span>
                        {{ $availableFoods }} available today
                    </span>

                </div>

            </div>


            {{-- ORDERS --}}

            <div class="dashboard-stat-card">

                <div class="stat-card-top">

                    <div class="stat-icon stat-icon-orders">
                        📦
                    </div>

                    <span class="stat-label">
                        Total Orders
                    </span>

                </div>

                <div class="stat-card-bottom">

                    <strong>
                        {{ $totalOrders }}
                    </strong>

                    <span>
                        {{ $todayOrders }} placed today
                    </span>

                </div>

            </div>


            {{-- PENDING --}}

            <div class="dashboard-stat-card pending-card">

                <div class="stat-card-top">

                    <div class="stat-icon stat-icon-pending">
                        ⏳
                    </div>

                    <span class="stat-label">
                        Pending Orders
                    </span>

                </div>

                <div class="stat-card-bottom">

                    <strong>
                        {{ $pendingOrders }}
                    </strong>

                    <span>
                        Waiting for approval
                    </span>

                </div>

            </div>

        </div>


        {{-- ================================
         MIDDLE SECTION
    ================================= --}}

        <div class="dashboard-grid">


            {{-- ORDER OVERVIEW --}}

            <div class="dashboard-card orders-chart-card">

                <div class="orders-chart-header">

                    <div>
                        <h2>Orders Overview</h2>
                        <p>Last 6 working days</p>
                    </div>

                    <a href="{{ route('admin.orders.index') }}" class="orders-chart-link">
                        View Orders →
                    </a>

                </div>

                <div class="orders-chart-body">
                    <canvas id="ordersChart"></canvas>
                </div>

            </div>

            {{-- QUICK ACTIONS --}}

            <div class="dashboard-panel">

                <div class="dashboard-panel-header">

                    <div>
                        <h2>Quick Actions</h2>
                        <p>Manage your canteen</p>
                    </div>

                </div>


                <div class="quick-actions">

                    <a href="{{ route('foods.create') }}" class="quick-action">

                        <span class="quick-action-icon">
                            +
                        </span>

                        <span>
                            <strong>Add Food</strong>
                            <small>Add a new menu item</small>
                        </span>

                        <span class="quick-arrow">
                            →
                        </span>

                    </a>


                    <a href="{{ route('admin.orders.index') }}" class="quick-action">

                        <span class="quick-action-icon">
                            📦
                        </span>

                        <span>
                            <strong>Manage Orders</strong>
                            <small>Review customer orders</small>
                        </span>

                        <span class="quick-arrow">
                            →
                        </span>

                    </a>


                    <a href="{{ route('foods.index') }}" class="quick-action">

                        <span class="quick-action-icon">
                            🍔
                        </span>

                        <span>
                            <strong>Manage Foods</strong>
                            <small>Update your food menu</small>
                        </span>

                        <span class="quick-arrow">
                            →
                        </span>

                    </a>

                </div>

            </div>

        </div>


        {{-- ================================
         RECENT ORDERS
    ================================= --}}

        <div class="dashboard-panel recent-orders-panel">

            <div class="dashboard-panel-header">

                <div>
                    <h2>Recent Orders</h2>
                    <p>Latest customer orders</p>
                </div>

                <a href="{{ route('admin.orders.index') }}">
                    View All →
                </a>

            </div>


            @if ($recentOrders->count())

                <div class="recent-orders-table-wrapper">

                    <table class="recent-orders-table">

                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($recentOrders as $order)
                                <tr>

                                    <td>
                                        <strong>
                                            #{{ $order->id }}
                                        </strong>
                                    </td>

                                    <td>

                                        <div class="customer-cell">

                                            <span class="customer-avatar">
                                                {{ strtoupper(substr($order->user->name ?? 'U', 0, 1)) }}
                                            </span>

                                            <span>
                                                {{ $order->user->name ?? 'Unknown User' }}
                                            </span>

                                        </div>

                                    </td>

                                    <td>
                                        <strong>
                                            ₹{{ number_format($order->total_amount, 2) }}
                                        </strong>
                                    </td>

                                    <td>

                                        @if ($order->status === 'accepted')
                                            <span class="dashboard-status accepted">
                                                Accepted
                                            </span>
                                        @else
                                            <span class="dashboard-status pending">
                                                Pending
                                            </span>
                                        @endif

                                    </td>

                                    <td>
                                        {{ $order->created_at->format('d M, h:i A') }}
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            @else
                <div class="dashboard-empty">

                    <div class="empty-icon">
                        📦
                    </div>

                    <h3>No orders yet</h3>

                    <p>
                        Customer orders will appear here once they are placed.
                    </p>

                </div>

            @endif

        </div>

    </div>

@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    const salesChartLabels = @json($salesChartLabels);
    const salesChartData = @json($salesChartData);

    const chartCanvas = document.getElementById('ordersChart');

    if (chartCanvas) {

        new Chart(chartCanvas, {

            type: 'line',

            data: {
                labels: salesChartLabels,

                datasets: [{
                    label: 'Orders',
                    data: salesChartData,

                    borderColor: '#e67e00',
                    backgroundColor: 'rgba(230, 126, 0, 0.08)',

                    borderWidth: 2.5,

                    pointBackgroundColor: '#e67e00',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,

                    pointRadius: 4,
                    pointHoverRadius: 6,

                    tension: 0.35,

                    fill: true
                }]
            },

            options: {

                responsive: true,
                maintainAspectRatio: false,

                interaction: {
                    intersect: false,
                    mode: 'index'
                },

                plugins: {

                    legend: {
                        display: false
                    },

                    tooltip: {
                        backgroundColor: '#1f2937',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff',
                        padding: 10,

                        callbacks: {
                            label: function(context) {
                                return ' Orders: ' + context.parsed.y;
                            }
                        }
                    }

                },

                scales: {

                    y: {
                        beginAtZero: true,

                        ticks: {
                            precision: 0,
                            stepSize: 1,
                            color: '#94a3b8',
                            font: {
                                size: 11
                            }
                        },

                        grid: {
                            color: '#eef1f4',
                            drawBorder: false
                        },

                        title: {
                            display: false
                        }
                    },

                    x: {

                        ticks: {
                            color: '#64748b',
                            font: {
                                size: 11
                            },

                            maxRotation: 0,
                            minRotation: 0
                        },

                        grid: {
                            display: false
                        },

                        title: {
                            display: false
                        }
                    }

                }
            }

        });

    }

</script>

@endpush