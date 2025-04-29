<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Seamarine') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <script src="{{ mix('js/app.js') }}" defer></script>

	<script src="https://unpkg.com/phosphor-icons"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div id="app">
		<nav class="navbar fixed-top navbar-expand-md navbar-light bg-dark shadow-sm">
			<div class="container-fluid">
				<a class="navbar-brand text-info" href="{{ url('/') }}">
					<img src="{{ asset('/images/logo.png') }}" height="50px">
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
					<span class="navbar-toggler-icon"></span>
				</button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent"></div>
            </div>
        </nav>

        <main class="pt-5 mt-5">
            @yield('content')
        </main>
    </div>
</body>
</html>
