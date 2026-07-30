<div>
    <x-loading loading="save" />

    <div class="section-header">
        <div>
            <div class="section-title">
                <i class="fas fa-calendar-plus"></i>
                Pagamento via cartão de crédito
            </div>
            <div class="section-subtitle">Insira os dados do cartão para efetuar o pagamento</div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-4">
        <div class="md:col-span-8 col-span-12">
            <div class="form-card">
                <form wire:submit="save">
                    <div class="grid grid-cols-12 gap-4 items-start">
                        <div class="md:col-span-6 col-span-12 form-group">
                            <label class="form-label" for="name">
                                <i class="fas fa-calendar"></i> Nome Titular
                            </label>
                            <input type="text" wire:model="state.name" class="form-control">
                            @error('name')
                            <div class="form_error_message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="md:col-span-6 col-span-12 form-group">
                            <label class="form-label" for="email">
                                <i class="fas fa-calendar"></i> Email Titular
                            </label>
                            <input type="email" wire:model="state.email" class="form-control">
                            @error('email')
                            <div class="form_error_message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="md:col-span-6 col-span-12 form-group">
                            <label class="form-label" for="endereco_atendimento">
                                <i class="fas fa-map-marker-alt"></i> Telefone Titular
                            </label>
                            <input type="text" x-mask="(99) 9 9999-9999" wire:model="state.phone" class="form-control">
                            @error('phone')
                            <div class="form_error_message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="md:col-span-6 col-span-12 form-group">
                            <label class="form-label" for="endereco_atendimento">
                                <i class="fas fa-map-marker-alt"></i> CPF
                            </label>
                            <input type="text" x-mask="999.999.999-99" wire:model="state.taxpayer_registration" class="form-control">
                            @error('phone')
                            <div class="form_error_message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-span-12">
                            <div class="section-title">
                                <i class="fas fa-calendar-plus"></i>
                                Endereço
                            </div>
                        </div>

                        <div class="md:col-span-3 col-span-12 form-group">
                            <label class="form-label" for="endereco_atendimento">
                                <i class="fas fa-map-marker-alt"></i> Cep
                            </label>
                            <input type="text" x-mask="99999-999" wire:model="state.zip_code" class="form-control" placeholder="00000-000">
                            @error('zip_code')
                            <div class="form_error_message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="md:col-span-2 col-span-12 form-group pt-7">
                            <button wire:click.prevent="getAddress" class="btn btn-primary btn-lg btn-full">
                                <i class="fas fa-magnifying-glass font-bold"></i>
                            </button>
                        </div>

                        <div class="md:col-span-7 col-span-12 form-group">
                            <label class="form-label" >
                                <i class="fas fa-map-marker-alt"></i> Endereço de Atendimento
                            </label>
                            <input type="text" wire:model="state.street" class="form-control" placeholder="Ex: Rua das Flores">
                            @error('street')
                            <div class="form_error_message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="md:col-span-3 col-span-12 form-group">
                            <label class="form-label" for="number">
                                <i class="fas fa-map-marker-alt"></i> Numero
                            </label>
                            <input type="text" wire:model="state.number" class="form-control" placeholder="0000">
                            @error('number')
                            <div class="form_error_message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="md:col-span-9 col-span-12 form-group">
                            <label class="form-label" for="complement">
                                <i class="fas fa-map-marker-alt"></i> Complemento
                            </label>
                            <input type="text" wire:model="state.complement" class="form-control" placeholder="Ex: Apto 153 - Torre A">
                            @error('complement')
                            <div class="form_error_message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="md:col-span-4 col-span-12 form-group">
                            <label class="form-label" for="neighborhood">
                                <i class="fas fa-map-marker-alt"></i> Bairro
                            </label>
                            <input type="text" wire:model="state.neighborhood" class="form-control" placeholder="Ex: São matheus">
                            @error('neighborhood')
                            <div class="form_error_message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="md:col-span-5 col-span-12 form-group">
                            <label class="form-label" for="city">
                                <i class="fas fa-map-marker-alt"></i> Cidade
                            </label>
                            <input type="text" wire:model="state.city" class="form-control" placeholder="Ex: Barbacena">
                            @error('city')
                            <div class="form_error_message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="md:col-span-3 col-span-12 form-group">
                            <label class="form-label" for="uf">
                                <i class="fas fa-map-marker-alt"></i> Estado
                            </label>
                            <input type="text" wire:model="state.uf" class="form-control" placeholder="Ex: Belém">
                            @error('city')
                            <div class="form_error_message">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="col-span-12">
                            <div class="section-title">
                                <i class="fas fa-calendar-plus"></i>
                                Dados do Cartão
                            </div>
                        </div>

                        <div class="md:col-span-6 col-span-12 form-group">
                            <label class="form-label" for="name">
                                <i class="fas fa-calendar"></i> Nome no Cartão
                            </label>
                            <input type="text" wire:model="state.holder_name" class="form-control">
                            @error('holder_name')
                            <div class="form_error_message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="md:col-span-6 col-span-12 form-group">
                            <label class="form-label" for="name">
                                <i class="fas fa-calendar"></i> Numero do Cartão
                            </label>
                            <input type="text" x-mask="9999 9999 9999 9999" wire:model="state.holder_number" class="form-control">
                            @error('holder_number')
                            <div class="form_error_message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="md:col-span-2 col-span-12 form-group">
                            <label class="form-label" for="name">
                                <i class="fas fa-calendar"></i> Mês
                            </label>
                            <input type="text" x-mask="99" wire:model="state.expiry_month" class="form-control">
                            @error('expiry_month')
                            <div class="form_error_message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="md:col-span-2 col-span-12 form-group">
                            <label class="form-label" for="name">
                                <i class="fas fa-calendar"></i> Ano
                            </label>
                            <input type="text" x-mask="9999" wire:model="state.expiry_year" class="form-control">
                            @error('expiry_year')
                            <div class="form_error_message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="md:col-span-2 col-span-12 form-group">
                            <label class="form-label" for="name">
                                <i class="fas fa-calendar"></i> CCV
                            </label>
                            <input type="text" x-mask="999" wire:model="state.ccv" class="form-control">
                            @error('ccv')
                            <div class="form_error_message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group form-group-full" style="margin-top: 6px;">
                            <button type="submit" class="btn btn-primary btn-lg btn-full">
                                <i class="fas fa-calendar-check"></i>
                                PAGAR
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
        <div class="md:col-span-4 col-span-12">
            <div class="vehicle-card">
                <div class="vehicle-image">
                    🚗
                    {{--                    <span class="vehicle-image-badge">Principal</span>--}}
                </div>
                    <div class="flex flex-col items-center justify-center py-4">
                        <div class="vehicle-brand">{{$response->order['vehicle']['brand']}}</div>
                        <div class="vehicle-model">{{$response->order['vehicle']['name']}}</div>
                        <div class="vehicle-plate">{{$response->order['vehicle']['plate']}}</div>

                        <div class="section-title">
                            <h1> {{$response->order['service']['name']}} </h1>
                        </div>
                        <div class="section-title">
                            <h1 class="text-cyan-700"> {{formatMoney($response->order['service']['price'])}} </h1>
                        </div>
                    </div>
                </div>
            </div>
    </div>

</div>
