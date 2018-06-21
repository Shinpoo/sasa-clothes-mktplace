<?php
require 'bootstrap.php';

/*	if(isset($_GET['ID']) && isset($_GET['token'])){
		$auth = App::getAuth();
		$db = App::getDatabase();
		if($auth->changeResetToken($db, $_GET['ID'], $_GET['token'])) {
			if (!empty($_POST)){
				Session::getInstance()->setFlash('success','Token valide'); 
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
					$user_id = $_GET['ID'];
					$token = $_GET['token'];
					App::redirect('confirm.php?id=$user_id&token=$token');
				}
			}
		}
		else{
			Session::getInstance()->setFlash('danger','Lien expiré: reset token invalide');
			App::redirect('login.php');
		}
	}
	else{
		App::redirect('accueil.php'); //page introuvable - lien modif manuellement
	}*/
/*$db = App::getDatabase();
$validate_once = false;
if(App::getAuth()->confirmResetToken($db, $_GET['id'], $_GET['token']) || $validate_once == true) {
	Session::getInstance()->setFlash('success',"conf token valide");
	$validate_once = true;
	if(!empty($_POST['password']) && !empty($_POST['password_confirm']) ){
		$validator = new Validator($_POST);
		$validator->isConfirmed('password', 'Mot de passe invalide');
		$password = App::getAuth()->hashPassword($_POST['password']);
		if($validator->isValid()){
				Session::getInstance()->setFlash('success','Votre mot de passe a bien été modifié');
				App::getAuth()->connect($user); 
				App::redirect('account.php');
		}else{
			Session::getInstance()->setFlash('danger','Mot de passe invalide');
			App::redirect('accueil.php');
		}		
	}
}
else{
	Session::getInstance()->setFlash('danger',"Lien de confirmation expiré: conf token invalide");
	App::redirect('login.php');
}*/

if(isset($_GET['id']) && isset($_GET['token'])){
	$db = App::getDatabase();
    $user = $db->query('SELECT * FROM users WHERE ID = ? AND reset_token IS NOT NULL AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)',[$_GET['id'], $_GET['token']])->fetch(); //putin de fetch -> 2jours
    if($user){
        if(!empty($_POST)){
            if(!empty($_POST['password']) && $_POST['password'] == $_POST['password_confirm']){
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $db->query('UPDATE users SET password = ?, reset_at = NULL, reset_token = NULL',[$password]);
                Session::getInstance()->setFlash('success','Votre mot de passe a bien été modifié');
                Session::getInstance()->write('auth', $user);
                App::redirect('account.php');
            }else{Session::getInstance()->setFlash('danger','Mot de passe invalide');}
        }
    }else{
        Session::getInstance()->setFlash('success',"Ce token n'est pas valide");
        App::redirect('login.php');
    }
}else{
    App::redirect('accueil.php');
}

?>

<?php require 'header.php'; ?>
			<section id="contact" class="main style3 secondary">
				<div class="content">
					<header class="aboveform">
						<h2>Réinitialisation du mot de passe</h2>
						<p>Choisissez un mot de passe</p>
					</header>

					<div class="box">
						<form method="post" action="">
							<div class="field"><input type="password" name="password" placeholder="Mot de Passe" /></div>

							<div class="field"><input type="password" name="password_confirm" placeholder="Confirmation du mot de asse" /></div>	
							<ul class="actions" href="#">
								<li><input type="submit"  value="Réinitialiser votre mot de passe" /></li>
							</ul>
						</form>
					</div>
				</div>
			</section>

















<?php require 'footer.php'; ?>