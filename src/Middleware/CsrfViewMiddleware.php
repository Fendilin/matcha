<?php

namespace App\Middleware;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
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
        $fields = $this->getCsrfFields();
        $this->addGlobalFields($fields);

        return $response = $next($request, $response);
    }

    /**
     * @return string
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function getCsrfFields(): string
    {
        $container = $this->container
            ->get('csrf');

        return sprintf(
            '%s%s',
            $this->createField(
                $container->getTokenNameKey(),
                $container->getTokenName()
            ),
            $this->createField(
                $container->getTokenValueKey(),
                $container->getTokenValue()
            )
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
                [
                    'field' => $fields,
                ]
            );
    }
}