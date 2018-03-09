<?php

namespace App\Container;

use App\Core\Container;
use App\Model\Pdo;
use Slim\Pdo\Database;

class PdoContainer extends Container
{
    /**
     * @return Database
     */
    public function __invoke()
    {
        return Pdo::getInstance()->getDb();
    }
}