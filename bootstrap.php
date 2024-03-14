<?php

define('__DIR_ROOT__', __DIR__);

//xứ lý http root

$web_root = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https://' . $_SERVER['HTTP_HOST'] : 'http://' . $_SERVER['HTTP_HOST'];

$folder = str_replace(strtolower($_SERVER['DOCUMENT_ROOT']), '', strtolower(str_replace('\\', '/', __DIR_ROOT__)));

$web_root = $web_root . $folder;

define('_WEB_PATH_', $web_root);

/**
 * tự động load config
 */
$configs_dir = scandir('configs');
if (!empty($configs_dir)) {
    foreach ($configs_dir as $config) {
        if ($config != '.' && $config != '..' && file_exists('configs/' . $config)) {
            // echo 'configs/'. $config. ''. '<br />';
            require_once 'configs/' . $config;
        }
    }
}
// require_once 'configs/routes.php'; //load routes config
require_once 'core/Route.php'; //load routes
require_once 'app/App.php'; //load app



if (!empty($configDB)) {
    $db_config = array_filter($configDB['database']);
    if (!empty($db_config)) {
        require_once 'core/Connection.php';
        require_once 'core/Database.php';
    }
}

require_once 'core/Model.php'; //load base model
require_once 'core/Controller.php'; //load base controller