<?php
include __DIR__ . '/../../include/common_admin.php';
$_la_title = '域名列表';
$_la_breadcrumb = ['域名管理', '域名列表'];
include _LA_INCLUDE_PATH . 'view/header_admin.php';
?>
<div class="layui-card-header">
    <button type="button" class="_la_js_button_add_domain layui-btn layui-btn-normal layui-btn-sm">添加域名</button>
</div>
<div class="layui-card-header layuiadmin-card-header-auto">
    <form class="layui-form">
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">域名</label>
                <div class="layui-input-inline" style="width: 500px;">
                    <input type="text" name="domain_search" placeholder="请输入域名，模糊搜索" class="layui-input">
                </div>
            </div>
            <div class="layui-inline">
                <button lay-submit lay-filter="_la_submit_search" type="button" class="layui-btn layui-btn-warm">搜索</button>
            </div>
        </div>
    </form>
</div>
<div class="layui-card-body">
    <table class="layui-hide" id="_la_table" lay-filter="_la_table"></table>
</div>
<script type="text/html" id="_la_operate_wrap">
    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="delete">删除</a>
</script>
<div id="_la_form" style="display: none;">
    <div class="_la_form_wrap">
        <form class="layui-form">
            <input type="hidden" name="id">
            <div class="layui-form-item">
                <label class="layui-form-label">授权域名</label>
                <div class="layui-input-block">
                    <textarea style="height: 200px; display: none;" name="domain_add" placeholder="不带 http，如 www.baidu.com，一行一个域名" class="layui-textarea"></textarea>
                    <input style="display: none;" name="domain_update" placeholder="不带 http，如 www.baidu.com" type="text" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">到期时间</label>
                <div class="layui-input-block">
                    <input id="expire_in" name="expire_in" placeholder="请选择到期时间" readonly class="layui-input" type="text">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button type="button" class="layui-btn" lay-submit lay-filter="_la_submit">提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
include _LA_INCLUDE_PATH . 'view/footer_admin.php';
?>
<script>
layui.use(['index', 'form', 'laydate', 'table'], function (index, form, laydate, table) {
    var $ = layui.$
        , admin = layui.admin
    ;

    laydate.render({
        elem: '#expire_in'
        , type: 'datetime'
        , format: 'yyyy-MM-dd HH:mm:ss'
    });

    var tableInstance = table.render({
        elem: '#_la_table'
        , url: _LA_MODULE_URL_PREFIX + 'domain/api_list.php'
        , height: 'full-210'
        , page: true
        , limit: _la_appConfigPageSize
        , cols: [[
            {field: 'id', title: 'ID', align: 'center', width:100, sort: true}
            , {field: 'domain', title: '域名', align: 'center'}
            , {field:'_expire_in', title: '到期时间', align: 'center', width:180, sort: true, templet: function (d) {
                var now = <?php echo _LA_TIMESTAMP; ?>;
                var h = '<span style="color: #009688; font-weight: bold;" title="未到期">' + d._expire_in + '</span>';
                if (d.expire_in <= now) {
                    h = '<span style="color: #FF5722; font-weight: bold;" title="已到期">' + d._expire_in + '</span>';
                }
                return h;
            }}
            , {field:'updated_at', title: '更新时间', align: 'center', width:180, sort: true}
            , {title: '操作', align: 'center', width:180, toolbar: '#_la_operate_wrap'}
        ]]
    });

    var popupIndex;
    table.on('tool(_la_table)', function (tableObj) {
        var data = tableObj.data;
        var event = tableObj.event;
        if (event === 'edit') {
            $('textarea[name="domain_add"]').val('').hide();
            $('input[name="domain_update"]').val(data.domain).show();
            $('input[name="id"]').val(data.id);
            $('input[name="expire_in"]').val(data._expire_in);
            popupIndex = layer.open({
                type: 1
                , title: '编辑域名'
                , content: $('#_la_form')
                , area: ['50%']
                , btn: ['关闭']
            });
        } else if (event === 'delete') {
            layer.confirm('确定删除吗？', function (index) {
                admin.req({
                    url: _LA_MODULE_URL_PREFIX + 'domain/api_delete.php'
                    , method: 'POST'
                    , data: {id: data.id}
                    , done: function () {
                        tableObj.del();
                        layer.msg('操作成功', {icon: 1, time: 1000}, function () {
                            layer.close(index);
                        });
                    }
                });
            });
        }
    });

    form.on('submit(_la_submit)', function (formObj) {
        if (formObj.field.id) {
            if (!formObj.field.domain_update) {
                layer.msg('请填写授权域名', {icon: 2});
                return false;
            }
        } else {
            if (!formObj.field.domain_add) {
                layer.msg('请填写授权域名', {icon: 2});
                return false;
            }
        }
        if (!formObj.field.expire_in) {
            layer.msg('请选择到期时间', {icon: 2});
            return false;
        }
        var loadIndex = layer.load(1, {shade: [0.5, '#000000']});
        admin.req({
            url: _LA_MODULE_URL_PREFIX + 'domain/api_save.php'
            , method: 'POST'
            , data: formObj.field
            , done: function () {
                layer.msg('操作成功', {icon: 1, time: 1000}, function () {
                    layer.close(popupIndex);
                    tableInstance.reload({where: {}});
                });
            }
            , complete: function () {
                layer.close(loadIndex);
            }
        });
    });

    form.on('submit(_la_submit_search)', function (formObj) {
        tableInstance.reload({
            where: formObj.field
            , page: {curr: 1}
        });
    });

    $('._la_js_button_add_domain').click(function () {
        $('input[name="domain_update"]').val('').hide();
        $('textarea[name="domain_add"]').val('').show();
        $('input[name="id"]').val('');
        $('input[name="expire_in"]').val('');
        popupIndex = layer.open({
            type: 1
            , title: '添加域名'
            , content: $('#_la_form')
            , area: ['50%']
            , btn: ['关闭']
        });
    });
});
</script>
<?php
include _LA_INCLUDE_PATH . 'view/footer.php';
