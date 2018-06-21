<?php
require 'bootstrap.php';

$db = App::getDatabase();

if(App::getAuth()->confirm($db, $_GET['id'], $_GET['token'])){
	Session::getInstance()->setFlash('success',"Votre compte a bien été validé");
	App::redirect('account.php');
}else{
	Session::getInstance()->setFlash('danger',"Lien de confirmation expiré: conf token invalide");
	App::redirect('login.php');
}





/*$user_id = $_GET['id'];
$token = $_GET['token'];
$user = $db->query('SELECT * FROM users WHERE id = ?',[$user_id])->fetch();

if ($user && $user->confirmation_token == $token){
	$pdo->prepare('UPDATE users SET confirmation_token = NULL, confirmed_at = NOW() WHERE id = ?')->execute([$user_id]);
	$_SESSION['flash']['success'] = 'Votre compte a bien été validé.';
	$_SESSION['auth'] = $user;
	header('Location: account.php'); 
}
else{
	$_SESSION['flash']['danger'] = "Ce token n'est plus valide";
	header('Location: login.php');
}*/

 