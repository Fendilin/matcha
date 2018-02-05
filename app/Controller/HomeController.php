<?php

namespace App\Controller;

use App\Model\User;
use App\Model\Tag;
use Slim\Http\Request;
use Slim\Http\Response;

class HomeController extends Controller
{
    public function homeView (Request $req, Response $res)
    {
        $flash = $this->flash->getMessages();
        $user = User::whereOne('username', '=', $_SESSION['username']);
        $tags = Tag::getAll();
        $match = User::match($_SESSION['username']);
        $match = User::delBlockedUser($match, $user['id']);

        return $this->view->render($res, 'home.html.twig', ['head_name' => $_SESSION['username'], 'match' => array_values($match), 'flash' => $flash, 'tags' => $tags]);
    }

    public function homeFilter (Request $req, Response $res)
    {
        $flash = $this->flash->getMessages();
        $param = $req->getParams();
        $user = User::whereOne('username', '=', $_SESSION['username']);
        $match = User::match($_SESSION['username']);
        $match = array_values(User::delBlockedUser($match, $user['id']));
        $match = array_values(User::homeFilter($match, $param));
        $ret['match'] = $match;
        $str = '';
        
        foreach ($match as $data) {
            if (!empty($data)) {
                $str .= '<div class="col-xs-12 col-md-4 ticket">';
                $str .= '<div class="row">';
                $str .=            '<div class="profile-img col-xs-4" style="background: url(\'/img/user/' . $data['file_1'] . '\')"></div>';
                $str .= '<div class="col-xs-8">';
                $str .= '<p class="username">' . ucwords($data['username']) . '</p>';
                $str .= '<p class="age">' . $data['score'] . '</p>';
                $str .= '<p class="from">' . ucwords($data['country']) . '<br/>' . ucwords($data['city']) . ' ' . ucwords($data['zip']) . '</p>';
                $str .= '</div>';
                $str .= '<div class="gender">';
                if ($data['gender'] == 1) {
                    $str .= '<img id="gender-img" src="/img/male.png" alt="gender" title="gender"/><br />';
                } elseif ($data['gender'] == 2) {
                    $str .= '<img id="gender-img" src="/img/female.png" alt="gender" title="gender"/><br />';
                }
                $str .= '</div>';
                $str .= '<div class="orient">';
                if (($data['gender'] == 1 && $data['orientation'] == 1) || ($data['gender'] == 2 && $data['orientation'] == 2)) {
                    $str .= '<img id="orient-img" src="/img/female.png" alt="orientation" title="orientation"/>';
                } elseif (($data['gender'] == 1 && $data['orientation'] == 2) || ($data['gender'] == 2 && $data['orientation'] == 1)) {
                    $str .= '<img id="orient-img" src="/img/male.png" alt="orientation" title="orientation"/>';
                } elseif ($data['orientation'] == 3) {
                    $str .= '<img id="orient-img" src="/img/male.png" alt="orientation" title="orientation"/>';
                    $str .= '<img id="orient-img" src="/img/female.png" alt="orientation" title="orientation"/>';
                }
                $str .= '</div>';
                $str .= '<a class="profile-link" href="/profile/' . $data['username'] . '"></a>';
                $str .= '</div>';
                $str .= '</div>';
            }
        }

        $ret['content'] = $str;

        return json_encode($ret);
    }

    public function sortBy (Request $req, Response $res)
    {
        $param = $req->getParams();
        $i = 0;
        $pada = $param['data'];

        $col = '';
        if ($param['orderBy'] === 'popularity') {
            $col = 'score';
        } elseif ($param['orderBy'] === 'location') {
            $col = 'zip';
        } elseif ($param['orderBy'] === 'age') {
            $col = 'birthdate';
        } elseif ($param['orderBy'] === 'tags') {
            $col = 'commonTags';
        }
        while ($pada[$i]) {
            if ($pada[$i][$col] < $pada[$i + 1][$col]) {
                $tmp = $pada[$i + 1];
                $pada[$i + 1] = $pada[$i];
                $pada[$i] = $tmp;
                $i = -1;
            }
            $i++;
        }
        $ret = '';
        foreach ($pada as $data) {
            if (!empty($data)) {
                $ret .= '<div class="col-xs-12 col-md-4 ticket">';
                $ret .= '<div class="row">';
                $ret .=            '<div class="profile-img col-xs-4" style="background: url(\'/img/user/' . $data['file_1'] . '\')"></div>';
                $ret .= '<div class="col-xs-8">';
                $ret .= '<p class="username">' . ucwords($data['username']) . '</p>';
                $ret .= '<p class="age">' . $data['score'] . '</p>';
                $ret .= '<p class="from">' . ucwords($data['country']) . '<br/>' . ucwords($data['city']) . ' ' . ucwords($data['zip']) . '</p>';
                $ret .= '</div>';
                $ret .= '<div class="gender">';
                if ($data['gender'] == 1) {
                    $ret .= '<img id="gender-img" src="/img/male.png" alt="gender" title="gender"/><br />';
                } elseif ($data['gender'] == 2) {
                    $ret .= '<img id="gender-img" src="/img/female.png" alt="gender" title="gender"/><br />';
                }
                $ret .= '</div>';
                $ret .= '<div class="orient">';
                if (($data['gender'] == 1 && $data['orientation'] == 1) || ($data['gender'] == 2 && $data['orientation'] == 2)) {
                    $ret .= '<img id="orient-img" src="/img/female.png" alt="orientation" title="orientation"/>';
                } elseif (($data['gender'] == 1 && $data['orientation'] == 2) || ($data['gender'] == 2 && $data['orientation'] == 1)) {
                    $ret .= '<img id="orient-img" src="/img/male.png" alt="orientation" title="orientation"/>';
                } elseif ($data['orientation'] == 3) {
                    $ret .= '<img id="orient-img" src="/img/male.png" alt="orientation" title="orientation"/>';
                    $ret .= '<img id="orient-img" src="/img/female.png" alt="orientation" title="orientation"/>';
                }
                $ret .= '</div>';
                $ret .= '<a class="profile-link" href="/profile/' . $data['username'] . '"></a>';
                $ret .= '</div>';
                $ret .= '</div>';
            }
        }

        return $ret;
    }

    public function logout (Request $req, Response $res)
    {
        unset($_SESSION['username']);
        unset($_SESSION['active']);
        unset($_SESSION['register']);
        unset($_COOKIE['username']);
        setcookie('username', null, -1, '/');

        return $res->withRedirect('/');
    }
}