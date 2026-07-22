<?php

namespace App\Livewire\Washer\Dashboard\Order;

use App\Models\Orders;
use App\Repositories\Site\Order\OrderRepository;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Card extends Component
{
    use Interactions;

    public $order;

    public function mount()
    {
        $this->order = Orders::query()
            ->with(['service.type', 'user'])
            ->withoutGlobalScope('scope')
            ->where('status_washer', 'waiting')
            ->orderByDesc('created_at')->first();
    }

    public function changeStatus($id = null, $status = null)
    {
        $ordersRepository = new OrderRepository();
        $ordersReturnDB = $ordersRepository->updateStatus($id, Auth::id(), $status );

        if($ordersReturnDB['status'] == 'success') {
            $this->toast()->success('Sucesso', $ordersReturnDB['message'])->send();
        } else if ($ordersReturnDB['status'] == 'error') {
            $this->toast()->error('Erro', $ordersReturnDB['message'])->send();
        }
    }

    public function getLastNewOrder()
    {
        $lastNewOrder = Orders::query()
            ->with(['service.type', 'user'])
            ->withoutGlobalScope('scope')
            ->where('status_washer', 'waiting')
            ->orderByDesc('created_at')->first();

        return $lastNewOrder;
    }

    public function render()
    {
        $response = new \stdClass();
        $response->newOrder = $this->getLastNewOrder();

        return view('livewire.washer.dashboard.order.card', ['response' => $response]);
    }
}
