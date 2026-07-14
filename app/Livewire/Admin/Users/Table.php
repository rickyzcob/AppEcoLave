<?php

namespace App\Livewire\Admin\Users;

use App\Repositories\Admin\Users\UsersRepository;
use App\Traits\WithModal;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use TallStackUi\Traits\Interactions;

class Table extends Component
{
    use WithModal, Interactions, WithPagination;

    public $filters;
    public $pageSize = 10;

    public $order = [
        'column' => 'name',
        'order' => 'ASC'
    ];

    #[On('filterTableUsers')]
    public function filterTableKeywords($filterData = null)
    {
        $this->resetPage();
        $this->filters = $filterData;
    }
    #[On('clearFilter')]
    public function clearFilter($visible = null)
    {
        $this->resetPage();
        $this->filters = null;
    }

    #[On('getUsers')]
    public function getUsers()
    {
        $usersRepository = new UsersRepository();
        return  $usersRepository->index($this->filters, $this->pageSize, $this->order)['data'];
    }

    public function confirmDelete($id = null ): void
    {
        $usersRepository = new UsersRepository();
        $usersReturnDB = $usersRepository->show($id)['data'];

        $this->dialog()
            ->question('Atenção !', 'Deseja Realmente apagar o usuário ' .$usersReturnDB['name']. '?')
            ->confirm('Apagar', 'delete', $id)
            ->send();
    }

    public function delete($id = null)
    {
        $usersRepository = new UsersRepository();
        $usersReturnDB = $usersRepository->delete($id);

        if($usersReturnDB['status'] == 'success') {
            $this->toast()->success('Sucesso', $usersReturnDB['message'])->send();
        } else if ($usersReturnDB['status'] == 'error') {
            $this->toast()->error('Erro', $usersReturnDB['message'])->send();
        }
    }

    public function render()
    {
        $response = new \stdClass();
        $response->users = $this->getUsers();

        return view('livewire.admin.users.table', ['response' => $response]);
    }
}
