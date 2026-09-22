<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Admin Panel') | KARAM Canteen
    </title>

    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    @stack('styles')

</head>


<body class="admin-body">

    <div class="admin-layout">

        @include('admin.partials.sidebar')


        <div class="admin-main">

            @include('admin.partials.header')


            <main class="admin-content">



                @yield('content')

            </main>

        </div>

    </div>


    @stack('scripts')


    @if (session('permission_error'))
        <div id="permissionModal" class="permission-modal-overlay">

            <div class="permission-modal">

                <button type="button" class="permission-modal-close" onclick="closePermissionModal()">
                    &times;
                </button>

                <div class="permission-icon">
                    !
                </div>

                <h3>Access Restricted</h3>

                <p>
                    {{ session('permission_error') }}
                </p>

                <button type="button" class="permission-ok-btn" onclick="closePermissionModal()">
                    OK
                </button>

            </div>

        </div>
    @endif
    <script>
        function closePermissionModal() {
            const modal = document.getElementById('permissionModal');

            if (modal) {
                modal.remove();
            }
        }
    </script>

</body>

</html>
</body>

</html>
