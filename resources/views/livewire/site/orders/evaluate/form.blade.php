<div>
    <div class="flex items-center flex-wrap gap-3 justify-between p-4">
        <div class="font-bold text-gray-600">
            <h2 class="text-lg font-medium">Avaliação do Serviço</h2>
        </div>
    </div>

    <form wire:submit="save">
        <div class="grid grid-cols-12 gap-4 p-4 ">

            <div class="col-span-12">
                <x-rating wire:model="state.rate" color="yellow" />
            </div>

            <div class="col-span-12">
                <x-textarea  wire:model="state.comment" label="Comentário *"  />
                @error('comment')
                <div class="text-red-700 text-xs py-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-12">
                <x-button sm type="submit" text="Enviar Avaliação" />
            </div>
        </div>
    </form>
</div>
