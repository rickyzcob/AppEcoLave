<?php

namespace App\Livewire\Admin\Withdrawal\Pay;

use App\Repositories\Admin\Withdrawal\WithdrawalRepository;
use App\Traits\WithModal;
use Livewire\Component;
use Livewire\WithFileUploads;
use TallStackUi\Traits\Interactions;

class Form extends Component
{
    use WithModal, Interactions, WithFileUploads;

    public array $state = [
        'status' => '',
    ];

    public $withdrawal;
    public $file_path;

    public function mount($id = null)
    {
        $withdrawalRepository = new WithdrawalRepository();
        $withdrawalReturnDB = $withdrawalRepository->show($id)['data'];
        $this->withdrawal = $withdrawalReturnDB;

        if($this->withdrawal){
            $this->state = $this->withdrawal->toArray();
        }
    }


    public function update()
    {
        $request = $this->state;

        $fileValidated = $this->validate([
            'file_path' => 'required|max:4896',
        ]);

        $withdrawalRepository = new WithdrawalRepository();
        $withdrawalReturnDB = $withdrawalRepository->updateStatus($this->withdrawal->id, $request, $fileValidated['file_path']);

        if($withdrawalReturnDB['status'] == 'success') {
            $this->toast()->success('Sucesso', $withdrawalReturnDB['message'])->send();
            $this->closeCentralModal();
            $this->dispatch('WithdrawalRepository');
        } else if ($withdrawalReturnDB['status'] == 'error') {
            $this->toast()->error('Erro', $withdrawalReturnDB['message'])->send();
            $this->closeCentralModal();
        }
    }

    public function render()
    {
        return view('livewire.admin.withdrawal.pay.form');
    }
}
