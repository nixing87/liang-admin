<?php
include __DIR__ . '/../../include/common_admin.php';

if (empty($_FILES['file']) || empty($_FILES['file']['tmp_name'])) {
    jsonResult(4000401, '请上传图片');
}

if ($_FILES['file']['error'] > 0) {
    jsonResult(5000401, '上传图片失败: ' . $_FILES['file']['error']);
}

$filenameInfo = explode('.', $_FILES['file']['name']);
$extension = end($filenameInfo);
$filename = uniqid('la_') . '.' . $extension;
$fileDir = 'image/';
$filePath = _LA_UPLOAD_PATH . $fileDir . $filename;
$result = move_uploaded_file($_FILES['file']['tmp_name'], $filePath);
if ($result === false) {
    jsonResult(5000402, '上传图片失败');
}

jsonResult(null, null, ['src' => _LA_UPLOAD_URL_PREFIX . $fileDir . $filename, 'filename' => $filename]);
