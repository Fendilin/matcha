<?php

namespace App\Filter;

use DateTime;

class MonthFilter
{
    public function __invoke(string $date)
    {
        $givenDatetime = new Datetime($date);

        return $givenDatetime->format('m');
    }
}