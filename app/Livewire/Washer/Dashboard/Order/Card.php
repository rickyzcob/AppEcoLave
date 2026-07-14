<?php

namespace App\Livewire\Washer\Dashboard\Order;

use App\Models\Orders;
use App\Repositories\Order\OrderRepository;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Card extends Component
{
    use Interactions;

    public $order;

    public function mount()
    {
        $this->order = Orders::query()->with(['service.type', 'user'])->where('status_washer', 'waiting')->orderByDesc('created_at')->first();

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
        return view('livewire.washer.dashboard.order.card');
    }
}
