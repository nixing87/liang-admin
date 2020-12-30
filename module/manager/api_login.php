<?php
include __DIR__ . '/../../include/common.php';

if (empty($_POST['username'])) {
    jsonResult(4000111, '用户名不能为空');
}
if (empty($_POST['password'])) {
    jsonResult(4000112, '密码不能为空');
}
if ($_POST['username'] != $_la_appConfig['username']) {
    jsonResult(4000113, '用户名错误');
}
if ($_POST['password'] != $_la_appConfig['password']) {
    jsonResult(4000114, '密码错误');
}
$_SESSION['_la'] = [
    'loginUser' => [
        'id' => 1,
        'username' => $_la_appConfig['username'],
    ],
];
jsonResult();
