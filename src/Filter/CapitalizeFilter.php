<?php

namespace App\Filter;

class CapitalizeFilter
{
    /**
     * @param string $message
     * @return string
     */
    public function __invoke(string $message)
    {
        return ucwords($message);
    }
}