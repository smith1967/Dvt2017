<?php
$mainmenu = array(
	'home' => array(
		'title'=>'หน้าหลัก',
		'url'=>'home/index',
		'cond'=>true,
	),
	'signup' => array(
		'title'=>'ลงทะเบียน',
		'url'=>'user/signup.php',
		'cond'=>true,
	),
	'Editpasswd' => array(
		'title'=>'แก้ไขรหัสผ่าน',
		'url'=>'user/editpasswd',
		'cond'=>isset($_SESSION['username']) && ($_SESSION['username']['mem_club_admin']+0)> 0,
	),	
	'admin' => array(
		'title'=>'ผู้ดูแลระบบ',
		'url'=>'admin/index',
		'cond'=> isset($_SESSION['username']) && $_SESSION['username']['user_name']=='Admin',
	),	
        'signout' => array(
		'title' => 'ออกระบบ',
		'url' => 'user/logout',
		'cond' => isset($_SESSION['username']),
	),
	'signin' => array(
		'title' => 'เข้าระบบ',
		'url' => 'user/login',
		'cond' => !isset($_SESSION['username']),
	),
);

$dropdown = array(
	'home' => array(
		'title'=>'หน้าหลัก',
		'url'=>'home/index',
		'cond'=>true,
	),
	'signup' => array(
		'title'=>'ลงทะเบียน',
		'url'=>'user/signup.php',
		'cond'=>true,
	),
	'' => array(
		'title'=>'Club Admin',
		'url'=>'clubadmin/home',
		'cond'=>isset($_SESSION['username']) && ($_SESSION['username']['mem_club_admin']+0)> 0,
	),	
	'admin' => array(
		'title'=>'System Admin',
		'url'=>'admin/home',
		'cond'=> isset($_SESSION['username']) && $_SESSION['username']['mem_is_admin']=='Y',
	),	'signout' => array(
		'title' => 'ออกระบบ',
		'url' => 'home/logout',
		'cond' => isset($_SESSION['username']),
	),
	'signin' => array(
		'title' => 'เข้าระบบ',
		'url' => 'home/login',
		'cond' => !isset($_SESSION['username']),
	),
);

 

