<?php

$app->post('/', function () use ($app) {

    $app->log->info("collector '/' route");

    $xml = simplexml_load_string(
        $app->request()->getBody()
    );

    $json = json_encode($xml);

    $app->log->info("collector payload : " . $json);
    $app->log->info("meteor URL : " . $app->config['meteor']['url']);

    $ch = curl_init($app->config['meteor']['url']);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($json)
    ));
});
