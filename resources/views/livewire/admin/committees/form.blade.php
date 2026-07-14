<div>
    <div class="flex items-center flex-wrap gap-3 justify-between p-4">
        <div class="font-bold text-gray-600">
            <h2 class="text-lg font-medium">{{$committee ? "Editar" : 'Cadastrar'}} Comissão</h2>
        </div>
    </div>

    <form wire:submit="save">
        <div class="grid grid-cols-12 gap-4 p-4 ">
            <div class="md:col-span-6 col-span-12">
                <x-input icon="user" wire:model="state.name" label="Nome *"  />
                @error('name')
                <div class="text-red-700 text-xs py-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-6 col-span-12">
                <x-number step="0.1"  wire:model="state.value" label="Porcentagem *" centralized />
                @error('value')
                <div class="text-red-700 text-xs py-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-12">
                <x-button sm type="submit" text="{{$committee ? 'Atualizar' : 'Cadastrar' }}" />
            </div>
        </div>
    </form>
</div>
