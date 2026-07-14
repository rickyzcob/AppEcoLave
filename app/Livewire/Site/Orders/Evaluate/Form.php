<?php

namespace App\Livewire\Site\Orders\Evaluate;

use App\Repositories\Admin\Orders\OrderRepository;
use App\Traits\WithModal;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Form extends Component
{
    use Interactions, WithModal;

    public $state = [
        'rate' => 0
    ];

    public $order;
    public $quantity;

    public function mount($id = null)
    {
        $orderRepository = new OrderRepository();
        $this->order = $orderRepository->show($id)['data'];
    }

    public function evaluate(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function save()
    {
        $request = $this->state;

        $clientRepository = new OrderRepository();
        $clientReturnDB = $clientRepository->evaluate( $this->order->id, $request, $this->quantity);

        if($clientReturnDB['status'] == 'success') {
            $this->closeCentralModal();
            $this->dispatch('getOrderByClient');
        } else if ($clientReturnDB['status'] == 'error') {
            return back()->with($clientReturnDB['status'], $clientReturnDB['message']);
        }
    }

    public function render()
    {
        return view('livewire.site.orders.evaluate.form');
    }
}
