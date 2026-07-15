<?php

namespace App\Livewire\Washer\NewOrders;

use App\Repositories\Order\NewOrdersRepository;
use App\Repositories\Order\OrderRepository;
use App\Traits\WithModal;
use Illuminate\Support\Facades\Auth;
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

    #[On('filterTableNewOrdersWasher')]
    public function filterTableNewOrdersWasher($filterData = null)
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

    #[On('getNewOrders')]
    public function getNewOrders()
    {
        $ordersRepository = new NewOrdersRepository();
        return  $ordersRepository->index($this->order, $this->filters, $this->pageSize)['data'];
    }

    public function changeStatus($id = null, $status = null)
    {
        $ordersRepository = new NewOrdersRepository();
        $ordersReturnDB = $ordersRepository->updateStatus($id, $status, Auth::id());

        if($ordersReturnDB['status'] == 'success') {
            $this->toast()->success('Sucesso', $ordersReturnDB['message'])->send();
        } else if ($ordersReturnDB['status'] == 'error') {
            $this->toast()->error('Erro', $ordersReturnDB['message'])->send();
        }
    }

    public function render()
    {
        $response = new \stdClass();
        $response->orders = $this->getNewOrders();

        return view('livewire.washer.new-orders.table', ['response' => $response]);
    }
}
