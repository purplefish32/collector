<?php

define('VENDOR_PATH', __DIR__.'/../../vendor/');
define('APP_PATH', __DIR__.'/../../app/');

require VENDOR_PATH.'autoload.php';

$config = array();

foreach (glob(APP_PATH . 'config/*.php') as $configFile) {
    require $configFile;
}

$app = new \Slim\Slim();

$app->container->singleton('log', function () {
    $log = new \Monolog\Logger('collector');
    $log->pushHandler(new \Monolog\Handler\StreamHandler(APP_PATH . 'logs/' . date('Y-m-d') . '.log', \Monolog\Logger::DEBUG));
    return $log;
});

foreach ($config as $configKey => $configValue) {
    $app->config($configKey, $configValue);
}

require APP_PATH . 'bootstrap/app.php';

return $app;
