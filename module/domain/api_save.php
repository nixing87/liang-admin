<?php
include __DIR__ . '/../../include/common_admin.php';
include _LA_VENDOR_PATH . 'liang-quick/Database/Mysql.php';

use LiangQuick\Database\Mysql;

if (empty($_POST['id'])) {
    $action = 'add';
    if (empty($_POST['domain_add'])) {
        jsonResult(4000211, '授权域名不能为空');
    }
    $domain = array_values(array_unique(array_filter(explode("\n", $_POST['domain_add']))));
    if (empty($domain)) {
        jsonResult(4000212, '授权域名不能为空');
    }
} else {
    $action = 'update';
    if (empty($_POST['domain_update'])) {
        jsonResult(4000213, '授权域名不能为空');
    }
    $id = $_POST['id'];
    $domain = $_POST['domain_update'];
}

if (empty($_POST['expire_in'])) {
    jsonResult(4000214, '到期时间不能为空');
}
$expire_in = strtotime($_POST['expire_in']);

if ($action == 'add') {
    $domainSql = [];
    foreach ($domain as $d) {
        $sql = "select id from la_domain where domain = '{$d}' limit 0, 1";
        $resultSet = Mysql::getInstance()->pdo->query($sql);
        $has = $resultSet->fetch(PDO::FETCH_ASSOC);
        if ($has) {
            jsonResult(4000215, '此域名已存在：' . $d);
        }
        $domainSql[] = "('{$d}', '{$expire_in}')";
    }
    $executeSql = "insert into la_domain (domain, expire_in) values " . implode(', ', $domainSql);
} else {
    $sql = "select * from la_domain where id = '{$id}'";
    $resultSet = Mysql::getInstance()->pdo->query($sql);
    $row = $resultSet->fetch(PDO::FETCH_ASSOC);
    if (empty($row)) {
        jsonResult(4000216, '此域名不存在');
    }
    if ($row['domain'] != $domain) {
        $sql = "select * from la_domain where domain = '{$domain}'";
        $resultSet = Mysql::getInstance()->pdo->query($sql);
        $has = $resultSet->fetch(PDO::FETCH_ASSOC);
        if ($has) {
            jsonResult(4000214, '此域名已存在');
        }
    }
    $executeSql = "update la_domain set domain = '{$domain}', expire_in = '{$expire_in}' where id = '{$row['id']}'";
}

$dbResult = Mysql::getInstance()->pdo->exec($executeSql);
if ($dbResult === false) {
    jsonResult(5000211, '操作失败');
}

jsonResult();
