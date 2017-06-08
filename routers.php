<?php

define('_COMMON', _API . '/commons');
define('_CONFIG', _API . '/config');
define('_CONTROLER', _API . '/controlers');
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
require_once _MODEL . '/classes.php';
require_once _MODEL . '/contact_type.php';
require_once _MODEL . '/contact.php';
require_once _MODEL . '/course.php';
require_once _MODEL . '/first_access.php';
require_once _MODEL . '/institutional.php';
require_once _MODEL . '/institution_type.php';
require_once _MODEL . '/institution.php';
require_once _MODEL . '/literacy.php';
require_once _MODEL . '/login_type.php';
require_once _MODEL . '/password_recovery.php';
require_once _MODEL . '/plan_advantages.php';
require_once _MODEL . '/plan_price.php';
require_once _MODEL . '/plan.php';
require_once _MODEL . '/place.php';
require_once _MODEL . '/privacy.php';
require_once _MODEL . '/security_question.php';
require_once _MODEL . '/setting.php';
require_once _MODEL . '/shift.php';
require_once _MODEL . '/social_network_type.php';
require_once _MODEL . '/term.php';
require_once _MODEL . '/token.php';
require_once _MODEL . '/user_admin.php';
require_once _MODEL . '/user_notifications.php';
require_once _MODEL . '/user_security.php';
require_once _MODEL . '/user_social_network.php';
require_once _MODEL . '/user_settings.php';
require_once _MODEL . '/user_term.php';
require_once _MODEL . '/user_type.php';
require_once _MODEL . '/user.php';
require_once _MODEL . '/user_contact.php';


//Controllers
require_once _CONTROLER . '/access_platform.php';
require_once _CONTROLER . '/classes.php';
require_once _CONTROLER . '/contact_type.php';
require_once _CONTROLER . '/contact.php';
require_once _CONTROLER . '/course.php';
require_once _CONTROLER . '/first_access.php';
require_once _CONTROLER . '/institutional.php';
require_once _CONTROLER . '/institution_type.php';
require_once _CONTROLER . '/institution.php';
require_once _CONTROLER . '/literacy.php';
require_once _CONTROLER . '/login_type.php';
require_once _CONTROLER . '/password_recovery.php';
require_once _CONTROLER . '/plan_advantages.php';
require_once _CONTROLER . '/plan_price.php';
require_once _CONTROLER . '/plan.php';
require_once _CONTROLER . '/privacy.php';
require_once _CONTROLER . '/security_question.php';
require_once _CONTROLER . '/setting.php';
require_once _CONTROLER . '/shift.php';
require_once _CONTROLER . '/social_network_type.php';
require_once _CONTROLER . '/term.php';
require_once _CONTROLER . '/token.php';
require_once _CONTROLER . '/user_admin.php';
require_once _CONTROLER . '/user_notifications.php';
require_once _CONTROLER . '/user_security.php';
require_once _CONTROLER . '/user_social_network.php';
require_once _CONTROLER . '/user_settings.php';
require_once _CONTROLER . '/user_term.php';
require_once _CONTROLER . '/user_type.php';
require_once _CONTROLER . '/user.php';
require_once _CONTROLER . '/user_contact.php';