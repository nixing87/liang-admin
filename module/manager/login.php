<?php
include __DIR__ . '/../../include/common.php';
$_la_title = '后台登录';
$_la_cssFile = [
    _LA_LAYUI_ADMIN_URL_PREFIX . 'style/login.css',
];
include _LA_INCLUDE_PATH . 'view/header.php';
?>
<div class="layadmin-user-login layadmin-user-display-show" id="LAY-user-login">
    <div class="layadmin-user-login-main">
        <div class="layadmin-user-login-box layadmin-user-login-header">
            <h2>域名授权系统</h2>
            <p>授权是否允许使用程序</p>
        </div>
        <div class="layadmin-user-login-box layadmin-user-login-body layui-form">
            <div class="layui-form-item">
                <label class="layadmin-user-login-icon layui-icon layui-icon-username" for="LAY-user-login-username"></label>
                <input value="" type="text" name="username" id="LAY-user-login-username" lay-verify="required" placeholder="用户名" class="layui-input">
            </div>
            <div class="layui-form-item">
                <label class="layadmin-user-login-icon layui-icon layui-icon-password" for="LAY-user-login-password"></label>
                <input value="" type="password" name="password" id="LAY-user-login-password" lay-verify="required" placeholder="密码" class="layui-input">
            </div>
            <div class="layui-form-item">
                <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="LAY-user-login-submit">登录</button>
            </div>
        </div>
    </div>
</div>
<?php
include _LA_INCLUDE_PATH . 'view/footer_content.php';
?>
<script>
layui.use(['form'], function () {
    var form = layui.form
    ;

    form.on('submit(LAY-user-login-submit)', function (formObj) {
        _la_admin.req({
            url: _LA_MODULE_URL_PREFIX + 'manager/api_login.php'
            , method: 'POST'
            , data: formObj.field
            , done: function () {
                layer.msg('登录成功', {
                    offset: '15px'
                    , icon: 1
                    , time: 1000
                }, function () {
                    location.href = '../../index.php';
                });
            }
        });
    });
});
</script>
<?php
include _LA_INCLUDE_PATH . 'view/footer.php';
