<?php

namespace App\Livewire\Admin\Service\Prices;

use App\Repositories\Admin\Services\ServiceRepository;
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
    public $type_id;

    public function mount($id)
    {
        $this->type_id = $id;
    }

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

    #[On('getPrices')]
    public function getPrices()
    {
        $servicesRepository = new ServiceRepository();
        return  $servicesRepository->index($this->type_id, $this->filters, $this->pageSize, $this->order)['data'];
    }

    public function confirmDelete($id = null ): void
    {
        $servicesRepository = new ServiceRepository();
        $typeVehicleReturnDB = $servicesRepository->show($id)['data'];

        $this->dialog()
            ->question('Atenção !', 'Deseja Realmente apagar o tipo ' .$typeVehicleReturnDB['name']. '?')
            ->confirm('Apagar', 'delete', $id)
            ->send();
    }

    public function delete($id = null)
    {
        $servicesRepository = new ServiceRepository();
        $typeVehicleReturnDB = $servicesRepository->delete($id);

        if($typeVehicleReturnDB['status'] == 'success') {
            $this->toast()->success('Sucesso', $typeVehicleReturnDB['message'])->send();
        } else if ($typeVehicleReturnDB['status'] == 'error') {
            $this->toast()->error('Erro', $typeVehicleReturnDB['message'])->send();
        }
    }

    public function render()
    {
        $response = new \stdClass();
        $response->prices = $this->getPrices();

        return view('livewire.admin.service.prices.table', ['response' => $response]);
    }
}
