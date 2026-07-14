<?php

namespace App\Livewire\Washer\Components\Online;

use App\Repositories\Admin\Users\UsersRepository;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Badge extends Component
{
    #[On('getStatusUser')]
    public function getUser()
    {
        $userRepository = new UsersRepository();
        return $userRepository->show(Auth::id())['data'];
    }

    public function render()
    {
        $response = new \stdClass();
        $response->user = $this->getUser();

        return view('livewire.washer.components.online.badge', ['response' => $response]);
    }
}
