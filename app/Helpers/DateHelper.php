<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    public static function fullNow(): string
    {
        $now = Carbon::now();

        return ucfirst($now->translatedFormat('l'))
            . ', '
            . $now->format('d')
            . ' de '
            . ucfirst($now->translatedFormat('F'))
            . ' de '
            . $now->format('Y');
    }

    public static function full(Carbon|string $date): string
    {
        $date = $date instanceof Carbon
            ? $date
            : Carbon::parse($date);

        return ucfirst($date->translatedFormat('l'))
            . ', '
            . $date->format('d')
            . ' de '
            . ucfirst($date->translatedFormat('F'))
            . ' de '
            . $date->format('Y');
    }

}
