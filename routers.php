<?php

define('_COMMON', _API.'/commons');
define('_CONFIG', _API.'/config');
define('_HELPER', _API.'/commons/helpers');
define('_CONTROLLER', _API.'/controllers');
define('_MODEL', _API.'/models');

//Settings
require_once _CONFIG . '/authenticator.php';
require_once _CONFIG . '/database.php';
require_once _HELPER . '/helpers.php';
require_once _COMMON . '/error.php';
require_once _COMMON . '/application.php';

//Fixed data
require_once _CONTROLLER . '/fixed_data.php';

//Models
require_once _MODEL . '/plan_price.php';
require_once _MODEL . '/term.php';
require_once _MODEL . '/first_access.php';
require_once _MODEL . '/user.php';
require_once _MODEL . '/security_question.php';
require_once _MODEL . '/user_security.php';
require_once _MODEL . '/token.php';
require_once _MODEL . '/notification.php';
require_once _MODEL . '/settings.php';

//Controllers
require_once _CONTROLLER . '/plan_price.php';
require_once _CONTROLLER . '/term.php';
require_once _CONTROLLER . '/first_access.php';
require_once _CONTROLLER . '/user.php';
require_once _CONTROLLER . '/security_question.php';
require_once _CONTROLLER . '/user_security.php';
require_once _CONTROLLER . '/token.php';
require_once _CONTROLLER . '/notification.php';
require_once _CONTROLLER . '/settings.php';