<?php

// DONT FORGET TO EDIT JS CONFIG VARIABLES

$site['name'] = 'NorthBC';

$http = 'http';
if(isset($_SERVER['HTTPS']) == 'on') $http .= 's';
$pageUrl = $http . '://' . $_SERVER['SERVER_NAME'] . '/';

define('BASE_URL', $pageUrl . 'nbc/www/');
define('BASE_PATH', '/var/www/html/clients/nbc/');
define('CLASS_PATH', BASE_PATH . 'classes/');
define('SITE_PATH', BASE_PATH . 'www/');
define('UPLOAD_PATH', SITE_PATH . 'uploads/');

define('DB_NAME', 'nbc');
define('DB_HOST', 'localhost');
define('DB_USER', 'nbc');
define('DB_PASS', 'letmein!');

define('APP_ID', '183664281769605');
define('APP_SECRET', '82ddaa576fd54f7fdd72c7f487eb9c4b');

define('PAGE_TAB', 'http://www.facebook.com/pages/Telenova-IP-Services/287547201338150?sk=app_183664281769605');

require_once(BASE_PATH . 'common.php');

?>
