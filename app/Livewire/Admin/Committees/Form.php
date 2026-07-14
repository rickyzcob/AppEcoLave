<?php

namespace App\Livewire\Admin\Committees;

use App\Repositories\Admin\Committees\CommitteesRepository;
use App\Traits\WithModal;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Form extends Component
{
    use WithModal, Interactions;

    public array $state = [
        'value' => '',
    ];

    public $committee;

    public function mount($id = null)
    {
        $CommitteesRepository = new CommitteesRepository();
        $CommitteesReturnDB = $CommitteesRepository->show($id)['data'];
        $this->committee = $CommitteesReturnDB;

        if($this->committee){
            $this->state = $this->committee->toArray();
        }
    }

    public function save()
    {
        if($this->committee){
            return $this->update();
        }

        $request = $this->state;

        $CommitteesRepository = new CommitteesRepository();
        $CommitteesReturnDB = $CommitteesRepository->create($request);

        if($CommitteesReturnDB['status'] == 'success') {
            $this->toast()->success('Sucesso', $CommitteesReturnDB['message'])->send();
            $this->closeCentralModal();
            $this->dispatch('getCommittees');

        } else if ($CommitteesReturnDB['status'] == 'error') {
            $this->toast()->error('Erro', $CommitteesReturnDB['message'])->send();
            $this->closeCentralModal();
        }
    }

    public function update()
    {
        $request = $this->state;

        $CommitteesRepository = new CommitteesRepository();
        $CommitteesReturnDB = $CommitteesRepository->update($this->client->id, $request);

        if($CommitteesReturnDB['status'] == 'success') {
            $this->toast()->success('Sucesso', $CommitteesReturnDB['message'])->send();
            $this->closeCentralModal();
            $this->dispatch('getCommittees');
        } else if ($CommitteesReturnDB['status'] == 'error') {
            $this->toast()->error('Erro', $CommitteesReturnDB['message'])->send();
            $this->closeCentralModal();
        }
    }

    public function render()
    {
        return view('livewire.admin.committees.form');
    }
}
