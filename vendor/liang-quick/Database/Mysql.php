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

    public function insert($table, $data)
    {
        $sql_1 = [];
        $sql_2 = [];
        foreach ($data as $k => $v) {
            $sql_1[] = $k;
            $sql_2[] = "'{$v}'";
        }
        $sql = "insert into {$table} (" . implode(', ', $sql_1) . ") values (" . implode(', ', $sql_2) . ")";
        $result = $this->pdo->exec($sql);
        return $result;
    }

    public function update($table, $data, $where)
    {
        if (!is_null($where) && empty($where)) {
            return 0;
        }
        $sqlPart = [];
        foreach ($data as $k => $v) {
            $sqlPart[] = "{$k} = '{$v}'";
        }
        $sql = "update {$table} set " . implode(', ', $sqlPart) . " where ({$where})";
        $result = $this->pdo->exec($sql);
        return $result;
    }
}
