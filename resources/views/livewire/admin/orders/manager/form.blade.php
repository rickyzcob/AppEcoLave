<div>
    <div class="flex items-center flex-wrap gap-3 justify-between px-4">
        <div class="font-bold text-gray-600">
            <h2 class="text-lg">{{$order ? "Editar" : 'Cadastrar'}} Pedido</h2>
        </div>
    </div>

    <form wire:submit="save">
        <div class="grid grid-cols-12 gap-3 p-5 ">

            <div class="md:col-span-4 col-span-12">
                <x-input icon="clipboard-document" x-mask="999.999.999-99" wire:model="state.user.taxpayer_registration" label="CPF *"  />
                @error('user.taxpayer_registration')
                <div class="text-red-700 text-xs py-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-1 col-span-12 pt-6 self-start ">
                <x-button.circle wire:click.prevent="getClient()" icon="magnifying-glass-circle" loading="getAddress()" />
            </div>

            <div class="md:col-span-7 col-span-12">
                <x-input icon="user" wire:model="state.user.name" label="Nome *"  />
                @error('user.name')
                <div class="text-red-700 text-xs py-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-7 col-span-12">
                <x-input icon="envelope" wire:model="state.user.email" label="Email *"  />
                @error('user.email')
                <div class="text-red-700 text-xs py-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-5 col-span-12">
                <x-input icon="phone" x-mask="(99) 9 9999-9999" wire:model="state.user.phone" label="Whatsapp *"  />
                @error('user.phone')
                <div class="text-red-700 text-xs py-2">{{ $message }}</div>
                @enderror
            </div>


            <div class="col-span-12">
                <div class="flex justify-between items-center py-2 border-b border-blue-200 mb-2">
                    <h1> Dados do veículo </h1>
                </div>
            </div>

            <div class="md:col-span-4 col-span-12">
                <x-input  wire:model="state.vehicle" label="Modelo do veículo *"  />
                @error('vehicle')
                <div class="text-red-700 text-xs py-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-4 col-span-12">
                <x-input wire:model="state.vehicle_plate" label="Placa do veículo *"  />
                @error('vehicle_plate')
                <div class="text-red-700 text-xs py-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-4 col-span-12">
                <x-select.styled label="Lavador Responśavel *" wire:model.live="state.washer_id" :options="$response->washers" select="label:label|value:value" searchable/>

                @error('washer_id')
                <div class="text-red-700 text-xs py-2">{{ $message }}</div>
                @enderror
            </div>


            <div class="col-span-12">
                <div class="flex justify-between items-center py-2 border-b border-blue-200 mb-2">
                    <h1> Serviço </h1>
                </div>
            </div>

            <div class="md:col-span-6 col-span-12">
                <x-select.styled label="Tipo de Veículo" wire:model.live="state.type_id" :options="$response->types" select="label:label|value:value" searchable/>
                @error('type_id')
                <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-6 col-span-12">
                <x-select.styled label="Tipo de Limpeza" wire:model.live="state.service_id" :options="$response->services" select="label:label|value:value" searchable/>
                @error('service_id')
                <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-span-12">
                <div class="flex justify-between items-center py-2 border-b border-blue-200 mb-2">
                    <h1> Endereço </h1>
                </div>
            </div>

            <div class="md:col-start-1 md:col-end-5 col-span-12">
                <x-input icon="map-pin" x-mask="99999-999" wire:model="state.zip_code" label="CEP *" />
                @error('zip_code')
                <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-1 col-span-12 pt-6 self-start ">
                <x-button.circle wire:click.prevent="getAddress()" icon="magnifying-glass-circle" loading="getAddress()" />
            </div>

            <div class="md:col-span-9  col-span-12">
                <x-input icon="map" wire:model="state.street" label="Endereço *" />
                @error('street')
                <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-3 col-span-12">
                <x-input wire:model="state.number" label="Numero *" />
                @error('number')
                <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-6 col-span-12">
                <x-input wire:model="state.complement" label="Complemento" />
                @error('complement')
                <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-6 col-span-12">
                <x-input wire:model="state.neighborhood" label="Bairro *" />
                @error('neighborhood')
                <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-5 col-span-12">
                <x-input wire:model="state.uf" label="Estado *" />
                @error('uf')
                <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-7  col-span-12">
                <x-input wire:model="state.city" label="Cidade *" />
                @error('city')
                <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-12">
                <x-button sm type="submit" text="{{$order ? 'Atualizar' : 'Cadastrar' }}" />
            </div>
        </div>
    </form>
</div>
