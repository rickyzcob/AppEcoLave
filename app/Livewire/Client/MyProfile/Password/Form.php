<?php

namespace App\Livewire\Client\MyProfile\Password;

use App\Repositories\Client\ProfileRepository;
use App\Traits\WithModal;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Form extends Component
{
    use Interactions, WithModal;

    public $state = [];

    public function save()
    {
        $request = $this->state;

        $passwordRepository = new ProfileRepository();
        $passwordReturnDB = $passwordRepository->updatePassword($request);

        if($passwordReturnDB['status'] === 'success') {
            $this->toast()->success('Sucesso', $passwordReturnDB['message'])->send();
            $this->closeCentralModal();
        } else if ($passwordReturnDB['status'] === 'error') {
            $this->toast()->error('Erro', $passwordReturnDB['message'])->send();
        }
    }

    public function render()
    {
        return view('livewire.client.my-profile.password.form');
    }
}
