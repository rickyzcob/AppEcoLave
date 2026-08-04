<?php

namespace App\Livewire\Client\Vehicles;

use App\Repositories\Admin\Clients\ClientRepository;
use App\Repositories\Client\ClientVehiclesRepository;
use App\Traits\WithModal;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use TallStackUi\Traits\Interactions;

class Card extends Component
{
    use WithModal, Interactions, WithPagination;

    public $filters;
    public $pageSize = 10;

    public $order = [
        'column' => 'name',
        'order' => 'ASC'
    ];

    #[On('filterTableVehicles')]
    public function filterTableVehicles($filterData = null)
    {
        $this->resetPage();
        $this->filters = $filterData;
    }

    #[On('clearFilterVehicles')]
    public function clearFilterVehicles()
    {
        $this->resetPage();
        $this->filters = null;
    }

    #[On('getVehicles')]
    public function getVehicles()
    {
        $vehiclesRepository = new ClientVehiclesRepository();
        return  $vehiclesRepository->index($this->filters, $this->pageSize, $this->order)['data'];
    }

    public function confirmDelete($id = null ): void
    {
        $vehiclesRepository = new ClientVehiclesRepository();
        $clientsReturnDB = $vehiclesRepository->show($id)['data'];

        $this->dialog()
            ->question('Atenção !', 'Deseja Realmente apagar o veículo ' .$clientsReturnDB['name']. '?')
            ->confirm('Apagar', 'delete', $id)
            ->send();
    }

    public function delete($id = null)
    {
        $vehiclesRepository = new ClientVehiclesRepository();
        $clientsReturnDB = $vehiclesRepository->delete($id);

        if($clientsReturnDB['status'] == 'success') {
            $this->toast()->success('Sucesso', $clientsReturnDB['message'])->send();
        } else if ($clientsReturnDB['status'] == 'error') {
            $this->toast()->error('Erro', $clientsReturnDB['message'])->send();
        }
    }

    public function render()
    {
        $response = new \stdClass();
        $response->vehicles = $this->getVehicles();


        return view('livewire.client.vehicles.card', ['response' => $response]);
    }
}
