<div>
    <div class="section-header">
        <div>
            <div class="section-title">
                <i class="fas fa-car"></i>
                Meus Veículos
            </div>
            <div class="section-subtitle">Gerencie seus veículos cadastrados</div>
        </div>
        <button wire:click="openCentralModal('client.vehicles.form', {'id': null })" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Adicionar
        </button>
    </div>

    <div class="vehicles-grid">

        @foreach($response->vehicles as $itemVehicle)
            <div class="vehicle-card">
                <div class="vehicle-image">
                    🚗
{{--                    <span class="vehicle-image-badge">Principal</span>--}}
                </div>
                <div class="vehicle-body">
                    <div class="vehicle-brand">{{$itemVehicle['brand']}}</div>
                    <div class="vehicle-model">{{$itemVehicle['name']}}</div>
                    <div class="vehicle-details-row">
                        <div>
                            <div class="vehicle-detail-label">Ano</div>
                            <div class="vehicle-detail-value">{{$itemVehicle['year']}}</div>
                        </div>
                        <div>
                            <div class="vehicle-detail-label">Cor</div>
                            <div class="vehicle-detail-value">{{$itemVehicle['color']}}</div>
                        </div>
                        <div>
                            <div class="vehicle-detail-label">Tipo</div>
                            <div class="vehicle-detail-value">{{$itemVehicle['type']}}</div>
                        </div>
                    </div>
                    <div class="vehicle-plate">ABC-1D34</div>
                </div>
                <div class="vehicle-actions">
                    <button wire:click="openCentralModal('client.vehicles.form', {'id': {{$itemVehicle['id']}} })" class="btn btn-outline btn-sm" style="flex:1;">
                        <i class="fas fa-pen"></i> Editar
                    </button>
                    <button wire:click="confirmDelete({{$itemVehicle['id']}})" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        @endforeach

        <button href="#" wire:click="openCentralModal('client.vehicles.form', {'id': null })" class="vehicle-card vehicle-card-add">
            <i class="fas fa-plus-circle"></i>
            <span>Adicionar Novo Veículo</span>
        </button>

    </div>
</div>
