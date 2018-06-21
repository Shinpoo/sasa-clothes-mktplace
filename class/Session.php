<?php
class Session{
	static $instance; //null par def

	static function getInstance(){
		if(!self::$instance){
			self::$instance = new Session();
		}
		return self::$instance;
	}

	public function __construct(){
		session_start();
	}

	public function setFlash($key, $message){
		$_SESSION['flash'][$key] = $message;
	}

	public function hasFlashes(){
		return isset($_SESSION['flash']);
	}

	public function getFlashes(){
		$flash = $_SESSION['flash'];
		unset($_SESSION['flash']);
		return $flash;
	}

	public function write($key, $value){
		$_SESSION[$key]= $value;
	}

	public function write2keys($key1, $key2, $value){
		$_SESSION[$key1][$key2]= $value;
	}


	public function read($key){
		return isset($_SESSION[$key]) ? $_SESSION[$key] : null;	// si défini on la return sinon return null
	}

	public function delete($key){
		unset($_SESSION[$key]);
	}

	public function del2keys($key1, $key2){
		unset($_SESSION[$key1][$key2]);
	}

	public function createPanier(){
		if(!isset($_SESSION['panier'])){
			$_SESSION['panier'] = array();
		}
	}
}