<?php
include __DIR__ . '/../../../include/common_admin.php';

if (empty($_POST['weixin'])) {
    jsonResult(4000311, '微信号不能为空');
}

$file = __DIR__ . '/config.json';
$config = file_get_contents($file);
$config = json_decode($config, true);
if (empty($config) || !is_array($config)) {
    $config = $_POST;
} else {
    $config = array_merge($config, $_POST);
}
$config = json_encode($config);
$result = file_put_contents($file, $config);
if ($result === false) {
    jsonResult(5000311, '操作失败');
}
jsonResult();
