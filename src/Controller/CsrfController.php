<?php

namespace App\Controller;

use App\Core\Controller;
use Slim\Flash\Messages;
use Slim\Http\Request;
use Slim\Http\Response;

class CsrfController extends Controller
{
    const INDEX_CSRF_STATUS = 'csrf_status';

    const MESSAGE_TIME_OUT = 'Forced time-out, please reload the page.';

    const ROUTE_TIMEOUT_REDIRECT = '/';

    /**
     * @param  Request  $request
     * @param  Response $response
     * @param  callable $next
     * @return Response
     */
    public function __invoke(
        Request $request,
        Response $response,
        callable $next
    ): Response {
        if (! $this->hasCsrfAttributes($request)) {
            $this->addTimeoutMessage();
            return $response->withRedirect(self::ROUTE_TIMEOUT_REDIRECT);
        }

        return $next($request, $response);
    }

    /**
     * @param  Request $request
     * @return bool
     */
    private function hasCsrfAttributes(Request $request): bool
    {
        return true === $request->getAttribute(self::INDEX_CSRF_STATUS);
    }

    /**
     * @return void
     */
    private function addTimeoutMessage()
    {
        (new Messages())->addMessage('danger', self::MESSAGE_TIME_OUT);
    }
}