<?php
/*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 *---------------------------------------------------------------
 *     1. development
 *     2. testing
 *     3. production
 */
define('ENVIRONMENT', '2');
if (defined('ENVIRONMENT'))
{
	switch (ENVIRONMENT)
	{
		case '1':
			error_reporting(E_ALL);
                        break;
	
		case '2':
                    	error_reporting(E_ALL & ~E_NOTICE);
                        break;
		case '3':
			error_reporting(0);
		break;

		default:
			exit('The application environment is not set correctly.');
	}
}
$php_version = '5.4.0';
if(version_compare($php_version, PHP_VERSION)>=0){
    header("Content-type: text/html; charset=utf-8");
    die('โปรแกรมนี้ต้องการ PHP ตั้งแต่เวอร์ชั่น '.$php_version.' เป็นต้นไป , เวอร์ชั่นที่ติดตั้ง: ' . PHP_VERSION . "\n");
}
session_start();
///////////////////////////////////////////////////////////
$site_url = 'http://localhost/dvt2017/';  // เปลี่ยนตาม site ที่ติดตั้ง
//$fis_year = '2556';         
$site_title = 'dve2017';
$site_subtitle = 'Dve 2017';
$version = 'Dve0.1';
$project = "Dve 2017";
$auhtor = "it-dev";
$author_email = "smith@cstc.ac.th";
// database parameter
$host = 'localhost';
$user = 'dvt2017';
$password = 'dvt2017!';
$database = 'dvt2017';
$charset = 'utf8';
//GRANT ALL PRIVILEGES ON dvt2017.* TO dvt@localhost IDENTIFIED BY '123456';
///////////////////////////////////////////////////////////
define('SITE_URL', $site_url);
define('INCLUDE_PATH', str_replace('\\','/',dirname(__FILE__)).'/');
define('BASE_PATH', dirname(INCLUDE_PATH).'/');
define('INC_PATH', BASE_PATH.'includes/');
define('LIB_PATH', BASE_PATH.'library/');
define('BOOTSTRAP_PATH', BASE_PATH.'bootstrap/');
define('UPLOAD_DIR', BASE_PATH . 'upload/');

define('APP_RRL', SITE_URL.'app/');
define('ADMIN_URL', SITE_URL.'admin/');
define('BOOTSTRAP_URL', SITE_URL.'bootstrap/');
define('JS_URL', SITE_URL.'js/');
define('CSS_URL', SITE_URL.'css/');
define('IMG_URL', SITE_URL.'images/');
define('FONTS_URL', SITE_URL.'fonts/');
define('OU_NAME', 'สำนักงานการอาชีวศึกษา');

/*--- Database connect ---*/
$db = mysqli_connect($host, $user, $password, $database);
//$mysqli = new mysqli($host, $user, $password, $database);
if (mysqli_connect_error())
{    
    header("Content-type: text/html; charset=utf-8");
    die("!เกิดข้อผิดพลาด : " . mysqli_connect_error());
}
mysqli_set_charset($db, $charset);
//$mysqli->set_charset($charset);

include_once LIB_PATH.'functions.php';

