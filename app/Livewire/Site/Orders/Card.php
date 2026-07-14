<?php

namespace App\Livewire\Site\Orders;

use App\Repositories\Order\OrderRepository;
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
        $orderRepository = new OrderRepository();
        return $orderRepository->index($this->direction, $this->pageSize)['data'];
    }

    public function confirmDelete($id = null ): void
    {
        $orderRepository = new OrderRepository();
        $orderReturnDB = $orderRepository->show($id)['data'];

        $this->dialog()
            ->question('Atenção !', 'Deseja Realmente apagar o pedido do veículo ' .$orderReturnDB['vehicle']. '?')
            ->confirm('Apagar', 'delete', $id)
            ->send();
    }

    public function delete($id = null)
    {
        $orderRepository = new OrderRepository();
        $orderReturnDB = $orderRepository->delete($id);

        if($orderReturnDB['status'] == 'success') {
            $this->toast()->success('Sucesso', $orderReturnDB['message'])->send();
        } else if ($orderReturnDB['status'] == 'error') {
            $this->toast()->error('Erro', $orderReturnDB['message'])->send();
        }
    }

    public function render()
    {
        $response = new \stdClass();
        $response->orders = $this->getOrderByClient();

        return view('livewire.site.orders.card', ['response' => $response]);
    }
}
