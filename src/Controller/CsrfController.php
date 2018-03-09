<?php

namespace App\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Flash\Messages;

class CsrfController extends Controller
{
    const INDEX_CSRF_STATUS = 'csrf_status';

    const MESSAGE_TIME_OUT = 'Forced time-out, please reload the page.';

    public function __invoke(
        Request $request,
        Response $response,
        callable $next
    ): Response {
        if (false === $request->getAttribute(self::INDEX_CSRF_STATUS)) {
            $this->addTimeoutMessage();
            return $response->withRedirect($_SERVER['HTTP_REFERER']);
        }

        return $next($request, $response);
    }

    /**
     * @return void
     */
    private function addTimeoutMessage()
    {
        (new Messages())->addMessage('danger', self::MESSAGE_TIME_OUT);
    }
}