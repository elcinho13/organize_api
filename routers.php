<?php

define('_COMMON', _API . '/commons');
define('_CONFIG', _API . '/config');
define('_CONTROLLER', _API . '/controllers');
define('_MODEL', _API . '/models');

//Settings
require_once _COMMON . '/application.php';
require_once _COMMON . '/error.php';
require_once _COMMON . '/helpers.php';
require_once _COMMON . '/relations.php';
require_once _CONFIG . '/authenticator.php';
require_once _CONFIG . '/database.php';

//Models
require_once _MODEL . '/access_platform.php';
require_once _MODEL . '/contact_type.php';
require_once _MODEL . '/contact.php';
require_once _MODEL . '/first_access.php';
require_once _MODEL . '/institutional.php';
require_once _MODEL . '/login_type.php';
require_once _MODEL . '/plan_advantages.php';
require_once _MODEL . '/plan_price.php';
require_once _MODEL . '/plan.php';
require_once _MODEL . '/privacy.php';
require_once _MODEL . '/security_question.php';
require_once _MODEL . '/setting.php';
require_once _MODEL . '/term.php';
require_once _MODEL . '/token.php';
require_once _MODEL . '/user_notifications.php';
require_once _MODEL . '/user_security.php';
require_once _MODEL . '/user_settings.php';
require_once _MODEL . '/user_term.php';
require_once _MODEL . '/user_type.php';
require_once _MODEL . '/user.php';

//Controllers
require_once _CONTROLLER . '/access_platform.php';
require_once _CONTROLLER . '/contact_type.php';
require_once _CONTROLLER . '/contact.php';
require_once _CONTROLLER . '/first_access.php';
require_once _CONTROLLER . '/institutional.php';
require_once _CONTROLLER . '/login_type.php';
require_once _CONTROLLER . '/plan_advantages.php';
require_once _CONTROLLER . '/plan_price.php';
require_once _CONTROLLER . '/plan.php';
require_once _CONTROLLER . '/privacy.php';
require_once _CONTROLLER . '/security_question.php';
require_once _CONTROLLER . '/setting.php';
require_once _CONTROLLER . '/term.php';
require_once _CONTROLLER . '/token.php';
require_once _CONTROLLER . '/user_notifications.php';
require_once _CONTROLLER . '/user_security.php';
require_once _CONTROLLER . '/user_settings.php';
require_once _CONTROLLER . '/user_term.php';
require_once _CONTROLLER . '/user_type.php';
require_once _CONTROLLER . '/user.php';
