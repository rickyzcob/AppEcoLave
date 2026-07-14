<?php

namespace App\Livewire\Washer\Orders\Status;

use App\Repositories\Admin\Orders\OrderRepository;
use App\Traits\WithModal;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Card extends Component
{
    use Interactions, WithModal;

    public $order;

    public function mount($id = null)
    {
        $orderRepository = new OrderRepository();
        $this->order = $orderRepository->show($id)['data'];
    }

    public function updateStatus($status = null)
    {
        $orderRepository = new OrderRepository();
        $userReturnDB = $orderRepository->updateStatus($this->order->id, $status);

        if($userReturnDB['status'] == 'success') {
            $this->closeCentralModal();
            $this->dispatch('getOrdersByWasher');
            $this->toast()->success('Sucesso', $userReturnDB['message'])->send();
        } else if ($userReturnDB['status'] == 'error') {
            $this->closeCentralModal();
            $this->toast()->error('Erro', $userReturnDB['message'])->send();
        }
    }

    public function render()
    {
        return view('livewire.washer.orders.status.card');
    }
}
