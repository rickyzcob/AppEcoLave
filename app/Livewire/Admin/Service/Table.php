<?php

namespace App\Livewire\Admin\Service;

use App\Repositories\Admin\Services\TypeVehiclesRepository;
use App\Traits\WithModal;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use TallStackUi\Traits\Interactions;

class Table extends Component
{
    use WithModal, Interactions, WithPagination;

    public $filters;
    public $pageSize = 10;

    public $order = [
        'column' => 'name',
        'order' => 'ASC'
    ];

    #[On('filterTableServices')]
    public function filterTableServices($filterData = null)
    {
        $this->resetPage();
        $this->filters = $filterData;
    }
    #[On('clearFilter')]
    public function clearFilter($visible = null)
    {
        $this->resetPage();
        $this->filters = null;
    }

    #[On('getTypeServices')]
    public function getServices()
    {
        $typeVehicleRepository = new TypeVehiclesRepository();
        return  $typeVehicleRepository->index($this->filters, $this->pageSize, $this->order)['data'];
    }

    public function confirmDelete($id = null ): void
    {
        $typeVehicleRepository = new TypeVehiclesRepository();
        $typeVehicleReturnDB = $typeVehicleRepository->show($id)['data'];

        $this->dialog()
            ->question('Atenção !', 'Deseja Realmente apagar o tipo ' .$typeVehicleReturnDB['name']. '?')
            ->confirm('Apagar', 'delete', $id)
            ->send();
    }

    public function delete($id = null)
    {
        $typeVehicleRepository = new TypeVehiclesRepository();
        $typeVehicleReturnDB = $typeVehicleRepository->delete($id);

        if($typeVehicleReturnDB['status'] == 'success') {
            $this->toast()->success('Sucesso', $typeVehicleReturnDB['message'])->send();
        } else if ($typeVehicleReturnDB['status'] == 'error') {
            $this->toast()->error('Erro', $typeVehicleReturnDB['message'])->send();
        }
    }

    public function render()
    {
        $response = new \stdClass();
        $response->services = $this->getServices();

        return view('livewire.admin.service.table', ['response' => $response]);
    }
}
