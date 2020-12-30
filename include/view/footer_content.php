            </div>
        </div>
    </div>
</div>
<script src="<?php echo _LA_LAYUI_ADMIN_URL_PREFIX; ?>layui/layui.js"></script>
<?php
if (!empty($_la_jsFile) && is_array($_la_jsFile)) {
    foreach ($_la_jsFile as $_v) {
        echo '<script src="' . $_v . '">';
    }
    unset($_v);
}
?>
<script>
var $
    , _la_admin
;
layui.config({
    base: '<?php echo _LA_LAYUI_ADMIN_URL_PREFIX; ?>'
}).extend({
    index: 'lib/index'
}).use(['index'], function () {
    $ = layui.$;
    _la_admin = layui.admin;
});
</script>
