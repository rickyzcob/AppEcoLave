<?php

namespace App\Livewire\Admin\Washers;

use App\Repositories\Washer\Washers\WasherRepository;
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

    #[On('filterTableWashers')]
    public function filterTableWashers($filterData = null)
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

    #[On('getWashers')]
    public function getWashers()
    {
        $washerRepository = new WasherRepository();
        return  $washerRepository->index($this->filters, $this->pageSize, $this->order)['data'];
    }

    public function confirmDelete($id = null ): void
    {
        $washerRepository = new WasherRepository();
        $washerReturnDB = $washerRepository->show($id)['data'];

        $this->dialog()
            ->question('Atenção !', 'Deseja Realmente apagar o profissional ' .$washerReturnDB['name']. '?')
            ->confirm('Apagar', 'delete', $id)
            ->send();
    }

    public function delete($id = null)
    {
        $washerRepository = new WasherRepository();
        $washerReturnDB = $washerRepository->delete($id);

        if($washerReturnDB['status'] == 'success') {
            $this->toast()->success('Sucesso', $washerReturnDB['message'])->send();
        } else if ($washerReturnDB['status'] == 'error') {
            $this->toast()->error('Erro', $washerReturnDB['message'])->send();
        }
    }

    public function render()
    {
        $response = new \stdClass();
        $response->washers = $this->getWashers();

        return view('livewire.admin.washers.table', ['response' => $response]);
    }
}
