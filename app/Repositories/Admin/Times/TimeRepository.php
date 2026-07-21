<?php

namespace App\Repositories\Admin\Times;

use App\Models\Orders;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class TimeRepository
{
    public function getSelectTimes()
    {
        return [
            '08:00',
            '09:00',
            '10:00',
            '11:00',
            '14:00',
            '15:00',
            '16:00',
            '17:00',
            '18:00',
        ];

    }

    public function getAvailableTimes(string $date, int $professionalId = null): array
    {

        $start = Carbon::parse($date.' 08:00');
        $end = Carbon::parse($date.' 18:00');

        $period = CarbonPeriod::create($start, '1 hour', $end->copy()->subHour());

        $busyTimes = Orders::query()
            ->whereDate('date_schedule', $date)
//            ->where('professional_id', $professionalId)
            ->pluck('hour_schedule')
            ->map(fn ($time) => Carbon::parse($time)->format('H:i'))
            ->toArray();


        $available = [];

        foreach ($period as $time) {

            $hour = $time->format('H:i');

            // Ignora o horário de almoço
            if ($hour >= '12:00' && $hour < '14:00') {
                continue;
            }

            if (! in_array($hour, $busyTimes)) {
                $available[] = $hour;
            }
        }

        return $available;
    }

}
