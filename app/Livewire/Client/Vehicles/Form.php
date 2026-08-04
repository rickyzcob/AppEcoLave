<?php

namespace App\Livewire\Client\Vehicles;

use App\Repositories\Admin\Services\TypeVehiclesRepository;
use App\Repositories\Client\ClientVehiclesRepository;
use App\Traits\WithModal;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Form extends Component
{
    use WithModal, Interactions;

    public array $state = [
        'brand' => '',
        'type_vehicle_id' => '',
        'color' => '',
        'plate' => '',
    ];

    public $vehicle;

    public function mount($id = null)
    {
        $clientVehicleRepository = new ClientVehiclesRepository();
        $clientVehicleReturnDB = $clientVehicleRepository->show($id)['data'];
        $this->vehicle = $clientVehicleReturnDB;

        if($this->vehicle){
            $this->state = $this->vehicle->toArray();
        }
    }

    public function save()
    {
        if($this->vehicle){
            return $this->update();
        }

        $request = $this->state;

        $clientVehicleRepository = new ClientVehiclesRepository();
        $clientVehicleReturnDB = $clientVehicleRepository->create(Auth::id(), $request);

        if($clientVehicleReturnDB['status'] == 'success') {
            $this->toast()->success('Sucesso', $clientVehicleReturnDB['message'])->send();
            $this->closeCentralModal();
            $this->dispatch('getVehicles');

        } else if ($clientVehicleReturnDB['status'] == 'error') {
            $this->toast()->error('Erro', $clientVehicleReturnDB['message'])->send();
            $this->closeCentralModal();
        }
    }

    public function update()
    {
        $request = $this->state;

        $clientVehicleRepository = new ClientVehiclesRepository();
        $clientVehicleReturnDB = $clientVehicleRepository->update($this->vehicle->id, $request);

        if($clientVehicleReturnDB['status'] == 'success') {
            $this->toast()->success('Sucesso', $clientVehicleReturnDB['message'])->send();
            $this->closeCentralModal();
            $this->dispatch('getVehicles');
        } else if ($clientVehicleReturnDB['status'] == 'error') {
            $this->toast()->error('Erro', $clientVehicleReturnDB['message'])->send();
            $this->closeCentralModal();
        }
    }

    public function getSelectBrands()
    {
        $clientVehicleRepository = new ClientVehiclesRepository();
        return $clientVehicleRepository->getSelectBrandsVehicles();
    }

    public function getSelectColors()
    {
        $clientVehicleRepository = new ClientVehiclesRepository();
        return $clientVehicleRepository->getSelectColorsVehicles();
    }

    public function getSelectTypeVehicles()
    {
        $clientVehicleRepository = new TypeVehiclesRepository();
        return $clientVehicleRepository->getSelectTypeVehicle();
    }

    public function render()
    {
        $response = new \stdClass();
        $response->brands = $this->getSelectBrands();
        $response->colors = $this->getSelectColors();
        $response->types = $this->getSelectTypeVehicles();

        return view('livewire.client.vehicles.form', ['response' => $response]);
    }
}
