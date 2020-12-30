<?php
include __DIR__ . '/common.php';

if (empty($_SESSION['_la']['loginUser'])) {
    if (isAjax()) {
        jsonResult(4010101, '未登录或登录超时');
    }
    header('Location: ' . _LA_MODULE_URL_PREFIX . 'manager/login.php');
    exit();
}
