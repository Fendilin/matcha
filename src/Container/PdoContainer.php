<?php

namespace App\Container;

use App\Core\Container;
use App\Model\Pdo;

class PdoContainer extends Container
{
    /**
     * @return 
     */
    public function __invoke()
    {
        return Pdo::getInstance()->getDb();
    }
}