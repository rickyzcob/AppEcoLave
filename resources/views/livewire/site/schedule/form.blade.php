<div>
    <div class="passo">
        <span class="passo-numero">1</span>
        <h3>Qual é o seu veículo?</h3>
        <div class="opcoes-veiculo">
            @foreach($response->types as $itemType)
                <button type="button" wire:click="getType({{$itemType['id']}})" @if($itemType['id'] == $type_vehicle_id) class=" veiculo-btn active" @else class="veiculo-btn" @endif >
                    <div class="flex flex-col items-start">
                        <strong>{{$itemType['name']}}</strong>
                        <p>{{$itemType['description']}}</p>
                    </div>
                </button>
            @endforeach
        </div>
    </div>
    <div class="passo">
        <span class="passo-numero">2</span>
        <h3>Escolha o tipo de limpeza</h3>
        <div class="opcoes-lavagem">
{{--            @dd($service);--}}
            @foreach($response->services as $index => $itemService)
                <button type="button" class="lavagem-btn @if(isset($service['id']) && $itemService['id'] == $service['id']) active @endif" wire:click="getService({{$itemService['id']}})">
                    <strong>{{$itemService['name']}}</strong>
                    <small>{{$itemService['description']}}</small>
                    <span class="valor">{{formatMoney($itemService['price'])}}</span>
                </button>
            @endforeach
        </div>
    </div>
    <div class="resumo-agendamento">
        <div>
            <span>Seu serviço selecionado</span>
            @if($service)
                <h3>{{$service['type']['name']}} • {{$service['name']}}</h3>
            @else
                <h3> Escolha o Tipo de Serviço.</h3>
            @endif
        </div>
        <div class="resumo-preco">
            <span>Valor estimado</span>
            <strong id="precoFinal">{{formatMoney($service['price'] ?? 0)}}</strong>
        </div>
    </div>

    <div class="mb-3">
        @include('site.includes.alerts')
    </div>

    <form wire:submit="save">
        <div class="grid grid-cols-12 gap-4 w-full">

            <div class="md:col-span-6 col-span-12">
                <input class="form_input @error('phone') form_input--error @enderror" type="tel" x-mask="(99) 9 9999-9999" wire:model="state.phone" placeholder="Seu WhatsApp">
                @error('phone')
                <div class="form_error_message">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-6 col-span-12">
                <div class="flex flex-col h-full w-full">
                    <button type="button" class="btn-localizacao">Usar minha localização</button>
                </div>
            </div>

            <div class="md:col-span-3 col-span-12">
                <input class="form_input @error('zip_code') form_input--error @enderror" type="text" x-mask="99999-999" wire:model="state.zip_code" placeholder="Digite seu CEP" maxlength="9">
                @error('zip_code')
                <div class="form_error_message">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-2 col-span-12">
                <button type="button" wire:click="getAddress" class="btn-buscar-cep">Procurar CEP</button>
            </div>

            <div class="md:col-span-7 col-span-12">
                <input class="form_input @error('street') form_input--error @enderror" type="text" wire:model="state.street" id="endereco" placeholder="Rua / Avenida" >
                @error('street')
                <div class="form_error_message">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-2 col-span-12">
                <input class="form_input @error('number') form_input--error @enderror" type="text" wire:model="state.number"  placeholder="Número">
                @error('number')
                <div class="form_error_message">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-7 col-span-12">
                <input class="form_input @error('vehicle') form_input--error @enderror" type="text" wire:model="state.complement"  placeholder="Complemento">
                @error('complement')
                <div class="form_error_message">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-3 col-span-12">
                <input class="form_input @error('vehicle') form_input--error @enderror" type="text" wire:model="state.neighborhood" placeholder="Bairro">
                @error('neighborhood')
                <div class="form_error_message">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-3 col-span-12">
                <input class="form_input @error('city') form_input--error @enderror" type="text" wire:model="state.city" placeholder="Cidade">
                @error('city')
                <div class="form_error_message">{{ $message }}</div>
                @enderror
            </div>
            <div class="md:col-span-3 col-span-12">
                <input class="form_input @error('uf') form_input--error @enderror" type="text" wire:model="state.uf" placeholder="UF">
                @error('uf')
                <div class="form_error_message">{{ $message }}</div>
                @enderror
            </div>
            <div class="md:col-span-3 col-span-12">
                <input class="form_input @error('vehicle') form_input--error @enderror" type="text" wire:model="state.vehicle" placeholder="Modelo do veículo">
                @error('vehicle')
                <div class="form_error_message">{{ $message }}</div>
                @enderror
            </div>
            <div class="md:col-span-3 col-span-12">
                <input class="form_input @error('vehicle_plate') form_input--error @enderror" type="text" wire:model="state.vehicle_plate" placeholder="Placa do veículo">
                @error('vehicle_plate')
                <div class="form_error_message">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <label class="upload-veiculo mt-4" for="fotosVeiculo">
            <div class="upload-texto">
                <strong>Enviar fotos do estado do carro</strong>
                <span>Adicione fotos da parte externa, interna ou detalhes importantes antes da lavagem.</span>
            </div>
            <div class="upload-icone">📷</div>
            <input type="file" id="fotosVeiculo" accept="image/*" multiple onchange="mostrarArquivosSelecionados(this)">
        </label>
        <div id="uploadPreview" class="upload-preview"></div>

        <button class="btn" type="submit" style="width:100%;margin-top:20px">Continuar Agendamento</button>
    </form>

</div>

<script>

    function getLocation() {

        if (!navigator.geolocation) {
            alert('Seu navegador não suporta Geolocalização.');
            return;
        }

        navigator.geolocation.getCurrentPosition(
            function(position) {
                Livewire.find(@this.__instance.id).call(
                    'saveLocation',
                    position.coords.latitude,
                    position.coords.longitude
                );
            },
            function(error) {
                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        alert('Permissão negada.');
                        break;
                    case error.POSITION_UNAVAILABLE:
                        alert('Localização indisponível.');
                        break;
                    case error.TIMEOUT:
                        alert('Tempo esgotado.');
                        break;
                    default:
                        alert('Erro ao obter localização.');
                }
            },
            {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0
            }
        );
    }

    function mostrarArquivosSelecionados(input){
        const preview = document.getElementById('uploadPreview');
        preview.innerHTML = '';

        if(!input.files || input.files.length === 0){
            preview.classList.remove('active');
            return;
        }

        Array.from(input.files).forEach(function(file){
            const item = document.createElement('span');
            item.innerText = file.name;
            preview.appendChild(item);
        });

        preview.classList.add('active');
    }
</script>
