@if(session('success'))
    <x-alert title="Sucesso" icon="exclamation-triangle" color="green">
        {{ session('success') }}
    </x-alert>
@endif


@if(session('error'))
    <x-alert title="Erro" icon="exclamation-triangle" color="red">
        {{ session('error') }}
    </x-alert>
@endif
