<?php

namespace App\Livewire\Admin\Service;

use App\Repositories\Admin\Services\TypeVehiclesRepository;
use App\Traits\WithModal;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Form extends Component
{
    use WithModal, Interactions;

    public array $state = [
        'status' => '',
    ];

    public $type_service;

    public function mount($id = null)
    {
        $typeVehicleRepository = new TypeVehiclesRepository();
        $typeVehicleReturnDB = $typeVehicleRepository->show($id)['data'];
        $this->type_service = $typeVehicleReturnDB;

        if($this->type_service){
            $this->state = $this->type_service->toArray();
        }
    }

    public function save()
    {
        if($this->type_service){
            return $this->update();
        }

        $request = $this->state;

        $typeVehicleRepository = new TypeVehiclesRepository();
        $typeVehicleReturnDB = $typeVehicleRepository->create($request);

        if($typeVehicleReturnDB['status'] === 'success') {
            $this->toast()->success('Sucesso', $typeVehicleReturnDB['message'])->send();
            $this->closeCentralModal();
            $this->dispatch('getServices');
        } else if ($typeVehicleReturnDB['status'] === 'error') {
            $this->toast()->error('Erro', $typeVehicleReturnDB['message'])->send();
            $this->closeCentralModal();
        }
    }

    public function update()
    {
        $request = $this->state;

        $typeVehicleRepository = new TypeVehiclesRepository();
        $typeVehicleReturnDB = $typeVehicleRepository->update($this->type->id, $request);

        if($typeVehicleReturnDB['status'] === 'success') {
            $this->toast()->success('Sucesso', $typeVehicleReturnDB['message'])->send();
            $this->closeCentralModal();
            $this->dispatch('getServices');
        } else if ($typeVehicleReturnDB['status'] === 'error') {
            $this->toast()->error('Erro', $typeVehicleReturnDB['message'])->send();
            $this->closeCentralModal();
        }
    }

    public function render()
    {
        return view('livewire.admin.service.form');
    }
}
