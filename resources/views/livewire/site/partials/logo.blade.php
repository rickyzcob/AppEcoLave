<div>
    @if(!$configuration)
        <a class="logo" href="{{ route('home') }}">Seu<span> Site</span></a>
    @elseif($configuration['logo'] === null)
        <a class="logo" href="{{ route('home') }}"> {{$configuration['name']}}</a>
    @elseif($configuration['logo'] !== null)
        <a class="logo" href="{{ route('home') }}"> <img src="{{asset('storage/'.$configuration['logo'])}} " alt="Logotipo" class="h-20"></a>
    @endif
</div>
