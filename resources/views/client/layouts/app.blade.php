<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoLave BR — Painel do Cliente</title>

    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

{{--    <link rel="stylesheet" href="{{asset('client/css/style.css')}}">--}}

    @livewireStyles

    <tallstackui:script/>

    @vite(['resources/css/client.css', 'resources/js/app.js'])

</head>
<body>

@include('client.partials.mobile')


<div class="layout">

    <x-dialog/>
    <x-slide/>
    <x-modal/>
    <x-toast/>


    @include('client.partials.sidebar')

    <main class="main-content">

        @include('client.partials.header')

        <div class="page-content">

            @yield('content')

        </div>

        @include('client.partials.footer')

    </main>


    <livewire:components.open-modal/>
    <livewire:components.open-slide1/>
    <livewire:components.open-slide2/>
    <livewire:components.open-slide3/>


</div>

@livewireScriptConfig

<script>
    function plateMask() {
        return {
            plate: '',

            formatPlate() {
                // Remove caracteres inválidos
                let value = this.plate
                    .toUpperCase()
                    .replace(/[^A-Z0-9]/g, '');

                // Limita a 7 caracteres
                value = value.substring(0, 7);

                // Enquanto os 4 primeiros caracteres não estiverem completos,
                // apenas exibe o que foi digitado.
                if (value.length <= 3) {
                    this.plate = value;
                    return;
                }

                // Se o 4º caractere for letra, força formato Mercosul
                // (caso raro, mas evita inconsistência)
                if (/[A-Z]/.test(value[3])) {
                    value = value.substring(0, 3);
                    this.plate = value;
                    return;
                }

                // Verifica se há letra na 5ª posição
                // ABC1D23 = Mercosul
                if (value.length >= 5 && /[A-Z]/.test(value[4])) {
                    this.plate = value.substring(0, 3) + '-' + value.substring(3);
                } else {
                    // Formato antigo ABC-1234
                    if (value.length > 3) {
                        this.plate = value.substring(0, 3) + '-' + value.substring(3);
                    } else {
                        this.plate = value;
                    }
                }
            }
        }
    }
</script>

</body>
</html>
