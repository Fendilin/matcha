<?php

namespace App\Container;

use App\Core\Controller;
use Slim\Flash\Messages;

class FlashContainer extends Controller
{
    /**
     * @return Messages
     */
    public function __invoke(): Messages
    {
        return new Messages();
    }
}