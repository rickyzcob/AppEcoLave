<div>
    <form wire:submit="update">

        <div class="grid grid-cols-12 gap-4 p-5 items-end">
            <div class="md:col-span-4 col-span-12 input-group">
                <label>Nome</label>
                <input type="text" wire:model="state.name">
                @error('name')
                <p class="form_error_message">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2 col-span-12 input-group">
                <label>CPF</label>
                <input type="text" x-mask="999.999.999-99"  wire:model="state.taxpayer_registration">
                @error('taxpayer_registration')
                <p class="form_error_message">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-3 col-span-12 input-group">
                <label>Telefone</label>
                <input type="text" x-mask="(99) 9 9999-9999" wire:model="state.phone" >
                @error('phone')
                <p class="form_error_message">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-3 col-span-12 input-group">
                <label>Email</label>
                <input type="email"  wire:model="state.email" >
                @error('email')
                <p class="form_error_message">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2 col-span-12 input-group">
                <label>Cep</label>
                <input x-mask="99999-999"  wire:model="state.zip_code" >
                @error('zip_code')
                <p class="form_error_message">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2 col-span-12 input-group">
                <div class="flex flex-col w-full p-1">
                    <button class="btn" wire:click="getAddress()">Buscar</button>
                </div>
            </div>

            <div class="md:col-span-6 col-span-12 input-group">
                <label>Endereço</label>
                <input type="text"  wire:model="state.address" >
                @error('address')
                <p class="form_error_message">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2 col-span-12 input-group">
                <label>Numero</label>
                <input type="text"  wire:model="state.number" >
                @error('number')
                <p class="form_error_message">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-3 col-span-12 input-group">
                <label>Complemento</label>
                <input type="text"  wire:model="state.complement" >
                @error('complement')
                <p class="form_error_message">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-4 col-span-12 input-group">
                <label>Bairro</label>
                <input type="text"  wire:model="state.neighborhood" >
                @error('neighborhood')
                <p class="form_error_message">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-3 col-span-12 input-group">
                <label>Cidade</label>
                <input type="text"  wire:model="state.city" >
                @error('city')
                <p class="form_error_message">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2 col-span-12 input-group">
                <label>Estado</label>
                <input type="text"  wire:model="state.uf" >
                @error('uf')
                <p class="form_error_message">{{ $message }}</p>
                @enderror
            </div>

{{--        <div class="input-group full">--}}
{{--            <label>Área de atuação</label>--}}
{{--            <input type="text" value="Belém, Ananindeua, Marituba">--}}
{{--        </div>--}}

            <div class="md:col-span-4 col-span-12 input-group">
                <button class="btn" type="submit">Salvar Alterações</button>
            </div>
        </div>
    </form>
</div>
