<div>
        <div class="flex items-center flex-wrap gap-3 justify-between p-4">
            <div class="font-bold text-gray-600">
                <h2 class="text-lg font-medium">{{$client ? "Editar" : 'Cadastrar'}} Cliente</h2>
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
                    <x-input icon="envelope" wire:model="state.email" label="Email *"  />
                    @error('email')
                    <div class="text-red-700 text-xs py-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-4 col-span-12">
                    <x-input icon="phone" x-mask="(99) 9 9999-9999" wire:model="state.phone" label="Whatsapp *"  />
                    @error('phone')
                    <div class="text-red-700 text-xs py-2">{{ $message }}</div>
                    @enderror
                </div>


                <div class="md:col-span-4 col-span-12">
                    <x-input icon="clipboard-document" x-mask="999.999.999-99" wire:model="state.taxpayer_registration" label="CPF *"  />
                    @error('taxpayer_registration')
                    <div class="text-red-700 text-xs py-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-4 col-span-12">
                    <x-select.styled label="Tipo *" wire:model.live="state.status"
                                     :options="[
                                        ['name' => 'Ativo', 'id' => 'active'],
                                        ['name' => 'Inativo', 'id' => 'inactive'],
                                   ]" select="label:name|value:id" />
                    @error('status')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>


                <div class="md:col-span-12">
                    <x-button sm type="submit" text="{{$client ? 'Atualizar' : 'Cadastrar' }}" />
                </div>
            </div>
        </form>
</div>
