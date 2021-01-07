<script src="<?php echo _LA_LAYUI_ADMIN_URL_PREFIX; ?>layui/layui.js?v=<?php echo $_la_appConfig['asset_version']; ?>"></script>
<?php
if (!empty($_la_jsFile) && is_array($_la_jsFile)) {
    foreach ($_la_jsFile as $_v) {
        echo '<script src="' . $_v . '?v=' . $_la_appConfig['asset_version'] . '">';
    }
    unset($_v);
}
?>
<script>
layui.config({
    base: '<?php echo _LA_LAYUI_ADMIN_URL_PREFIX; ?>'
}).extend({
    index: 'lib/index'
});
</script>
