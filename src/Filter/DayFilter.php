<?php

namespace App\Filter;

use DateTime;

class DayFilter
{
    public function __invoke(string $date)
    {
        $givenDatetime = new Datetime($date);

        return $givenDatetime->format('d');
    }
}