<?php

namespace App\Livewire\Client\Evaluate\NewEvaluate;

use App\Repositories\Client\EvaluateRepository;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Form extends Component
{
    use Interactions;

    public $state = [
        'rate' => 0
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
        $newScheduleReturnDB = $newScheduleRepository->evaluate($this->getLastScheduleForAvaliation()['id'], $request, $this->quantity);

        if($newScheduleReturnDB['status'] == 'success') {
            $this->toast()->success('Sucesso', $newScheduleReturnDB['message'])->send();
            $this->reset('state');
        } else if ($newScheduleReturnDB['status'] == 'error') {
            $this->toast()->error('Erro', $newScheduleReturnDB['message'])->send();
        }
    }

    public function getLastScheduleForAvaliation()
    {
        $evaluateRepository = new EvaluateRepository();
        return $evaluateRepository->index(Auth::id())['data'];
    }


    public function render()
    {
        $response = new \stdClass();
        $response->evaluate = $this->getLastScheduleForAvaliation();

        return view('livewire.client.evaluate.new-evaluate.form', ['response' => $response]);
    }
}
