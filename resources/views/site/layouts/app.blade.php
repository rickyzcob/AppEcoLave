<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'EcoLave')</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    @livewireStyles
    <tallstackui:script />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>

    <x-dialog />
    <x-slide />
    <x-modal />
    <x-toast />

    <livewire:components.open-modal/>

    <header>
        @include('site.partials.menu')
    </header>

    @yield('content')

    @include('site.partials.footer')

    @livewireScriptConfig

    <script src="{{asset('site/assets/js/app.js')}}"></script>

</body>
</html>
