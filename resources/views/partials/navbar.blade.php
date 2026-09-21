<header class="home-navbar">

    <div class="home-container navbar-inner">

        {{-- Brand --}}
        <a href="{{ route('home') }}" class="brand">
            KARAM <span>Canteen</span>
        </a>


        {{-- Desktop / Main Navigation --}}
        <nav class="navbar-links">

            {{-- Menu --}}
            <a href="{{ route('home') }}#menu" class="nav-link">
                Menu
            </a>


            @auth

                {{-- Cart --}}
                @if (request()->routeIs('home'))
                    <a href="#" class="nav-link cart-nav-link" id="openCart">
                        <span class="nav-icon">🛒</span>
                        <span>Cart</span>
                    </a>
                @else
                    <a href="{{ route('home') }}" class="nav-link cart-nav-link">
                        <span class="nav-icon">🛒</span>
                        <span>Cart</span>
                    </a>
                @endif


                {{-- Orders --}}
                <a href="{{ route('orders.index') }}"
                   class="nav-link {{ request()->routeIs('orders.*') ? 'active' : '' }}">
                    Orders
                </a>


                {{-- User Profile Dropdown --}}
                <div class="profile-menu">

                    <button type="button"
                            class="profile-btn"
                            id="profileBtn">

                        <span class="profile-avatar">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </span>

                        <span class="profile-name">
                            {{ Auth::user()->name }}
                        </span>

                        <span class="profile-arrow">
                            ▾
                        </span>

                    </button>


                    <div class="profile-dropdown" id="profileDropdown">

                        <div class="profile-dropdown-header">

                            <div class="dropdown-avatar">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>

                            <div class="dropdown-user-info">

                                <strong>
                                    {{ Auth::user()->name }}
                                </strong>

                                <span>
                                    {{ Auth::user()->email }}
                                </span>

                            </div>

                        </div>


                        <div class="dropdown-divider"></div>


                        <a href="{{ route('orders.index') }}"
                           class="dropdown-link">

                            <span>📦</span>
                            <span>My Orders</span>

                        </a>


                        <div class="dropdown-divider"></div>


                        <form method="POST"
                              action="{{ route('logout') }}">

                            @csrf

                            <button type="submit"
                                    class="dropdown-logout">

                                <span>↪</span>
                                <span>Logout</span>

                            </button>

                        </form>

                    </div>

                </div>

            @else

                {{-- Guest --}}
                <a href="{{ route('login') }}" class="nav-link">
                    Login
                </a>

                <a href="{{ route('register') }}" class="nav-register">
                    Register
                </a>

            @endauth

        </nav>

    </div>

</header>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const profileBtn = document.getElementById('profileBtn');
        const profileMenu = document.querySelector('.profile-menu');

        if (!profileBtn || !profileMenu) {
            return;
        }

        profileBtn.addEventListener('click', function (event) {
            event.stopPropagation();

            profileMenu.classList.toggle('open');
        });

        document.addEventListener('click', function (event) {

            if (!profileMenu.contains(event.target)) {
                profileMenu.classList.remove('open');
            }

        });

        document.addEventListener('keydown', function (event) {

            if (event.key === 'Escape') {
                profileMenu.classList.remove('open');
            }

        });

    });
</script>
@endpush