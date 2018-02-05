<?php

namespace App\Middleware;

use App\Model\Connected;
use App\Model\User;
use Slim\Http\Request;
use Slim\Http\Response;

class ChatMiddleware extends Middleware
{
    public function __invoke (Request $req, Response $res, $next)
    {
        $user = User::whereOne('username', '=', $_SESSION['username']);
        $sql = $this->container->pdo->select()->from('likes')->where('liked_id', '=', $user['id'])->orWhere('like_id', '=', $user['id']);
        $exec = $sql->execute();
        $data = $exec->fetchAll();
        $connectedWith = [];
        $connectedTo = [];
        foreach ($data as $d) {
            if ($user['id'] === $d['like_id']) {
                array_push($connectedTo, $d['liked_id']);
            } elseif ($user['id'] === $d['liked_id']) {
                array_push($connectedWith, $d['like_id']);
            }
        }
        $connected = [];
        foreach ($connectedWith as $c) {
            if (in_array($c, $connectedTo)) {
                array_push($connected, $c);
            }
        }
        if (empty($connected)) {
            return $res = $next($req, $res);
        }
        $sql = $this->container->pdo->select()->from('user')->whereIn('id', $connected);
        $exec = $sql->execute();
        $data = $exec->fetchAll();

        $i = 0;
        if (!empty($data)) {
            while ($data[$i]) {
                $data[$i]['online'] = Connected::connected($data[$i]['username']);
                $i++;
            }
        }
        $this->container->view->getEnvironment()->addGlobal('connectedWith', $data);

        return $res = $next($req, $res);
    }
}