<?php

namespace App\Model;

class Chat
{
    public static function addMessage ($to, $content) {
        if (empty($content)) {
            return 0;
        }
        $pdo = Pdo::getInstance();
        $date = new \DateTime('now');
        $user = User::whereOne('username', '=', $_SESSION['username']);
        $sql = "INSERT INTO chat (`from`, `to`, `content`, `date`, `read`) VALUES ('" . $user['id'] . "', '" . $to . "', '" . $content . "', '" . $date->format('Y-m-d H:i:s') . "', '" . 0 . "')";
        $tmt = $pdo->getDb()->prepare($sql);

        return $tmt->execute();
    }

    public static function getMessages ($user) {
        $pdo = Pdo::getInstance();
        $cuser = User::whereOne('username', '=', $_SESSION['username']);
        $sql = "SELECT * FROM chat WHERE (`from` = " . $user . " AND `to` = " . $cuser['id'] . ") OR (`from` = " . $cuser['id'] . " AND `to` = " . $user . ") ORDER BY `date` ASC";
        $stmt = $pdo->getDb()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function countUnreadMessages ($user) {
        $messages = self::getMessages($user['id']);

        foreach ($messages as $key => $m) {
            if ($m['read'] === 1 || $m['from'] != $user['id']) {
                unset($messages[$key]);
            }
        }
        $mess = array_values($messages);

        return count($mess);
    }

    public static function readAll ($user) {
        $pdo = Pdo::getInstance();
        $user = User::whereOne('username', '=', $user);
        $cuser = User::whereOne('username', '=', $_SESSION['username']);

        $sql = "UPDATE chat SET `read` = 1 WHERE (`from` = '" . $user['id'] . "' AND `to` = '" . $cuser['id'] . "')";
        $stmt = $pdo->getDb()->prepare($sql);

        return $stmt->execute();
    }
}