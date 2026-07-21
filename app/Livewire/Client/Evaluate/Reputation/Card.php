<?php

namespace App\Livewire\Client\Evaluate\Reputation;

use App\Models\UsersReviews;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Card extends Component
{
    public function getReputationByClient()
    {
        $reviews = UsersReviews::query()
            ->where('client_id', Auth::id())
            ->selectRaw('rate, COUNT(*) as total')
            ->groupBy('rate')
            ->pluck('total', 'rate');

        $total = $reviews->sum();

        $percentages = collect(range(5,1 ))->mapWithKeys(function ($rate) use ($reviews, $total) {

            $count = $reviews->get($rate, 0);

            return [
                "{$rate}" => $total
                    ? round(($count / $total) * 100)
                    : 0,
            ];
        });

        return $percentages;

    }

    public function getTotalsforAvaliations()
    {

        $totalReviews = UsersReviews::query()->where('client_id', Auth::id())->count();
        $averageReviews = UsersReviews::query()->where('client_id', Auth::id())->avg('rate');

        return [
            'total' => $totalReviews,
            'average' =>$averageReviews
        ];

    }


    public function render()
    {
        $response = new \stdClass();
        $response->reputations = $this->getReputationByClient();
        $response->totals = $this->getTotalsforAvaliations();

        return view('livewire.client.evaluate.reputation.card', ['response' => $response]);
    }
}
