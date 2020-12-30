<?php
include __DIR__ . '/../../include/common_admin.php';
include _LA_VENDOR_PATH . 'liang-quick/Database/Mysql.php';

use LiangQuick\Database\Mysql;

$sql = " from la_domain where 1 = 1";
$where = '';
$countSql = "select count(*) count" . $sql . $where;
$resultSet = Mysql::getInstance()->pdo->query($countSql);
$count = $resultSet->fetchColumn();
$dataSql = "select *" . $sql . $where . " order by id desc limit {$_la_offset}, {$_la_pageSize}";
$resultSet = Mysql::getInstance()->pdo->query($dataSql);
$data = $resultSet->fetchAll(PDO::FETCH_ASSOC);
foreach ($data as &$v) {
    $v['_expire_in'] = date('Y-m-d H:i:s', $v['expire_in']);
}
jsonResult(null, null, $data, ['count' => $count]);
