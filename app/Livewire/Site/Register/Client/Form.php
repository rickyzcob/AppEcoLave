<?php

namespace App\Livewire\Site\Register\Client;

use App\Repositories\Register\ClientRepository;
use App\Services\Address\AddressService;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $state = [
        'type_vehicle' => ''
    ];

    public $client;
    public $profile_photo_path;
    public $import = false;

    public function mount($id = null, $import = null)
    {
        $clientRepository = new ClientRepository();
        $clientReturnDB = $clientRepository->show($id)['data'];
        $this->client = $clientReturnDB;

        if($import){
            $this->import = true;
        }
        if($this->client){
            $this->state = $this->client->toArray();
        }
    }

    public function getAddress()
    {
        if(isset($this->state['zip_code'])){
            $addressService  = new AddressService();
            $addressServiceReturn = $addressService->consultCEP($this->state['zip_code']);

            if($addressServiceReturn['code'] == 200) {
                $this->toast()->success('Sucesso', 'Endereço localizado com sucesso !')->send();
                $this->state['address'] = $addressServiceReturn['data']['logradouro'];
                $this->state['neighborhood'] = $addressServiceReturn['data']['bairro'];
                $this->state['city'] = $addressServiceReturn['data']['localidade'];
                $this->state['uf'] = $addressServiceReturn['data']['uf'];
                $this->state['country'] = 'Brasil';

            } else if($addressServiceReturn['code'] == 400) {
                $this->toast()->error($addressServiceReturn['title'], $addressServiceReturn['message'])->send();
            }
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
            return redirect()->route('client')->with($clientReturnDB['status'], $clientReturnDB['message']);
        } else if ($clientReturnDB['status'] == 'error') {
            return back()->with($clientReturnDB['status'], $clientReturnDB['message']);
        }
    }

    public function update()
    {
        $request = $this->state;

        $clientRepository = new ClientRepository();
        $clientReturnDB = $clientRepository->update($this->client->id, $request);

        if($clientReturnDB['status'] == 'success') {
            $this->toast()->success('Sucesso', $clientReturnDB['message'])->send();
            $this->closeSlide();
            $this->dispatch('getClients');
        } else if ($clientReturnDB['status'] == 'error') {
            $this->toast()->error('Erro', $clientReturnDB['message'])->send();
            $this->closeSlide();
        }
    }
    public function render()
    {
        return view('livewire.site.register.client.form');
    }
}
