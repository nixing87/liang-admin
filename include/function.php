<?php
function getSystemConfig($type = 'base')
{
    $file = _LA_MODULE_PATH . "system_config/{$type}/config.json";
    if (!is_file($file)) {
        $config = [];
    } else {
        $config = file_get_contents($file);
        $config = json_decode($config, true);
        if (empty($config) || !is_array($config)) {
            $config = [];
        }
    }
    return $config;
}
