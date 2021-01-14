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
define('_LA_MODULE_PATH', _LA_ROOT_PATH . 'module/');
define('_LA_UPLOAD_PATH', _LA_ROOT_PATH . 'upload/');
define('_LA_VENDOR_PATH', _LA_ROOT_PATH . 'vendor/');

$_la_appConfig = include _LA_CONFIG_PATH . 'app.php';

if (empty($_la_appConfig['subdirectory'])) {
    define('_LA_APP_URL_PREFIX', '/');
} else {
    define('_LA_APP_URL_PREFIX', $_la_appConfig['subdirectory']);
}

define('_LA_MODULE_URL_PREFIX', _LA_APP_URL_PREFIX . 'module/');
define('_LA_UPLOAD_URL_PREFIX', _LA_APP_URL_PREFIX . 'upload/');
define('_LA_ASSET_URL_PREFIX', _LA_APP_URL_PREFIX . 'asset/');
define('_LA_LAYUI_ADMIN_URL_PREFIX', _LA_ASSET_URL_PREFIX . 'vendor/layuiadmin/');

define('_LA_TIMESTAMP', time());

$_la_page = empty($_GET['page']) ? 1 : (int)$_GET['page'];
$_la_pageSize = $_la_appConfig['pageSize'];
if (!empty($_GET['limit'])) {
    $_la_pageSize = (int)$_GET['limit'];
}
$_la_offset = ($_la_page - 1) * $_la_pageSize;

@session_start();

include _LA_VENDOR_PATH  . 'liang-quick/function.php';
include _LA_INCLUDE_PATH  . 'function.php';
