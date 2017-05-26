<?php

require 'vendor/autoload.php';
define("_API", dirname(__FILE__) . '/src');

$app = new \Slim\Slim(
        ['debug' => true]
);

require_once 'routers.php';
require_once _API . '/config/authenticator.php';

$app->add(new \HttpBasicAuth('root', 'root'));
$app->response->header(
    'Content-Type', 'application/json;charset=utf-8',
    'Access-Control-Allow-Origin', 'http://organize4event.com/',
    'Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization',
    'Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
$app->get('/', function() {
    include('README.md');
});

$app->run();


