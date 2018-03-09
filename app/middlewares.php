<?php

/**
 * Middlewares
 * https://www.slimframework.com/docs/v3/concepts/middleware.html
 */

$application->add(new App\Middleware\OldInputMiddleware($container));
$application->add(new App\Middleware\AuthMiddleware($container));
$application->add(new App\Middleware\ChatMiddleware($container));
$application->add(new App\Middleware\CsrfViewMiddleware($container));
