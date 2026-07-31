<?php

namespace App\Livewire\Admin\Dashboard\Orders;

use App\Repositories\Admin\Dashboard\OrdersRepository;
use Livewire\Component;

class Card extends Component
{
    public function getLastFourOrders()
    {
        $ordersRepository = new OrdersRepository();
        return $ordersRepository->index()['data'];

    }

    public function render()
    {
        $response = new \stdClass();
        $response->orders = $this->getLastFourOrders();

        return view('livewire.admin.dashboard.orders.card', ['response' => $response]);
    }
}
