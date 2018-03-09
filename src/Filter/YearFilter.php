<?php

namespace App\Filter;

use DateTime;

class YearFilter
{
    public function __invoke(string $date)
    {
        $givenDatetime = new Datetime($date);

        return $givenDatetime->format('Y');
    }
}