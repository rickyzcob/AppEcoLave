<?php

namespace App\Livewire\Washer\MyOrders;

use App\Repositories\Order\OrderRepository;
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

    #[On('filterTableOrdersWasher')]
    public function filterTableOrdersWasher($filterData = null)
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
        $ordersRepository = new OrderRepository();
        return  $ordersRepository->index($this->order, $this->filters, $this->pageSize)['data'];
    }

    public function confirmCancel($id = null ): void
    {
        $ordersRepository = new OrderRepository();
        $ordersReturnDB = $ordersRepository->show($id)['data'];

        $this->dialog()
            ->question('Atenção !', 'Deseja Realmente cancelar o pedido do ' .$ordersReturnDB['name']. '?')
            ->confirm('Apagar', 'delete', $id)
            ->send();
    }

    public function changeStatus($id = null, $status = null)
    {
        $ordersRepository = new OrderRepository();
        $ordersReturnDB = $ordersRepository->updateStatus($id, $status);

        if($ordersReturnDB['status'] == 'success') {
            $this->toast()->success('Sucesso', $ordersReturnDB['message'])->send();
        } else if ($ordersReturnDB['status'] == 'error') {
            $this->toast()->error('Erro', $ordersReturnDB['message'])->send();
        }
    }

    public function render()
    {
        $response = new \stdClass();
        $response->orders = $this->getOrdersByWasher();

        return view('livewire.washer.my-orders.table', ['response' => $response]);
    }
}
