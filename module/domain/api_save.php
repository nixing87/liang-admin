<?php
include __DIR__ . '/../../include/common_admin.php';
include _LA_VENDOR_PATH . 'liang-quick/Database/Mysql.php';

use LiangQuick\Database\Mysql;

if (empty($_POST['form_domain']) || empty($_POST['form_expire_in'])) {
    jsonResult(4000211, '参数错误');
}
$domain = $_POST['form_domain'];
$expire_in = strtotime($_POST['form_expire_in']);

$action = empty($_POST['form_action']) ? 'add' : $_POST['form_action'];
if (!in_array($action, ['add', 'update'])){
    $action = 'add';
}

if ($action == 'add') {
    $executeSql = "insert into la_domain (domain, expire_in) values ('{$domain}', '{$expire_in}')";
} elseif ($action == 'update') {
    if (empty($_POST['form_id'])) {
        jsonResult(4000212, '参数错误');
    }
    $id = $_POST['form_id'];
    $sql = "select * from la_domain where id = '{$id}'";
    $resultSet = Mysql::getInstance()->pdo->query($sql);
    $data = $resultSet->fetch(PDO::FETCH_ASSOC);
    if (empty($data)) {
        jsonResult(4000212, '该条数据不存在');
    }

    $executeSql = "update la_domain set domain = '{$domain}', expire_in = '{$expire_in}' where id = '{$data['id']}'";
}

if (($action == 'update' && $data['domain'] != $domain) || $action == 'add') {
    $sql = "select * from la_domain where domain = '{$domain}'";
    $resultSet = Mysql::getInstance()->pdo->query($sql);
    $has = $resultSet->fetch(PDO::FETCH_ASSOC);
    if ($has) {
        jsonResult(4000213, '该域名已存在');
    }
}

$dbResult = Mysql::getInstance()->pdo->exec($executeSql);
if ($dbResult === false) {
    jsonResult(5000211, '操作失败');
}

jsonResult();
