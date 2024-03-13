<?php

define('__DIR_ROOT__', __DIR__);

//xứ lý http root

$web_root = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https://' . $_SERVER['HTTP_HOST'] : 'http://' . $_SERVER['HTTP_HOST'];

$folder = str_replace(strtolower($_SERVER['DOCUMENT_ROOT']), '', strtolower(str_replace('\\', '/', __DIR_ROOT__)));

$web_root = $web_root .$folder;

define('_WEB_PATH_', $web_root);

require_once 'configs/routes.php';
require_once 'app/app.php';
require_once 'core/Controller.php'; //load base controller
