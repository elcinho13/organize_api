<?php

require 'vendor/autoload.php';
define("_API", dirname(__FILE__) . '/src');

$app = new \Slim\Slim(
        ['debug' => true]
);

//Instance routers
require_once 'routers.php';

require_once _API . '/config/authenticator.php';
$app->add(new \HttpBasicAuth('root', 'root'));

$app->response()->header('Content-Type', 'application/json;charset=utf-8');

//Instance Index
$app->get('/', function() {
    include('README.md');
});

//run
$app->run();


