<div>
    <div class="flex items-center flex-wrap gap-3 justify-between p-2">
        <div class="font-bold text-gray-600">
            <h2 class="text-lg font-medium">{{$type_service ? "Editar" : 'Cadastrar'}} Tipo de Serviço</h2>
        </div>
    </div>

    <form wire:submit="save">
        <div class="grid grid-cols-12 gap-4 p-2 ">
            <div class="col-span-12">
                <x-input icon="user" wire:model="state.name" label="Nome *"  />
                @error('name')
                <div class="text-red-700 text-xs py-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-span-12">
                <x-input icon="document" wire:model="state.description" label="Descrição *"  />
                @error('description')
                <div class="text-red-700 text-xs py-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-12">
                <x-button sm type="submit" text="{{$type_service ? 'Atualizar' : 'Cadastrar' }}" />
            </div>
        </div>
    </form>
</div>
