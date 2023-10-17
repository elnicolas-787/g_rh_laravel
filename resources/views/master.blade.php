<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>G-RH | @yield('title')</title>
    @include('global.css')
    @stack('page-style')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('global.header')

        @if ($role == 1)

            @include('global.sidebar')

        @endif

        @yield('contenu')
    </div>
    <!-- ./wrapper -->

    @include('global.script')
    @stack('page-script')
</body>

</html>
