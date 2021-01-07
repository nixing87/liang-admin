<?php
include __DIR__ . '/include/common_admin.php';
include _LA_INCLUDE_PATH . 'view/header_admin.php';
?>
<div id="LAY_app" class="layadmin-tabspage-none">
    <div class="layui-layout layui-layout-admin">
        <div class="layui-header">
            <ul class="layui-nav layui-layout-left">
                <li class="layui-nav-item layadmin-flexible" lay-unselect>
                    <a href="javascript:;" layadmin-event="flexible" title="侧边伸缩">
                        <i class="layui-icon layui-icon-shrink-right" id="LAY_app_flexible"></i>
                    </a>
                </li>
                <li class="layui-nav-item layui-hide-xs" lay-unselect>
                    <a href="/" target="_blank" title="首页">
                        <i class="layui-icon layui-icon-website"></i>
                    </a>
                </li>
                <li class="layui-nav-item" lay-unselect>
                    <a href="javascript:;" layadmin-event="refresh" title="刷新">
                        <i class="layui-icon layui-icon-refresh-3"></i>
                    </a>
                </li>
            </ul>
            <ul class="layui-nav layui-layout-right" lay-filter="layadmin-layout-right">
                <li class="layui-nav-item layui-hide-xs" lay-unselect>
                    <a href="javascript:;" layadmin-event="theme">
                        <i class="layui-icon layui-icon-theme"></i>
                    </a>
                </li>
                <li class="layui-nav-item layui-hide-xs" lay-unselect>
                    <a href="javascript:;" layadmin-event="note">
                        <i class="layui-icon layui-icon-note"></i>
                    </a>
                </li>
                <li class="layui-nav-item layui-hide-xs" lay-unselect>
                    <a href="javascript:;" layadmin-event="fullscreen">
                        <i class="layui-icon layui-icon-screen-full"></i>
                    </a>
                </li>
                <li class="layui-nav-item" lay-unselect style="margin-right: 20px;">
                    <a href="javascript:;">
                        <cite><?php echo $_SESSION['_la']['loginUser']['username']; ?></cite>
                    </a>
                    <dl class="layui-nav-child">
                        <dd layadmin-event="logout" style="text-align: center;"><a>退出</a></dd>
                    </dl>
                </li>
            </ul>
        </div>
        <!-- 侧边菜单 -->
        <div class="layui-side layui-side-menu">
            <div class="layui-side-scroll">
                <div class="layui-logo" lay-href="<?php echo _LA_MODULE_URL_PREFIX; ?>domain/index.php">
                    <span>后台管理面板</span>
                </div>
                <ul class="layui-nav layui-nav-tree" lay-shrink="all" id="LAY-system-side-menu" lay-filter="layadmin-system-side-menu">
                    <li data-name="domain" class="layui-nav-item layui-nav-itemed">
                        <a href="javascript:;" lay-tips="域名管理" lay-direction="2">
                            <i class="layui-icon layui-icon-home"></i>
                            <cite>域名管理</cite>
                        </a>
                        <dl class="layui-nav-child">
                            <dd data-name="domain" class="layui-this">
                                <a lay-href="<?php echo _LA_MODULE_URL_PREFIX; ?>domain/index.php">域名列表</a>
                            </dd>
                        </dl>
                    </li>
                </ul>
            </div>
        </div>
        <!-- 主体内容 -->
        <div class="layui-body" id="LAY_app_body">
            <div class="layadmin-tabsbody-item layui-show">
                <iframe src="<?php echo _LA_MODULE_URL_PREFIX; ?>domain/index.php" frameborder="0" class="layadmin-iframe"></iframe>
            </div>
        </div>
        <!-- 辅助元素，一般用于移动设备下遮罩 -->
        <div class="layadmin-body-shade" layadmin-event="shade"></div>
    </div>
</div>
<?php
include _LA_INCLUDE_PATH . 'view/footer_admin.php';
?>
<script>
layui.use(['index'], function () {});
</script>
<?php
include _LA_INCLUDE_PATH . 'view/footer.php';
