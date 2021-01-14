<?php
include __DIR__ . '/../../../include/common_admin.php';
$_la_title = '文案配置';
$_la_breadcrumb = ['系统配置', '文案配置'];
include _LA_INCLUDE_PATH . 'view/header_admin.php';
$config = getSystemConfig('text');
?>
<div class="layui-card-body">
    <form class="layui-form">
        <div class="layui-form-item">
            <label class="layui-form-label">微信号</label>
            <div class="layui-input-block">
                <input name="weixin" placeholder="请输入微信号" value="<?php echo $config['weixin']; ?>" required lay-verify="required" class="layui-input" type="text">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="_la_submit">保存</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
</div>
<?php
include _LA_INCLUDE_PATH . 'view/footer_admin.php';
?>
<script>
layui.use(['index', 'form'], function (index, form) {
    var $ = layui.$
        , admin = layui.admin
    ;

    form.on('submit(_la_submit)', function (formObj) {
        if (!formObj.field.weixin) {
            layer.msg('请填写微信号', {icon: 2});
            return false;
        }
        var loadIndex = layer.load(1, {shade: [0.5, '#000000']});
        admin.req({
            url: _LA_MODULE_URL_PREFIX + 'system_config/text/api_save.php'
            , method: 'POST'
            , data: formObj.field
            , done: function () {
                layer.msg('操作成功', {icon: 1, time: 1000});
            }
            , complete: function () {
                layer.close(loadIndex);
            }
        });
        return false;
    });
});
</script>
<?php
include _LA_INCLUDE_PATH . 'view/footer.php';
