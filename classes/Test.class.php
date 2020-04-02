<?php
Class Admin{
	private static $db;
	public static function init(){
		self::$db = Connect::getInstance();
    }
	// 
public static function Student($id){
	if !empty($id){
		echo $id;
	}
}


}
Admin::init();