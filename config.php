<?php

// DONT FORGET TO EDIT JS CONFIG VARIABLES

$site['name'] = 'Love Ottawa';

$http = 'http';
if(isset($_SERVER['HTTPS']) == 'on') $http .= 's';
$pageUrl = $http . '://' . $_SERVER['SERVER_NAME'] . '/';

define('BASE_URL', $pageUrl . 'ottawa/www/');
define('BASE_PATH', '/var/www/html/clients/ottawa/');
define('CLASS_PATH', BASE_PATH . 'classes/');
define('SITE_PATH', BASE_PATH . 'www/');
define('UPLOAD_PATH', SITE_PATH . 'uploads/');

define('DB_NAME', 'ottawa');
define('DB_HOST', 'localhost');
define('DB_USER', 'ottawa');
define('DB_PASS', 'letmein!');

define('APP_ID', '368337929912122');
define('APP_SECRET', 'e07c419fc57be521f98409fb3cdbd0f5');

define('PAGE_TAB', 'http://www.facebook.com/pages/Telenova-IP-Services/287547201338150?sk=app_368337929912122');

require_once(BASE_PATH . 'common.php');

?>
