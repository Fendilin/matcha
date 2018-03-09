<?php

namespace App\Model;

use Slim\PDO\Database;
use InvalidArgumentException;

class Pdo
{
    /**
     * @var Pdo
     */
    private static $instance;

    /**
     * @var Database
     */
    private $database;

    /**
     * @var array
     */
    private $config = [
        'hostname' => 'localhost',
        'username' => 'root',
        'password' => 'root',
        'database' => 'matcha',
    ];

    /**
     * @throws InvalidArgumentException
     */
    public function __construct()
    {
        if (
            ! array_key_exists('hostname', $this->config)
            || ! array_key_exists('username', $this->config)
            || ! array_key_exists('password', $this->config)
            || ! array_key_exists('database', $this->config)
        ) {
            throw new InvalidArgumentException();
        }

        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;charset=utf8',
            $this->config['host'],
            $this->config['database']
        );

        $this->database = new Database(
            $dsn,
            $this->config['username'],
            $this->config['password']
        );
    }

    /**
     * @return Pdo
     */
    public static function getInstance(): Pdo
    {
        if (is_null(self::$instance)) {
            self::$instance = new Pdo();
        }

        return self::$instance;
    }

    /**
     * @return Database
     */
    public function getDb(): Database
    {
        return $this->database;
    }
}
