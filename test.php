<?php
require_once 'core/init.php';
if (isset($_GET['students'])){
	$id = $_GET['students'];
	
		Test::Student($id);
	
	
}else{
	echo 'Chose student id';
}