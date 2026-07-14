<?php

namespace App\Livewire\Admin\Clients;

use App\Repositories\Admin\Clients\ClientRepository;
use App\Traits\WithModal;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Form extends Component
{
    use WithModal, Interactions;

    public array $state = [
        'status' => '',
    ];

    public $client;

    public function mount($id = null)
    {
        $clientRepository = new ClientRepository();
        $clientReturnDB = $clientRepository->show($id)['data'];
        $this->client = $clientReturnDB;

        if($this->client){
            $this->state = $this->client->toArray();
        }
    }

    public function save()
    {
        if($this->client){
            return $this->update();
        }

        $request = $this->state;

        $clientRepository = new ClientRepository();
        $clientReturnDB = $clientRepository->create($request);

        if($clientReturnDB['status'] == 'success') {
            $this->toast()->success('Sucesso', $clientReturnDB['message'])->send();
            $this->closeCentralModal();
            $this->dispatch('getClients');

        } else if ($clientReturnDB['status'] == 'error') {
            $this->toast()->error('Erro', $clientReturnDB['message'])->send();
            $this->closeCentralModal();
        }
    }

    public function update()
    {
        $request = $this->state;

        $clientRepository = new ClientRepository();
        $clientReturnDB = $clientRepository->update($this->client->id, $request);

        if($clientReturnDB['status'] == 'success') {
            $this->toast()->success('Sucesso', $clientReturnDB['message'])->send();
            $this->closeCentralModal();
            $this->dispatch('getClients');
        } else if ($clientReturnDB['status'] == 'error') {
            $this->toast()->error('Erro', $clientReturnDB['message'])->send();
            $this->closeCentralModal();
        }
    }


    public function render()
    {
        return view('livewire.admin.clients.form');
    }
}
