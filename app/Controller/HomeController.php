<?php

namespace App\Controller;

use Alr\Sort\BubbleSort;
use App\Model\Tag;
use App\Model\User;
use InvalidArgumentException;
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

    public function homeFilter(Request $request, Response $response)
    {
		$filter = $request->getParsedBody();

		if (! array_key_exists('filter', $filter)) {
			throw new InvalidArgumentException('filter value not found');
		}

        $user = User::whereOne('username', '=', $_SESSION['username']);

//        $match = User::match($_SESSION['username']);
//        $match = array_values(User::delBlockedUser($match, $user['id']));
//        $match = array_values(User::homeFilter($match, $filter['filter']));
//
//		$arr = [];
//        foreach ($match as $data) {
//            if (!empty($data)) {
//				$arr[] = [
//					'file1' => $data['file_1'],
//					'username' => ucwords($data['username']),
//					'score' => $data['score'],
//					'country' => ucwords($data['country']),
//					'city' => ucwords($data['city']),
//					'zip' => $data['zip'],
//					'orientation' => $data['orientation'],
//					'gender' => $data['gender'],
//				];
//            }
//        }

        return $response->withJson('lol');
    }

    public function sortBy(Request $request, Response $response)
    {
		$filter = $request->getParsedBody();

		if (! is_array($filter)) {
			throw new InvalidArgumentException('invalid filter');
		}

		if (! array_key_exists('filter', $filter)) {
			throw new InvalidArgumentException('filter value not found');
		}

        $matches = User::match($_SESSION['username']);

		switch (strtolower($filter['filter'])) {
		case 'popularity':
            $col = 'score';
			break;
		case 'localisation':
            $col = 'zip';
			break;
		case 'age':
            $col = 'birthdate';
			break;
		case 'commun tags':
            $col = 'commonTags';
			break;
		default:
            $col = '';
		};

		$matches = $this->sortByCol($matches, $col);

		$arr = [];
        foreach ($matches as $cur) {
            if (!empty($cur)) {
				$arr[] = [
					'file1' => '../'.$cur['file_1'],
					'username' => ucwords($cur['username']),
					'score' => $cur['score'],
					'country' => ucwords($cur['country']),
					'city' => ucwords($cur['city']),
					'zip' => $cur['zip'],
					'orientation' => $cur['orientation'],
					'gender' => $cur['gender'],
				];
            }
        }

        return $response->withJson($arr);
    }

	private function sortByCol(array $matches, string $column): array
	{
		$ret = $matches;

		$i = 0;
		while ($ret[$i]) {
            if ($ret[$i][$column] < $ret[$i+1][$column]) {
                $tmp = $ret[$i+1];
                $ret[$i+1] = $ret[$i];
                $ret[$i] = $tmp;
                $i = -1;
            }
			++$i;
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
