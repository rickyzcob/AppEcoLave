<div>
    <section id="servicos" class="page-section active">
        <div class="panel">

            <div class="panel-head">
                <h2>Tipos de Serviços</h2>
                <button class="btn" wire:click="openSlide('admin.service.form', {'id': {{$type_id}} }, 2)">Novo Serviço</button>
            </div>


            <form wire:submit="save">
                <div class="grid grid-cols-12 gap-4 p-2 ">
                    <div class="col-span-12 col-span-12">
                        <x-input icon="briefcase" wire:model="state.name" label="Nome *"  />
                        @error('name')
                        <div class="text-red-700 text-xs py-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-span-8 col-span-12">
                        <x-input icon="clipboard-document" wire:model="state.description" label="Descrição *"  />
                        @error('description')
                        <div class="text-red-700 text-xs py-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="md:col-span-4 col-span-12">
                        <x-currency wire:model="state.price" locale="pt-BR" label="Valor *" mutate currency />
                        @error('price')
                        <div class="text-red-700 text-xs py-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="md:col-span-12">
                        <x-button sm type="submit" text="{{$service ? 'Atualizar' : 'Cadastrar' }}" />
                    </div>
                </div>
            </form>


        </div>
    </section>
</div>
