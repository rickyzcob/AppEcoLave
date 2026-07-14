<?php

namespace App\Livewire\Admin\Users;

use App\Repositories\Admin\Clients\ClientRepository;
use App\Repositories\Admin\Users\UsersRepository;
use App\Traits\WithModal;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Form extends Component
{
    use WithModal, Interactions;

    public array $state = [
        'status' => '',
    ];

    public $user;

    public function mount($id = null)
    {
        $usersRepository = new UsersRepository();
        $usersReturnDB = $usersRepository->show($id)['data'];
        $this->user = $usersReturnDB;

        if($this->user){
            $this->state = $this->user->toArray();
        }
    }

    public function save()
    {
        if($this->user){
            return $this->update();
        }

        $request = $this->state;

        $usersRepository = new UsersRepository();
        $usersReturnDB = $usersRepository->create($request);

        if($usersReturnDB['status'] == 'success') {
            $this->toast()->success('Sucesso', $usersReturnDB['message'])->send();
            $this->closeCentralModal();
            $this->dispatch('getUsers');

        } else if ($usersReturnDB['status'] == 'error') {
            $this->toast()->error('Erro', $usersReturnDB['message'])->send();
            $this->closeCentralModal();
        }
    }

    public function update()
    {
        $request = $this->state;

        $usersRepository = new UsersRepository();
        $usersReturnDB = $usersRepository->update($this->user->id, $request);

        if($usersReturnDB['status'] == 'success') {
            $this->toast()->success('Sucesso', $usersReturnDB['message'])->send();
            $this->closeCentralModal();
            $this->dispatch('getUsers');
        } else if ($usersReturnDB['status'] == 'error') {
            $this->toast()->error('Erro', $usersReturnDB['message'])->send();
            $this->closeCentralModal();
        }
    }

    public function render()
    {
        return view('livewire.admin.users.form');
    }
}
