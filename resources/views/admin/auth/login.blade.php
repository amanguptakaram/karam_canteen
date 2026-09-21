<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Login | KARAM Canteen</title>

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

</head>

<body class="admin-login-body">

    <div class="admin-login-page">

        <div class="admin-login-wrapper">

            {{-- Left Side --}}
            <div class="admin-login-brand">

                <div class="admin-login-brand-content">

                    <div class="admin-login-logo">
                        KARAM <span>Canteen</span>
                    </div>

                    <div class="admin-login-badge">
                        ADMIN PANEL
                    </div>

                    <h1>
                        Manage your<br>
                        canteen with ease.
                    </h1>

                    <p>
                        Manage foods, orders and registered users
                        from one place.
                    </p>

                </div>

            </div>


            {{-- Right Side --}}
            <div class="admin-login-form-area">

                <div class="admin-login-card">

                    <div class="admin-login-header">

                        <div class="admin-login-icon">
                            🔐
                        </div>

                        <h2>
                            Welcome Back
                        </h2>

                        <p>
                            Sign in to access the admin panel
                        </p>

                    </div>


                    {{-- Error Message --}}
                    @if ($errors->any())

                        <div class="admin-login-error">

                            <span>⚠</span>

                            <div>
                                {{ $errors->first() }}
                            </div>

                        </div>

                    @endif


                    {{-- Success Message --}}
                    @if (session('success'))

                        <div class="admin-login-success">

                            <span>✓</span>

                            <div>
                                {{ session('success') }}
                            </div>

                        </div>

                    @endif


                    <form
                        method="POST"
                        action="{{ route('admin.login.store') }}"
                        class="admin-login-form"
                    >

                        @csrf


                        {{-- Email --}}
                        <div class="admin-form-group">

                            <label for="email">
                                Email Address
                            </label>

                            <div class="admin-input-wrapper">

                                <span class="admin-input-icon">
                                    ✉
                                </span>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="Enter admin email"
                                    autocomplete="email"
                                    required
                                >

                            </div>

                        </div>


                        {{-- Password --}}
                        <div class="admin-form-group">

                            <label for="password">
                                Password
                            </label>

                            <div class="admin-input-wrapper">

                                <span class="admin-input-icon">
                                    🔒
                                </span>

                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    placeholder="Enter password"
                                    autocomplete="current-password"
                                    required
                                >

                            </div>

                        </div>


                        <button
                            type="submit"
                            class="admin-login-submit"
                        >
                            <span>Login to Admin Panel</span>
                            <span class="login-arrow">→</span>
                        </button>

                    </form>


                    <div class="admin-login-footer">

                        <span>
                            KARAM Canteen
                        </span>

                        <span>
                            •
                        </span>

                        <span>
                            Authorized Admin Access
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>
</html>