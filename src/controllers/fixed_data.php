<?php

define('_DATA', _API.'/commons/fixedData');

$app->get('/access_platform', function (){
    include(_DATA.'/access_platform.json');
});

$app->get('/institutional', function (){
    include(_DATA.'/institutional.json');
});

$app->get('/login_type', function (){
    include(_DATA.'/login_type.json');
});

$app->get('/plans', function (){
    include(_DATA.'/plans.json');
});

$app->get('/privacy', function (){
    include(_DATA.'/privacy.json');
});

$app->get('/settings', function (){
    include(_DATA.'/settings.json');
});

$app->get('/user_type', function (){
    include(_DATA.'/user_type.json');
});

