<?php
include __DIR__ . '/../../../include/common_admin.php';
$_la_title = '图片配置';
$_la_breadcrumb = ['系统配置', '图片配置'];
include _LA_INCLUDE_PATH . 'view/header_admin.php';
$config = getSystemConfig('image');
$imageDir = 'image/';
$image = [
    [
        'column' => 'logo',
        'text' => 'LOGO',
    ],
    [
        'column' => 'block_1',
        'text' => '位置一',
    ],
    [
        'column' => 'block_2',
        'text' => '位置二',
    ],
    [
        'column' => 'block_3',
        'text' => '位置三',
    ],
    [
        'column' => 'block_4',
        'text' => '位置四',
    ],
    [
        'column' => 'block_5',
        'text' => '位置五',
    ],
    [
        'column' => 'block_6',
        'text' => '位置六',
    ],
    [
        'column' => 'block_7',
        'text' => '位置七',
    ],
    [
        'column' => 'block_8',
        'text' => '位置八',
    ],
    [
        'column' => 'block_9',
        'text' => '位置九',
    ],
    [
        'column' => 'block_10',
        'text' => '位置十',
    ],
];
?>
<div class="layui-card-body">
    <form class="layui-form">
        <?php
        foreach ($image as $v) {
        ?>
            <div class="layui-form-item">
                <label class="layui-form-label"><?php echo $v['text']; ?></label>
                <div class="layui-input-block">
                    <input name="<?php echo $v['column']; ?>" value="<?php if (!empty($config[$v['column']])) {echo $config[$v['column']];} ?>" type="hidden">
                    <div class="_la_js_wrap_image" style="margin-bottom: 10px; <?php if (empty($config[$v['column']])) {echo 'display: none;';} ?>">
                        <img src="<?php if (!empty($config[$v['column']])) {echo _LA_UPLOAD_URL_PREFIX . $imageDir . $config[$v['column']];} ?>" width="300">
                    </div>
                    <button type="button" class="_la_js_button_upload layui-btn layui-btn-normal">
                        <i class="layui-icon layui-icon-picture"></i> 点击上传
                    </button>
                </div>
            </div>
            <hr class="layui-bg-gray">
        <?php
        }
        ?>
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
layui.use(['index', 'form', 'upload'], function (index, form, upload) {
    var $ = layui.$
        , admin = layui.admin
    ;

    var uploadInstance = upload.render({
        elem: '._la_js_button_upload'
        , url: _LA_MODULE_URL_PREFIX + 'upload/image.php'
        , accept: 'images'
        , acceptMime: 'image/*'
        , size: 10240
        , done: function (result) {
            if (result.code == 0) {
                $(this.item).siblings('input[type="hidden"]').val(result.data.filename);
                var wrap = $(this.item).siblings('._la_js_wrap_image');
                wrap.find('img').attr('src', result.data.src);
                wrap.show();
            } else {
                layer.msg(result.msg, {icon: 2});
            }
        }
        , error: function () {
            layer.msg('上传失败', {icon: 2});
        }
    });

    form.on('submit(_la_submit)', function (formObj) {
        var loadIndex = layer.load(1, {shade: [0.5, '#000000']});
        admin.req({
            url: _LA_MODULE_URL_PREFIX + 'system_config/image/api_save.php'
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
