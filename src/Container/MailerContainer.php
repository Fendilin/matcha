<?php

namespace App\Container;

use App\Core\Container;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Swift_Mailer;
use Swift_SmtpTransport;

class MailerContainer extends Container
{
    /**
     * @return Swift_Mailer
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke()
    {
        $settings = $this->container->get('settings');

        $host = $settings['mailer']['host'] ?: 'localhost';
        $port = $settings['mailer']['port'] ?: 1025;
        $user = $settings['mailer']['user'] ?: 'root';
        $pass = $settings['mailer']['pass'] ?: '' ;
        $security = $settings['mailer']['security'] ?: null;

        return new Swift_Mailer(
            (new Swift_SmtpTransport($host, $port, $security))
                ->setUsername($user)
                ->setPassword($pass)
        );
    }
}