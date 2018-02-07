<?php

namespace App\Controller;

use App\Model\Tag;
use App\Model\User;
use Slim\Http\Request;
use Slim\Http\Response;

class SearchController extends Controller
{
    public function searchView (Request $req, Response $res) {
        $flash = $this->flash->getMessages();
        $user = User::whereOne('username', '=', $_SESSION['username']);
        $tags = Tag::getAll();
        $search = User::getAll();
        foreach ($search as $key => $v) {
            $search[$key]['commonTags'] = User::commonTags($_SESSION['username'], $v['username']);
        }
        $search = User::delBlockedUser($search, $user['id']);

        return $this->view->render($res, 'search.html.twig', [
            'head_name' => $_SESSION['username'],
            'flash' => $flash,
            'tags' => $tags,
            'match' => array_values($search)
        ]);
    }

    public function searchFilter (Request $req, Response $res) {
        $flash = $this->flash->getMessages();
        $user = User::whereOne('username', '=', $_SESSION['username']);
        $tags = Tag::getAll();
        $param = $req->getParams();
        $match = User::search($param);
        $match = User::delBlockedUser($match, $user['id']);

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
}
