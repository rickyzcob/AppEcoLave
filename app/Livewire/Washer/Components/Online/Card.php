<?php

namespace App\Livewire\Washer\Components\Online;

use App\Repositories\Admin\Users\UsersRepository;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Card extends Component
{
    use Interactions;

    public function changeStatus($id = null, $status = null)
    {
        $userRepository = new UsersRepository();
        $userReturnDB = $userRepository->updateStatus($id, $status);

        if($userReturnDB['status'] == 'success') {
            $this->dispatch('getStatusUser');
            $this->toast()->success('Sucesso', $userReturnDB['message'])->send();
        } else if ($userReturnDB['status'] == 'error') {
            $this->toast()->error('Erro', $userReturnDB['message'])->send();
        }
    }

    public function getUser()
    {
        $userRepository = new UsersRepository();
        return $userRepository->show(Auth::id())['data'];
    }

    public function render()
    {
        $response = new \stdClass();
        $response->user = $this->getUser();

        return view('livewire.washer.components.online.card', ['response' => $response]);
    }
}
