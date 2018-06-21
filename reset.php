<?php
require 'bootstrap.php';
	$auth = App::getAuth();
	$db = App::getDatabase();
	$validator = new Validator($_POST);
	$validator->isConfirmed('password', 'Mot de passe invalide');
	$password = $auth->hashPassword($_POST['password']) ;
	if($validator->isValid()){
		Session::getInstance()->setFlash('success','Votre mot de passe a bien été modifié');
		$auth->connect($user); 
		App::redirect('account.php');
	}
	else{
		Session::getInstance()->setFlash('danger','Mot de passe invalide');
		App::redirect('confirm_reset.php');
		}

?>

