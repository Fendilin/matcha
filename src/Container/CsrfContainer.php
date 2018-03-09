<?php

namespace App\Container;

use App\Controller\CsrfController;
use App\Core\Container;
use Slim\Csrf\Guard;

class CsrfContainer extends Container
{
    /**
     * @return Guard
     */
    public function __invoke(): Guard
    {
        $guard = new Guard();
        $guard->setFailureCallable(CsrfController::class);

        return $guard;
    }
}