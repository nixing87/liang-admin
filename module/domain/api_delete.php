<?php
include __DIR__ . '/../../include/common_admin.php';
include _LA_VENDOR_PATH . 'liang-quick/Database/Mysql.php';

use LiangQuick\Database\Mysql;

if (empty($_POST['id'])) {
    jsonResult(4000211, '参数错误');
}
$id = $_POST['id'];

$sql = "delete from la_domain where id = '{$id}'";
$dbResult = Mysql::getInstance()->pdo->exec($sql);
if ($dbResult === false) {
    jsonResult(5000211, '操作失败');
}

jsonResult();
