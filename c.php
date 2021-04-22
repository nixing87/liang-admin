<?php
include __DIR__ . '/include/common.php';
include _LA_VENDOR_PATH . 'liang-quick/Database/Mysql.php';

use LiangQuick\Database\Mysql;

if (empty($_GET['d'])) {
    jsonResult(4000211);
}
$domain = urldecode($_GET['d']);

$sql = "select * from la_domain where domain = '{$domain}'";
$resultSet = Mysql::getInstance()->pdo->query($sql);
$row = $resultSet->fetch(PDO::FETCH_ASSOC);

if (empty($row)) {
//    jsonResult(4040211);
    $row = [
        'domain' => $domain,
        'expire_in' => _LA_TIMESTAMP + $_la_appConfig['domain']['defaultTime'],
    ];
    $dbResult = Mysql::getInstance()->insert('la_domain', $row);
    if ($dbResult === false) {
        jsonResult(5000211);
    }
}

if ($row['expire_in'] <= time()) {
    jsonResult(4030211);
}

jsonResult(200);
