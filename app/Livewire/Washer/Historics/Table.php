<?php

namespace App\Livewire\Washer\Historics;

use App\Repositories\Washer\Historics\HistoricWasherRepository;
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
        'column' => 'created_at',
        'direction' => 'DESC'
    ];

    #[On('filterTableHistoricWasher')]
    public function filterTableHistoricWasher($filterData = null)
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

    #[On('getOrdersByWasher')]
    public function getOrdersByWasher()
    {
        $historicWasherRepository = new HistoricWasherRepository();
        return  $historicWasherRepository->index($this->order, $this->filters, $this->pageSize)['data'];
    }

    public function render()
    {
        $response = new \stdClass();
        $response->commissions = $this->getOrdersByWasher();

        return view('livewire.washer.historics.table', ['response' => $response]);
    }
}
