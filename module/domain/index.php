<?php
include __DIR__ . '/../../include/common_admin.php';
$_la_title = '域名列表';
$_la_breadcrumb = ['域名管理', '域名列表'];
include _LA_INCLUDE_PATH . 'view/header_admin.php';
?>
<div class="layui-card-header">
    <button type="button" class="_la_js_add_domain_button layui-btn layui-btn-normal layui-btn-sm">添加域名</button>
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
            <input type="hidden" name="form_action" value="add">
            <input type="hidden" name="form_id">
            <div class="layui-form-item">
                <label class="layui-form-label">域名</label>
                <div class="layui-input-block">
                    <input name="form_domain" required lay-verify="required" placeholder="请输入域名，不带 http，如 www.baidu.com" type="text" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">到期时间</label>
                <div class="layui-input-block">
                    <input id="form_expire_in" name="form_expire_in" required lay-verify="required" placeholder="请选择到期时间" readonly class="layui-input" type="text">
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
include _LA_INCLUDE_PATH . 'view/footer_content.php';
?>
<script>
layui.use(['form', 'laydate', 'table'], function () {
    $ = layui.$;
    var form = layui.form
        , laydate = layui.laydate
        , table = layui.table
    ;

    laydate.render({
        elem: '#form_expire_in'
        , type: 'datetime'
        , format: 'yyyy-MM-dd HH:mm:ss'
        //, value: new Date(<?php //echo (strtotime('+1 day') * 1000); ?>//)
    });

    var tableInstance = table.render({
        elem: '#_la_table'
        , url: _LA_MODULE_URL_PREFIX + 'domain/api_list.php'
        , height: 'full-130'
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
            $('input[name="form_action"]').val('update');
            $('input[name="form_id"]').val(data.id);
            $('input[name="form_domain"]').val(data.domain);
            $('input[name="form_expire_in"]').val(data._expire_in);
            popupIndex = layer.open({
                type: 1
                , title: '编辑域名'
                , content: $('#_la_form')
                , area: ['50%']
                , btn: ['关闭']
            });
        } else if (event === 'delete') {
            layer.confirm('确定删除吗？', function (index) {
                _la_admin.req({
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
        _la_admin.req({
            url: _LA_MODULE_URL_PREFIX + 'domain/api_save.php'
            , method: 'POST'
            , data: formObj.field
            , done: function () {
                layer.msg('操作成功', {icon: 1, time: 1000}, function () {
                    layer.close(popupIndex);
                    tableInstance.reload();
                });
            }
        });
    });

    $('._la_js_add_domain_button').click(function () {
        $('input[name="form_action"]').val('add');
        $('input[name="form_id"]').val('');
        $('input[name="form_domain"]').val('');
        $('input[name="form_expire_in"]').val('');
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
