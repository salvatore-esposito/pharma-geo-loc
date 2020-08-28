<?php
define('CURRENT_PATH', __DIR__ . DIRECTORY_SEPARATOR);
require_once CURRENT_PATH . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
require_once CURRENT_PATH . 'config' . DIRECTORY_SEPARATOR . 'bootstrap.php';
require_once CURRENT_PATH . 'routes' . DIRECTORY_SEPARATOR . 'web.php';

$app->run();
