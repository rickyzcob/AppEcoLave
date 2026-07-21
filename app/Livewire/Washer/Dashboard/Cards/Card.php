<?php

namespace App\Livewire\Washer\Dashboard\Cards;

use App\Models\Orders;
use App\Models\UsersReviews;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Card extends Component
{
    public $evaluate = [];
    public $orders = [];

    public function mount()
    {
        $evaluatesCount = Orders::query()->with(['review'])
            ->doesntHave('review')
            ->count();

//        $media = Orders::query()->where('status', 'service_finish')
//            ->whereNotNull('rate')
//            ->avg('rate');

        $media = UsersReviews::query()->where('washer_id', Auth::id())->avg('rate');

        $this->evaluate['evaluates_count'] = $evaluatesCount;
        $this->evaluate['evaluates_average'] = round($media);

        $ordersCount = Orders::query()->where('status_washer', 'accepted')->count();
        $this->orders['orders_count'] = $ordersCount;

        $ordersCountStarted = Orders::query()->where('status', 'service_started')->count();
        $this->orders['orders_started'] = $ordersCountStarted;

        $ordersCountFinish = Orders::query()->where('status', 'service_finish')->whereDate('updated_at', now())->count();
        $this->orders['orders_finish'] = $ordersCountFinish;

    }

    public function get()
    {

    }

    public function render()
    {
        return view('livewire.washer.dashboard.cards.card');
    }
}
