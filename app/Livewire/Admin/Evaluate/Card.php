<?php

namespace App\Livewire\Admin\Evaluate;

use App\Repositories\Admin\Orders\OrderRepository;
use App\Repositories\Evaluate\EvaluateRepository;
use Livewire\Component;

class Card extends Component
{
    public function getEvaluatesByProfessional()
    {
        $orderRepository = new EvaluateRepository();
        return $orderRepository->index()['data'];
    }

    public function render()
    {
        $response = new \stdClass();
        $response->evaluates = $this->getEvaluatesByProfessional();

        return view('livewire.admin.evaluate.card', ['response' => $response]);
    }
}
