<div>
    <div class="flex items-center flex-wrap gap-3 justify-between p-4">
        <div class="font-bold text-gray-600">
            <h2 class="text-lg font-medium">Nova Solicitação de Saque</h2>
        </div>
    </div>

    <form wire:submit="save">
        <div class="grid grid-cols-12 gap-4 p-4 ">
            <div class="md:col-span-6 col-span-12">
                <x-currency wire:model="state.amount" locale="pt-BR" label="Valor *" mutate currency />
                @error('amount')
                <div class="text-red-700 text-xs py-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-6 col-span-12">
                <x-input label="Chave Pix" wire:model="state.key_pix" />
                @error('key_pix')
                <div class="text-red-700 text-xs py-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-12">
                <x-button sm type="submit" text="Solicitar" />
            </div>
        </div>
    </form>
</div>
