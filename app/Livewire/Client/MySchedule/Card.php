<?php

namespace App\Livewire\Client\MySchedule;

use App\Repositories\Client\MySchedulesRepository;
use App\Repositories\Site\Order\OrderRepository;
use App\Traits\WithModal;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use TallStackUi\Traits\Interactions;

class Card extends Component
{
    use WithoutUrlPagination, Interactions, WithModal;

    public $direction = [
        'column' => 'created_at',
        'direction' => 'desc'
    ];

    public $pageSize = 5;

    #[On('getOrderByClient')]
    public function getOrderByClient()
    {
        $myScheduleRepository = new MySchedulesRepository();
        return $myScheduleRepository->index($this->direction, $this->pageSize)['data'];
    }

    public function confirmDelete($id = null ): void
    {
        $myScheduleRepository = new OrderRepository();
        $orderReturnDB = $myScheduleRepository->show($id)['data'];

        $this->dialog()
            ->question('Atenção !', 'Deseja Realmente apagar o pedido do veículo ' .$orderReturnDB['vehicle']. '?')
            ->confirm('Apagar', 'delete', $id)
            ->send();
    }

    public function delete($id = null)
    {
        $myScheduleRepository = new OrderRepository();
        $orderReturnDB = $myScheduleRepository->delete($id);

        if($orderReturnDB['status'] == 'success') {
            $this->toast()->success('Sucesso', $orderReturnDB['message'])->send();
        } else if ($orderReturnDB['status'] == 'error') {
            $this->toast()->error('Erro', $orderReturnDB['message'])->send();
        }
    }

    public function render()
    {
        $response = new \stdClass();
        $response->schedules = $this->getOrderByClient();

        return view('livewire.client.my-schedule.card', ['response' => $response]);
    }
}
