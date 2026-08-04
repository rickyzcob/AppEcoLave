<?php

namespace App\Livewire\Client\MyProfile;

use App\Repositories\Client\ProfileRepository;
use App\Services\Address\AddressService;
use App\Traits\WithModal;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use TallStackUi\Traits\Interactions;

class Form extends Component
{
    use Interactions, WithFileUploads, WithModal;

    public $state = [];
    public $user;
    public $profile_photo_path;

    public function mount()
    {
        $profileRepository = new ProfileRepository();
        $profileReturnDB = $profileRepository->show(Auth::id())['data'];
        $this->user = $profileReturnDB;

        if($this->user){
            $this->state = $this->user->toArray();
        }
    }

    public function updateProfilePhotoPath()
    {
        $this->validate([
            'profile_photo_path' => 'image|max:1024',
        ]);
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
            } else if($addressServiceReturn['code'] == 400) {
                $this->toast()->error($addressServiceReturn['title'], $addressServiceReturn['message'])->send();
            }
        }
    }


    public function save()
    {
        $request = $this->state;

        $profileRepository = new ProfileRepository();
        $profileReturnDB = $profileRepository->update($this->user->id, $request, $this->profile_photo_path);

        if($profileReturnDB['status'] === 'success') {
            $this->toast()->success('Sucesso', $profileReturnDB['message'])->send();
            $this->dispatch('getServices');
        } else if ($profileReturnDB['status'] === 'error') {
            $this->toast()->error('Erro', $profileReturnDB['message'])->send();
        }
    }

    public function getClient()
    {
        $profileRepository = new ProfileRepository();
        return $profileRepository->show(Auth::id())['data'];
    }

    public function render()
    {
        $response = new \stdClass();
        $response->profile = $this->getClient();

        return view('livewire.client.my-profile.form', ['response' => $response]);
    }
}
