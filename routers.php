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

//Fixed data
require_once _CONTROLLER . '/fixed_data.php';

//Models
require_once _MODEL . '/first_access.php';
require_once _MODEL . '/plan_price.php';
require_once _MODEL . '/term.php';
require_once _MODEL . '/user.php';
require_once _MODEL . '/token.php';

//Controllers
require_once _CONTROLLER . '/plan_price.php';
require_once _CONTROLLER . '/term.php';



