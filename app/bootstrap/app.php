<?php

$app->post('/', function () use ($app) {

    $xml = simplexml_load_string(
        $app->request()->getBody()
    );

    $json = json_encode($xml);

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
