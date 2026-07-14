<div>
    <div class="flex items-center flex-wrap gap-3 justify-between px-4">
        <div class="font-bold text-gray-600">
            <h2 class="text-lg">Atribuir Profissional</h2>
        </div>
    </div>

    <form wire:submit="save">
        <div class="grid grid-cols-12 gap-3 p-5 ">

            <div class="col-span-12">
                <x-select.styled label="Lavador Responśavel *" wire:model="washer_id" :options="$response->washers" select="label:label|value:value" searchable/>
            </div>

            <div class="md:col-span-12">
                <x-button sm type="submit" text="Atribuir" />
            </div>
        </div>
    </form>
</div>
