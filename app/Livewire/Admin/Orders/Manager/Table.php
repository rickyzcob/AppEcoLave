<?php

namespace App\Livewire\Admin\Orders\Manager;

use App\Repositories\Admin\Orders\OrderRepository;
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
        'direction' => 'desc'
    ];

    #[On('filterTableOrders')]
    public function filterTableKeywords($filterData = null)
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

    #[On('getOrders')]
    public function getOrders()
    {
        $ordersRepository = new OrderRepository();
        return  $ordersRepository->index($this->order, $this->pageSize, $this->filters)['data'];
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

    public function delete($id = null)
    {
        $ordersRepository = new OrderRepository();
        $ordersReturnDB = $ordersRepository->updateStatus($id, 'canceled');

        if($ordersReturnDB['status'] == 'success') {
            $this->toast()->success('Sucesso', $ordersReturnDB['message'])->send();
        } else if ($ordersReturnDB['status'] == 'error') {
            $this->toast()->error('Erro', $ordersReturnDB['message'])->send();
        }
    }

    public function confirmFinish($id = null ): void
    {
        $ordersRepository = new OrderRepository();
        $ordersReturnDB = $ordersRepository->show($id)['data'];

        $this->dialog()
            ->question('Atenção !', 'Deseja finalizar o pedido e gerar as comissões ? ')
            ->confirm('Encerrar', 'finish', $id)
            ->send();
    }

    public function finish($id = null)
    {
        $ordersRepository = new OrderRepository();
        $ordersReturnDB = $ordersRepository->updateFinish($id, 'finish');

        if($ordersReturnDB['status'] == 'success') {
            $this->toast()->success('Sucesso', $ordersReturnDB['message'])->send();
        } else if ($ordersReturnDB['status'] == 'error') {
            $this->toast()->error('Erro', $ordersReturnDB['message'])->send();
        }
    }

    public function render()
    {
        $response = new \stdClass();
        $response->orders = $this->getOrders();

        return view('livewire.admin.orders.manager.table', ['response' => $response]);
    }
}
