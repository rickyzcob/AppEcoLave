<?php

namespace App\Livewire\Admin\Orders\Manager\Washer;

use App\Repositories\Admin\Orders\OrderRepository;
use App\Repositories\Washer\Washers\WasherRepository;
use App\Traits\WithModal;
use Livewire\Attributes\Validate;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Form extends Component
{
    use Interactions, WithModal;

    #[Validate('required')]
    public $washer_id = '';

    public $order;

    public function mount($id = null)
    {
        $orderRepository = new OrderRepository();
        $this->order = $orderRepository->show($id)['data'];
        $this->washer_id = $this->order->washer_id;
    }

    public function getSelectWashers()
    {
        $washersRepository = new WasherRepository();
        return $washersRepository->getSelectWasher();
    }

    public function save()
    {
        $this->validate([
            'washer_id' => 'required',
        ]);

        $ordersRepository = new OrderRepository();
        $ordersReturnDB = $ordersRepository->updateProfessional($this->order->id, $this->washer_id);

        if($ordersReturnDB['status'] == 'success') {
            $this->toast()->success('Sucesso', $ordersReturnDB['message'])->send();
            $this->closeCentralModal();
            $this->dispatch('getOrders');
        } else if ($ordersReturnDB['status'] == 'error') {
            $this->toast()->error('Erro', $ordersReturnDB['message'])->send();
            $this->closeCentralModal();
        }
    }

    public function render()
    {
        $response = new \stdClass();
        $response->washers = $this->getSelectWashers();

        return view('livewire.admin.orders.manager.washer.form', ['response' => $response]);
    }
}
