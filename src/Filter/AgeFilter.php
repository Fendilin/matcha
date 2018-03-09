<?php

namespace App\Filter;

use DateTime;

class AgeFilter
{
    /**
     * @param string $date
     * @return int
     */
    public function __invoke(string $date)
    {
        $givenDatetime = new DateTime($date);
        $todayDatetime = new DateTime('today');

        return $givenDatetime->diff($todayDatetime)->y;
    }
}