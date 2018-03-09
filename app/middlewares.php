<?php

use App\Middleware\AuthMiddleware;
use App\Middleware\ChatMiddleware;
use App\Middleware\CsrfViewMiddleware;
use App\Middleware\OldInputMiddleware;

$application->add(new AuthMiddleware($container));
$application->add(new ChatMiddleware($container));
$application->add(new CsrfViewMiddleware($container));
$application->add(new OldInputMiddleware($container));
$application->add($container->csrf);