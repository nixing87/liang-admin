<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo (empty($_la_title) ? '后台管理面板' : $_la_title); ?></title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link href="<?php echo _LA_LAYUI_ADMIN_URL_PREFIX; ?>layui/css/layui.css?v=<?php echo $_la_appConfig['asset_version']; ?>" media="all" rel="stylesheet" type="text/css">
    <link href="<?php echo _LA_LAYUI_ADMIN_URL_PREFIX; ?>style/admin.css?v=<?php echo $_la_appConfig['asset_version']; ?>" media="all" rel="stylesheet" type="text/css">
    <link href="<?php echo _LA_ASSET_URL_PREFIX; ?>css/common.css?v=<?php echo $_la_appConfig['asset_version']; ?>" media="all" rel="stylesheet" type="text/css">
    <?php
    if (!empty($_la_cssFile) && is_array($_la_cssFile)) {
        foreach ($_la_cssFile as $_v) {
            echo '<link href="' . $_v . '?v=' . $_la_appConfig['asset_version'] . '" media="all" rel="stylesheet" type="text/css">';
        }
        unset($_v);
    }
    ?>
    <script>
        const _LA_MODULE_URL_PREFIX = '<?php echo _LA_MODULE_URL_PREFIX; ?>';
        const _LA_LAYUI_ADMIN_URL_PREFIX = '<?php echo _LA_LAYUI_ADMIN_URL_PREFIX; ?>';
        var _la_appConfigPageSize = '<?php echo $_la_appConfig['pageSize']; ?>';
    </script>
</head>
