<div>
    <div class="flex items-center flex-wrap gap-3 justify-between p-4">
        <div class="font-bold text-gray-600">
            <h2 class="text-lg font-medium">{{$vehicle ? "Editar" : 'Cadastrar'}} Veículo</h2>
        </div>
    </div>

    <form wire:submit="save">
        <div class="grid grid-cols-12 gap-4 p-4 ">

            <div class="md:col-span-6 col-span-12">
                <x-select.styled label="Marca *" wire:model.live="state.brand" :options="$response->brands" searchable/>
                @error('brand')
                <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-6 col-span-12">
                <x-select.styled label="Cor *" wire:model.live="state.color" :options="$response->colors" searchable />
                @error('color')
                <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-4 col-span-12">
                <x-input  wire:model="state.name" label="Veículo *"  />
                @error('name')
                <div class="text-red-700 text-xs py-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-4 col-span-12 " x-data="plateMask()">
                <x-input x-model="plate" @input="formatPlate" wire:model="state.plate" label="Placa *"  />
                @error('plate')
                <div class="text-red-700 text-xs py-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-4 col-span-12">
                <x-select.styled label="Tipo *" wire:model.live="state.type_vehicle_id" :options="$response->types" searchable />
                @error('type_vehicle_id')
                <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-4 col-span-12">
                <x-input  wire:model="state.year" label="Ano *"  />
                @error('year')
                <div class="text-red-700 text-xs py-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-12">
                <x-button sm type="submit" text="{{$vehicle ? 'Atualizar' : 'Cadastrar' }}" />
            </div>
        </div>
    </form>
</div>



