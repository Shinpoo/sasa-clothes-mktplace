<?php
	function debug($variable){
		echo '<pre>' .print_r($variable, true). '</pre>';
	}


	function logged_only(){
		if(session_status()==PHP_SESSION_NONE){
			session_start();
		}
		if (!isset($_SESSION['auth'])){
			$_SESSION['flash']['danger'] = 'Accès réservé aux membres';
			header('Location: login.php');
			exit();
		}
	}

	function unlogged_only(){
		if (isset($_SESSION['auth'])){
			$_SESSION['flash']['danger'] = 'Vous êtes déjà connecté';
			header('Location: accueil.php');
			exit();
		}
	}

	function reconnect_from_cookie(){
		if(session_status()==PHP_SESSION_NONE){
			session_start();
		}
		if(isset($_COOKIE['remember']) && !isset($_SESSION['auth']) ){
			require_once 'db.php';
			if(!isset($pdo)){
				global  $pdo;
			}
			$remember_token = $_COOKIE['remember'];
			$parts = explode('==', $remember_token);
			$user_id = $parts[0];
			$req = $pdo->prepare('SELECT * FROM users WHERE ID = ?');
			$req->execute([$user_id]);
			$user = $req->fetch();
			if($user){
				$expected = $user_id .'=='. $user->remember_token . sha1($user_id . 'ratonlaveurs');
				if($expected == $remember_token){
					session_start();
					$_SESSION['auth'] = $user;
					setcookie('remember',$remember_token, time() + 60*60*24*7);
					header('Location: account.php');		
				}
			}else{
				setcookie('remember', null, -1);
			}
		}
	}