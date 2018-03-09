<?php

session_start();

use Slim\App;

require '../vendor/autoload.php';

$config = require __DIR__.'/../app/config.php';

$application = new App($config);

require __DIR__.'/../app/containers.php';

require __DIR__.'/../app/middlewares.php';

require __DIR__.'/../app/routes.php';

$application->run();
