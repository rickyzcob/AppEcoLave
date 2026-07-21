<?php

namespace App\Livewire\Washer\EvaluateClient;

use App\Repositories\Washer\Evaluate\EvaluateRepository;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Card extends Component
{
    use Interactions;

    public $state = [
        'rate' => 0,
        'client_id' => '',

    ];
    public $quantity;

    public function evaluate(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function save()
    {
        $request = $this->state;

        $newScheduleRepository = new EvaluateRepository();
        $newScheduleReturnDB = $newScheduleRepository->evaluate($request, $this->quantity);

        if($newScheduleReturnDB['status'] == 'success') {
            $this->toast()->success('Sucesso', $newScheduleReturnDB['message'])->send();
            $this->reset('state');
        } else if ($newScheduleReturnDB['status'] == 'error') {
            $this->toast()->error('Erro', $newScheduleReturnDB['message'])->send();
        }
    }

    public function getSelectClients()
    {
        $newScheduleRepository = new EvaluateRepository();
        return $newScheduleRepository->getSelectClientByWasher();
    }

    public function render()
    {
        $response = new \stdClass();
        $response->clients = $this->getSelectClients();

        return view('livewire.washer.evaluate-client.card', ['response' => $response]);
    }
}
