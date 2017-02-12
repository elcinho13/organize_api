<?php

define('_CONFIG', _API.'/config');
define('_HELPER', _API.'/commons/helpers');
define('_CONTROLLER', _API.'/controllers');
define('_MODEL', _API.'/models');

//Settings
require_once _CONFIG . '/authenticator.php';
require_once _CONFIG . '/database.php';
require_once _HELPER . '/helpers.php';
require_once _HELPER . '/error.php';

//fixed data
require_once _CONTROLLER . '/fixed_data.php';



