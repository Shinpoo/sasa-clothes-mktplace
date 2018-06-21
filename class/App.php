<?php

class App
{
	static $db = null;


	static function getDatabase(){
		if(!self::$db){
			self::$db = new Database('root','','website1');
			self::$db;
		}
		return self::$db;
	}


	static function getAuth(){
		return new Auth(Session::getInstance(),['restriction_msg' => 'Page inaccessible']);
	}

	static function getPanier(){
		return new Panier(Session::getInstance(), App::getDatabase());
	}

	static function redirect($page){
		header("Location: $page");
		exit();
	}
}