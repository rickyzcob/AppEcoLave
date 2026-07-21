<div>
    <div class="section-header">
        <div>
            <div class="section-title">
                <i class="fas fa-calendar-plus"></i>
                Novo Agendamento
            </div>
            <div class="section-subtitle">Agende sua lavagem com facilidade</div>
        </div>
    </div>

    <div class="alert alert-success">
        <i class="fas fa-info-circle"></i>
        Você possui <strong>5 cupons disponíveis</strong>. Aproveite no próximo agendamento!
    </div>

    <div class="form-card">
        <form wire:submit="save">
            <div class="grid grid-cols-12 gap-4 items-start">

                <!-- Veículo -->
                <div class="md:col-span-3 col-span-12 form-group">
                    <label class="form-label" for="veiculo">
                        <i class="fas fa-car"></i> Veículo
                    </label>
                    <select wire:model.live="state.vehicle_id" class="form-control">
                        <option value="">Selecione seu veículo</option>
                        @foreach($response->vehicles as $itemVehicle)
                            <option value="{{$itemVehicle['value']}}">{{ $itemVehicle['label'] }}</option>
                        @endforeach
                    </select>
                    @error('vehicle_id')
                    <div class="form_error_message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tipo de Lavagem -->
                <div class="md:col-span-3 col-span-12 form-group">
                    <label class="form-label" for="tipo_lavagem">
                        <i class="fas fa-car-wash"></i> Tipo de Lavagem
                    </label>
                    <select wire:model.live="state.service_id" class="form-control">
                        <option value="">Selecione o tipo</option>
                        @foreach($response->services as $itemService)
                            <option value="{{$itemService['value']}}">{{$itemService['label']}}</option>
                        @endforeach
                    </select>
                    @error('service_id')
                    <div class="form_error_message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Data -->
                <div class="md:col-span-3 col-span-12 form-group">
                    <label class="form-label" for="data_agendamento">
                        <i class="fas fa-calendar"></i> Data
                    </label>
                    <input type="date" wire:model.live="state.date_schedule" class="form-control" min="2026-07-14">
                    @error('date_schedule')
                    <div class="form_error_message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Horário -->
                <div class="md:col-span-3 col-span-12 form-group">
                    <label class="form-label" for="horario">
                        <i class="fas fa-clock"></i> Horário
                    </label>
                    <select wire:model="state.hour_schedule" class="form-control">
                        <option value="">Selecione o horário</option>
                        @foreach($response->times as $itemTime)
                            <option value="{{$itemTime}}">{{$itemTime}} — Disponível</option>
                        @endforeach
                    </select>

                    @error('hour_schedule')
                    <div class="form_error_message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-2 col-span-12 form-group">
                    <label class="form-label" for="endereco_atendimento">
                        <i class="fas fa-map-marker-alt"></i> Cep
                    </label>
                    <input type="text" x-mask="99999-999" wire:model="state.zip_code" class="form-control" placeholder="00000-000">
                    @error('zip_code')
                    <div class="form_error_message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-1 col-span-12 form-group pt-7">
                    <button wire:click.prevent="getAddress" class="btn btn-primary btn-lg btn-full">
                         <i class="fas fa-magnifying-glass font-bold"></i>
                    </button>
                </div>

                <div class="md:col-span-5 col-span-12 form-group">
                    <label class="form-label" >
                        <i class="fas fa-map-marker-alt"></i> Endereço de Atendimento
                    </label>
                    <input type="text" wire:model="state.street" class="form-control" placeholder="Ex: Rua das Flores">
                    @error('street')
                    <div class="form_error_message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-1 col-span-12 form-group">
                    <label class="form-label" for="number">
                        <i class="fas fa-map-marker-alt"></i> Numero
                    </label>
                    <input type="text" wire:model="state.number" class="form-control" placeholder="0000">
                    @error('number')
                    <div class="form_error_message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-3 col-span-12 form-group">
                    <label class="form-label" for="complement">
                        <i class="fas fa-map-marker-alt"></i> Complemento
                    </label>
                    <input type="text" wire:model="state.complement" class="form-control" placeholder="Ex: Apto 153 - Torre A">
                    @error('complement')
                    <div class="form_error_message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-3 col-span-12 form-group">
                    <label class="form-label" for="neighborhood">
                        <i class="fas fa-map-marker-alt"></i> Bairro
                    </label>
                    <input type="text" wire:model="state.neighborhood" class="form-control" placeholder="Ex: São matheus">
                    @error('neighborhood')
                    <div class="form_error_message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-3 col-span-12 form-group">
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

                <!-- Observações -->
                <div class="form-group form-group-full">
                    <label class="form-label" for="observacoes">
                        <i class="fas fa-comment"></i> Observações
                    </label>
                    <textarea id="observacoes" name="observacoes" class="form-control" placeholder="Alguma instrução especial para o profissional?"></textarea>
                </div>

                <!-- Cupom -->
                <div class="md:col-span-3 col-span-12 form-group">
                    <label class="form-label" for="cupom">
                        <i class="fas fa-ticket-alt"></i> Cupom de Desconto
                    </label>
                    <input type="text" id="cupom" name="cupom" class="form-control" placeholder="Digite seu cupom">
                </div>

                <!-- Pagamento -->
                <div class="md:col-span-3 col-span-12 form-group">
                    <label class="form-label" for="pagamento">
                        <i class="fas fa-credit-card"></i> Forma de Pagamento
                    </label>
                    <select id="pagamento" name="pagamento" class="form-control">
                        <option value="">Selecione o pagamento</option>
                        <option value="pix">PIX</option>
                        <option value="cartao">Cartão de Crédito</option>
                        <option value="carteira">Saldo da Carteira</option>
                        <option value="cashback">Cashback</option>
                    </select>
                </div>

                <!-- Botão Agendar -->
                <div class="form-group form-group-full" style="margin-top: 6px;">
                    <button type="submit" class="btn btn-primary btn-lg btn-full">
                        <i class="fas fa-calendar-check"></i>
                        AGENDAR AGORA
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>
