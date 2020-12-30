<?php
$_la_debug = 1;
if ($_la_debug) {
    error_reporting(-1);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
}

define('_LA_ROOT_PATH', __DIR__ . '/../');
define('_LA_CONFIG_PATH', _LA_ROOT_PATH . 'config/');
define('_LA_INCLUDE_PATH', _LA_ROOT_PATH . 'include/');
define('_LA_VENDOR_PATH', _LA_ROOT_PATH . 'vendor/');

define('_LA_API_URL_PREFIX', '/module/');
define('_LA_ASSET_URL_PREFIX', '/asset/');
define('_LA_LAYUI_ADMIN_URL_PREFIX', _LA_ASSET_URL_PREFIX . 'vendor/layuiadmin/');

define('_LA_TIMESTAMP', time());

$_la_appConfig = include _LA_CONFIG_PATH . 'app.php';
$_la_page = empty($_GET['page']) ? 1 : (int)$_GET['page'];
$_la_pageSize = $_la_appConfig['pageSize'];
if (!empty($_GET['limit'])) {
    $_la_pageSize = (int)$_GET['limit'];
}
$_la_offset = ($_la_page - 1) * $_la_pageSize;

@session_start();

include _LA_VENDOR_PATH  . 'liang-quick/function.php';
