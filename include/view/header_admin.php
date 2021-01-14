<?php
include __DIR__ . '/header.php';
?>
<body class="<?php if (!empty($_la_bodyClass)) {echo $_la_bodyClass;} ?>">
<?php
if (!empty($_la_breadcrumb) && is_array($_la_breadcrumb)) {
?>
    <div class="layui-card layadmin-header">
        <div class="layui-breadcrumb" lay-filter="breadcrumb">
            <?php
            foreach ($_la_breadcrumb as $_v) {
                echo "<a><cite>{$_v}</cite></a>";
            }
            unset($_v);
            ?>
        </div>
    </div>
<?php
}
?>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
