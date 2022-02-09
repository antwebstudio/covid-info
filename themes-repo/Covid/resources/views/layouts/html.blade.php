<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Test</title>

        <link rel="canonical" href="{{ url()->current() }}">

        {{-- Styles --}}
		<link rel="stylesheet" href="{{ theme_mix('/css/theme.css') }}" media="screen">
		<style>
			header {
				background-color: #446BEB;
			}
		</style>
    </head>

    <body>
		@yield('layout')

        {{-- Scripts --}}
		<script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.3.0/alpine.js" integrity="sha512-nIwdJlD5/vHj23CbO2iHCXtsqzdTTx3e3uAmpTm4x2Y8xCIFyWu4cSIV8GaGe2UNVq86/1h9EgUZy7tn243qdA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{ theme_mix('/js/theme.js') }}"></script>
    </body>
</html>