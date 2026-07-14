<?php

namespace App\Livewire\Washer\Financial\Informations;

use App\Models\User;
use App\Models\UserCommittees;
use App\Models\Withdrawals;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Card extends Component
{
    public $month;

    public function mount()
    {
        $this->month = date('m');
    }

    #[On('getBalanceByMonth')]
    public function getBalanceByMonth()
    {
        $balance = User::query()->findOrFail(Auth::user()->id);

        return $balance['value_commission'];
    }

    #[On('getCommissionsByMonth')]
    public function getCommissionsByMonth()
    {
        $userComissionsDB = UserCommittees::query()
            ->where('user_id', Auth::user()->id)
            ->whereMonth('created_at', $this->month)
            ->sum('value_commission');

        return $userComissionsDB ?? 0;
    }

    #[On('getWithDrawalsByMonth')]
    public function getWithDrawalsByMonth()
    {
        $withDrawalsDB = Withdrawals::query()
            ->where('user_id', Auth::user()->id)
            ->whereMonth('created_at', $this->month)
            ->sum('amount');

        return $withDrawalsDB ?? 0;
    }

    #[On('getPaymentsByMonth')]
    public function getPaymentsByMonth()
    {
        $withDrawalsDB = Withdrawals::query()
            ->where('user_id', Auth::user()->id)
            ->whereStatus('paid')
            ->whereMonth('created_at', $this->month)
            ->count();

        return $withDrawalsDB ?? 0;
    }

    public function render()
    {
        $response = new \stdClass();
        $response->balance = $this->getBalanceByMonth();
        $response->commissions = $this->getCommissionsByMonth();
        $response->withdrawals = $this->getWithDrawalsByMonth();
        $response->payments = $this->getPaymentsByMonth();

        return view('livewire.washer.financial.informations.card', ['response' => $response]);
    }
}
