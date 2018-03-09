<?php

/**
 * Containers
 * https://www.slimframework.com/docs/v3/concepts/di.html
 */

$container = $application->getContainer();

$container['twig']   = new App\Container\TwigContainer($container);
$container['csrf']   = new App\Container\CsrfContainer($container);
$container['flash']  = new App\Container\FlashContainer($container);
$container['mailer'] = new App\Container\MailerContainer($container);
$container['pdo']    = new App\Container\PdoContainer($container);
