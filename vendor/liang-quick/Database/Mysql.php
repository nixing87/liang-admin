<?php
namespace LiangQuick\Database;

class Mysql
{
    public static $instance = null;

    public $pdo = null;

    public function __construct($host, $databaseName, $username = null, $password = null, $port = 3306, $option = null)
    {
        $this->pdo = new \PDO("mysql:host=$host;port=$port;dbname=$databaseName;charset=utf8", $username, $password, $option);
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            $databaseConfig = include _LA_CONFIG_PATH . 'database.php';
            self::$instance = new self(
                $databaseConfig['host'],
                $databaseConfig['databaseName'],
                $databaseConfig['username'],
                $databaseConfig['password'],
                $databaseConfig['port'],
                $databaseConfig['option']
            );
        }
        return self::$instance;
    }
}
