<?php

namespace App\Middleware;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class OldInputMiddleware extends Middleware
{
    const INDEX_GLOBAL  = 'old';
    const INDEX_SESSION = 'old';

    /**
     * @param  Request  $request
     * @param  Response $response
     * @param  callable $next
     * @return Response
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     */
    public function __invoke(
        Request $request,
        Response $response,
        callable $next
    ): Response {
        $this->container
            ->get('twig')
            ->getEnvironment()
            ->addGlobal(
                self::INDEX_GLOBAL,
                $_SESSION[self::INDEX_SESSION]
            );

        $_SESSION[self::INDEX_SESSION] = $request->getParams();

        return $response = $next($request, $response);
    }
}
