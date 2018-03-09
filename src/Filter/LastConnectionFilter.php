<?php

namespace App\Filter;

use DateTime;
use DateInterval;
use Exception;

class LastConnectionFilter
{
    /**
     * @param string $date
     * @return string
     * @throws Exception
     */
    public function __invoke(string $date)
    {
        $givenDatetime = new DateTime($date);
        $todayDatetime = new DateTime('today');
        $diff = $givenDatetime->diff($todayDatetime);

        if ((array)$diff > (array)new DateInterval('P1Y')) {
            $message = $diff->y > 1
                ? $diff->y . " years"
                : $diff->y . " year";
        } elseif ((array)$diff > (array)new DateInterval('P1M')) {
            $message = $diff->m > 1
                ? $diff->m . " months"
                : $diff->m . " month";
        } elseif ((array)$diff > (array)new DateInterval('P1D')) {
            $message = $diff->d > 1
                ? $diff->d . " days"
                : $diff->d . " day";
        } elseif ((array)$diff > (array)new DateInterval('PT1H')) {
            $message = $diff->h > 1
                ? $diff->h . " hours"
                : $diff->h . " hour";
        } elseif ((array)$diff > (array)new DateInterval('PT1M')) {
            $message = $diff->i > 1
                ? $diff->i . " minutes"
                : $diff->i . " minute";
        } elseif ((array)$diff > (array)new DateInterval('PT1S')) {
            $message = $diff->s > 1
                ? $diff->s . " secondes"
                : $diff->s . " seconde";
        } else {
            $message = 'Some time ago';
        }

        return $message;
    }
}