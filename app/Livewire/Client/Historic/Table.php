<?php

namespace App\Livewire\Client\Historic;

use App\Repositories\Client\HistoricRepository;
use App\Repositories\Client\MySchedulesRepository;
use App\Repositories\Order\OrderRepository;
use App\Traits\WithModal;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use TallStackUi\Traits\Interactions;

class Table extends Component
{
    use WithoutUrlPagination, Interactions, WithModal;

    public $direction = [
        'column' => 'created_at',
        'direction' => 'desc'
    ];

    public $pageSize = 5;

    #[On('getHistoricsByClient')]
    public function getHistoricsByClient()
    {
        $historicRepository = new HistoricRepository();
        return $historicRepository->index($this->direction, $this->pageSize)['data'];
    }

    public function render()
    {
        $response = new \stdClass();
        $response->historics = $this->getHistoricsByClient();

        return view('livewire.client.historic.table', ['response' => $response]);
    }
}
