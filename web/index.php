<?php
require '../vendor/slim/slim/Slim/Slim.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
    $file = "log.txt";
    $handle = fopen($file, "w");
    fwrite($handle, $name);
    fclose($handle);
});

$app->post('/post', function () use ($app) {

    $xml = simplexml_load_string(
        $app->request()->getBody()
    );

    $json = json_encode($xml);
    // $array = json_decode($json,TRUE);

    // $response = $app->response();
    // $response['Content-Type'] = 'application/json';
    // $response->body(json_encode($xml));


    /*$response = $app->response();
    $response['Content-Type'] = 'application/json';
    $response->body(json_encode($xml));*/


    $ch = curl_init('http://localhost:3000/post');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($json)
    ));

    $result = curl_exec($ch);

    $file = "log.txt";
    $handle = fopen($file, "w");
    fwrite($handle, $result);
    fclose($handle);

    //exec('curl -X POST -d ' . $json . ' http://localhost:3000/post --header "Content-Type:application/json"');
    //exec('curl -X POST -d ' . $json . ' http://localhost:3000/post --header "Content-Type:application/json"');
});

$app->run();
