<?php

namespace App\Livewire\Admin\Washers;

use App\Repositories\Admin\Committees\CommitteesRepository;
use App\Repositories\Washer\Washers\WasherRepository;
use App\Services\Address\AddressService;
use App\Traits\WithModal;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Form extends Component
{
    use WithModal, Interactions;

    public array $state = [
        'status' => '',
        'phone' => '',
        'committee_id' => '',
    ];

    public $washer;

    public function mount($id = null)
    {
        $washerRepository = new WasherRepository();
        $washerReturnDB = $washerRepository->show($id)['data'];
        $this->washer = $washerReturnDB;

        if($this->washer){
            $this->state = $this->washer->toArray();
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
        if($this->washer){
            return $this->update();
        }

        $request = $this->state;

        $washerRepository = new WasherRepository();
        $washerReturnDB = $washerRepository->create($request);

        if($washerReturnDB['status'] === 'success') {
            $this->toast()->success('Sucesso', $washerReturnDB['message'])->send();
            $this->closeCentralModal();
            $this->dispatch('getWashers');
        } else if ($washerReturnDB['status'] === 'error') {
            $this->toast()->error('Erro', $washerReturnDB['message'])->send();
            $this->closeCentralModal();
        }
    }

    public function update()
    {
        $request = $this->state;

        $washerRepository = new WasherRepository();
        $washerReturnDB = $washerRepository->update($this->washer->id, $request);

        if($washerReturnDB['status'] === 'success') {
            $this->toast()->success('Sucesso', $washerReturnDB['message'])->send();
            $this->closeCentralModal();
            $this->dispatch('getWashers');
        } else if ($washerReturnDB['status'] === 'error') {
            $this->toast()->error('Erro', $washerReturnDB['message'])->send();
            $this->closeCentralModal();
        }
    }

    public function getSelectCommittees()
    {
        $committesRepository = new CommitteesRepository();
        return $committesRepository->getSelectCommittees();

    }

    public function render()
    {
        $response = new \stdClass();
        $response->committees = $this->getSelectCommittees();

        return view('livewire.admin.washers.form', ['response' => $response]);
    }
}
