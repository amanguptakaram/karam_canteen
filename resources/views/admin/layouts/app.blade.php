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

</body>

</html>
