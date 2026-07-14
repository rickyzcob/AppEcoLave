<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'EcoLave')</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    @livewireStyles

    <tallstackui:script/>

    @vite(['resources/css/admin.css', 'resources/js/app.js'])


</head>

<body>
<div class="admin">

    <x-dialog/>
    <x-slide/>
    <x-modal/>
    <x-toast/>

    <livewire:components.open-modal/>
    <livewire:components.open-slide1/>
    <livewire:components.open-slide2/>
    <livewire:components.open-slide3/>

    @include('admin.partials.sidebar')

    <main class="content">

        @yield('content')

    </main>
</div>

@livewireScriptConfig


</body>
</html>
