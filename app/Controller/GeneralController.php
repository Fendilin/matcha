<?php

namespace App\Controller;

use App\Model\Connected;
use App\Model\Notif;
use App\Model\Pdo;
use App\Model\User;
use Slim\Http\Response;
use Slim\Http\Request;


class GeneralController extends Controller
{
    public function connectedAction (Request $req, Response $res) {
        return json_encode(Connected::stillAlive());
    }

    public function stillConnectAction (Request $req, Response $res) {
        $param = $req->getParams();
        $ret = self::stillConnected($param['data']);

        return json_encode($ret);
    }

    public static function getNotifAction (Request $req, Response $res) {
        $param = $req->getParams();
        $data = Notif::getNotif($param['user']);

        $ret = '';
        foreach ($data as $d) {
            $color = ($d['read'] === 0) ? 'unread' : 'read';
            $ret .= '<div class="row col-md-12 notif-ticket ' . $color . '">';
            $ret .=     '<div class="hidden">' . $d['id'] . '</div>';
            $ret .=     '<div class="col-md-2 notif-img" style="background: url(\'/img/user/' . $d['img'] . '\')"></div>';
            $ret .=     '<div class="col-md-7 notif-content">' . $d['content'] . '</div>';
            $ret .=     '<div class="col-md-3 notif-date">' . Notif::intervalDate($d['date']) . '</div>';
            $ret .= '</div>';
        }

        return json_encode($ret);
    }

    public static function countNotifAction (Request $req, Response $res) {
        $pdo = Pdo::getInstance();
        $user = User::whereOne('username', '=', $_SESSION['username']);

        $sql = "SELECT * FROM notif WHERE `user_id` = " . $user['id'] . " AND `read` = 0";
        $prep = $pdo->getDb()->prepare($sql);
        $prep->execute();

        return json_encode($prep->rowCount());
    }

    public static function readNotifAction (Request $req, Response $res) {
        $param = $req->getParams();

        return Notif::readNotif($param['id']);
    }

    public static function stillConnected($param) {
        $ret = [];
        foreach ($param as $p) {
            array_push($ret, Connected::connected($p['username']));
        }

        return json_encode($ret);
    }
}
