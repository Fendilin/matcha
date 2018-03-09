<?php

namespace App\Core;

use Psr\Container\ContainerInterface;

class Controller
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function __get($property) {
        if ($this->container->{$property}) {
            return $this->container->{$property};
        }
    }

}
