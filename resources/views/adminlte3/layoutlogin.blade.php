<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<title>@if (isset($namaapps01)){{ $namaapps01 }}@else{{ config('global.Title') }}@endif
        </title>
		<meta content="@if (isset($domainapps01)){{ $domainapps01 }}@else{{ config('global.swandhananama') }}@endif" name="description" />
        <meta content="@if (isset($subdomainapps01)){{ $subdomainapps01 }}@else{{ config('global.swandhanauniv') }}@endif" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2, user-scalable=yes">
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- App favicon -->
        <link rel="icon" href="{{ asset('logo-ub.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('logo-ub.png') }}">
        <!-- App css -->
        @include('adminlte3.css')
    </head>
    <body class="hold-transition login-page">
        @yield('content')
        @include('adminlte3.jsstandart')
        @stack('script')
    </body>
</html>