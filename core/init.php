<?php
session_start();
$GLOBALS['config'] = array(
	'DB' => array(
		'host' => 'localhost',
		'user' => 'root',
		'password' => '',
		'db_name' => 'test'
	),
	'app_dir' => 'C:\xampp\htdocs', 
	'site_url' => 'localhost',
);
spl_autoload_register(function($classname){
	
require "{$GLOBALS['config']['app_dir']}/classes/{$classname}.class.php";

}

);
