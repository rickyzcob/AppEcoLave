<?php

namespace App\Livewire\Washer\Financial\Withdrawal;

use App\Repositories\Washer\Financial\WithDrawalRepository;
use App\Traits\WithModal;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Form extends Component
{
    use WithModal, Interactions;

    public array $state = [
        'amount' => '',
    ];

    public $withdrawal;

    public function mount($id = null)
    {
        $withDrawalRepository = new WithDrawalRepository();
        $withDrawalReturnDB = $withDrawalRepository->show($id)['data'];
        $this->withdrawal = $withDrawalReturnDB;

        if($this->withdrawal){
            $this->state = $this->withdrawal->toArray();
        } else {
            $this->state['key_pix'] = auth()->user()->key_pix;
        }


    }

    public function save()
    {
        if($this->withdrawal){
            return $this->update();
        }

        $request = $this->state;

        $withDrawalRepository = new WithDrawalRepository();
        $withDrawalReturnDB = $withDrawalRepository->create($request);

        if($withDrawalReturnDB['status'] == 'success') {
            $this->toast()->success('Sucesso', $withDrawalReturnDB['message'])->send();
            $this->closeCentralModal();
            $this->dispatch('getWithDrawals');
            $this->dispatch('getBalanceByMonth');
            $this->dispatch('getWithDrawalsByMonth');
        } else if ($withDrawalReturnDB['status'] == 'error') {
            $this->toast()->error('Erro', $withDrawalReturnDB['message'])->send();
            $this->closeCentralModal();
        } else if ($withDrawalReturnDB['status'] == 'error_balance') {
            $this->dialog()->error('Erro', $withDrawalReturnDB['message'])->send();
            $this->closeCentralModal();
        }
    }

    public function update()
    {
        $request = $this->state;

        $withDrawalRepository = new WithDrawalRepository();
        $withDrawalReturnDB = $withDrawalRepository->update($this->withdrawal->id, $request);

        if($withDrawalReturnDB['status'] == 'success') {
            $this->toast()->success('Sucesso', $withDrawalReturnDB['message'])->send();
            $this->closeCentralModal();
            $this->dispatch('getWithDrawals');
        } else if ($withDrawalReturnDB['status'] == 'error') {
            $this->toast()->error('Erro', $withDrawalReturnDB['message'])->send();
            $this->closeCentralModal();
        }
    }

    public function render()
    {
        return view('livewire.washer.financial.withdrawal.form');
    }
}
