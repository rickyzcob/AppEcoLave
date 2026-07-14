<?php

namespace App\Livewire\Admin\MyProfile;

use App\Repositories\Admin\Profile\ProfileRepository;
use App\Repositories\Washer\Washers\WasherRepository;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Form extends Component
{
    use Interactions;

    public $state = [];
    public $user;

    public function mount($id = null)
    {
        $profileRepository = new ProfileRepository();
        $profileReturnDB = $profileRepository->show(Auth::id())['data'];
        $this->user = $profileReturnDB;

        if($this->user){
            $this->state = $this->user->toArray();
        }
    }


    public function update()
    {
        $request = $this->state;

        $profileRepository = new ProfileRepository();
        $profileReturnDB = $profileRepository->update($this->user->id, $request);

        if($profileReturnDB['status'] === 'success') {
            $this->toast()->success('Sucesso', $profileReturnDB['message'])->send();
            $this->dispatch('getServices');
        } else if ($profileReturnDB['status'] === 'error') {
            $this->toast()->error('Erro', $profileReturnDB['message'])->send();
        }
    }

    public function render()
    {
        return view('livewire.admin.my-profile.form');
    }
}
