<?php

define('APP_PATH', __DIR__.'/../../app/');

$config = array();

foreach (glob(APP_PATH . 'config/*.php') as $configFile) {
    require $configFile;
}

$app = new \Slim\Slim();

foreach ($config as $configKey => $configValue) {
    $app->config($configKey, $configValue);
}

require APP_PATH . 'bootstrap/app.php';

return $app;
