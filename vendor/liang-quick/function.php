<?php
function jsonResult($code = null, $message = null, $data = [], $extra = [])
{
    if (is_null($code)) {
        $code = 0;
    }
    if (is_null($message)) {
        $message = 'success';
    }
    $result = [
        'code' => $code,
        'msg' => $message,
        'data' => $data,
    ];
    $result = array_merge($result, $extra);
    header('Content-type: application/json; charset=utf-8');
    exit(json_encode($result));
}

function isAjax()
{
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'] == 'xmlhttprequest')) {
        return true;
    }
    return false;
}
