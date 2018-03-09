<?php

namespace App\Middleware;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Slim\Csrf\Guard;
use Slim\Http\Request;
use Slim\Http\Response;

class CsrfViewMiddleware extends Middleware
{
    /**
     * @param  Request  $request
     * @param  Response $response
     * @param  callable $next
     * @return Response
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(
        Request $request,
        Response $response,
        callable $next
    ): Response {
        $container = $this->container->get('csrf');
        $fields = $this->getCsrfFields($container);
        $this->addGlobalFields($fields);

        return $response = $next($request, $response);
    }

    /**
     * @param  Guard $container
     * @return string
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function getCsrfFields(Guard $container): string
    {
        $tokenField = $this->createField(
            $container->getTokenNameKey(),
            $container->getTokenName()
        );
        $valueField = $this->createField(
            $container->getTokenValueKey(),
            $container->getTokenValue()
        );

        return sprintf(
            '%s%s',
            $tokenField,
            $valueField
        );
    }

    /**
     * @param  string $key
     * @param  string $value
     * @return string
     */
    private function createField(string $key, $value): string
    {
        return sprintf(
            '<input type="hidden" name="%s" value="%s" />',
            $key,
            $value
        );
    }

    /**
     * @param  string $fields
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function addGlobalFields(string $fields)
    {
        $this->container
            ->get('twig')
            ->getEnvironment()
            ->addGlobal(
                'csrf',
                ['field' => $fields]
            );
    }
}