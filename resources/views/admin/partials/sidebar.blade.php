<aside class="admin-sidebar">

    <div class="admin-brand">
        <a href="{{ route('admin.dashboard') }}">
            KARAM <span>Canteen</span>
        </a>

        <small>ADMIN PANEL</small>
    </div>

    <nav class="admin-nav">

        <a href="{{ route('admin.dashboard') }}"
            class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="nav-icon">▦</span>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('admin.orders.index') }}"
            class="admin-nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">

            <span class="nav-icon">▤</span>
            <span>Orders</span>

        </a>

        <a href="{{ route('foods.index') }}" class="admin-nav-link {{ request()->routeIs('foods.*') ? 'active' : '' }}">
            <span class="nav-icon">🍔</span>
            <span>Foods</span>
        </a>

        <a href="{{ route('admin.users.index') }}"
            class="admin-nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">

            <span class="nav-icon">♙</span>
            <span>Users</span>

        </a>

        <a href="{{ route('roles.index') }}" class="admin-nav-link {{ request()->routeIs('roles.*') ? 'active' : '' }}">
            <span class="nav-icon">▣</span>
            <span>Roles</span>
        </a>

        <a href="{{ route('permissions.index') }}" class="admin-nav-link {{ request()->routeIs('permissions.*') ? 'active' : '' }}">
            <span class="nav-icon">✓</span>
            <span>Permissions</span>
        </a>
    </nav>

    <div class="admin-sidebar-bottom">

        <div class="admin-user-mini">

            <div class="admin-user-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>

            <div class="admin-user-info">
                <strong>{{ Auth::user()->name }}</strong>
                <span>Administrator</span>
            </div>

        </div>

        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf

            <button type="submit" class="admin-logout-btn">
                <span>↪</span>
                Logout
            </button>
        </form>

    </div>

</aside>
