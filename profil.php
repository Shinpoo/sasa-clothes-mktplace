<?php 
require_once 'bootstrap.php';
$auth = App::getAuth();
$auth->restrict();

if (!empty($_POST)){

	$session = Session::getInstance();
	$validator = new Validator($_POST);
	$validator->isConfirmed('password', 'Les mots de passe ne correspondent pas');
	if($validator->isValid()){
	/*if((empty($_POST['password'])) || ($_POST['password'] != $_POST['password_confirm'])){*/
		/*$session->setFlash('danger','Les mots de passe ne correspondent pas');*/
/*		$_SESSION['flash']['danger'] = 'Les mots de passe ne correspondent pas';
*/	
/*		$user_id = $_SESSION['auth']->ID;
*/		$user_id = $auth->user()->ID;
		$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

		App::getDatabase()->query('UPDATE users SET Password = ? WHERE ID = ?',[$password, $user_id]);
/*		$_SESSION['flash']['success'] = 'Votre mot de passe a bien été modifié';
*/		$session->setFlash('success','Votre mot de passe a bien été modifié');

		App::redirect('account.php');
	}else{
		$session->setFlash('danger','Les mots de passe ne correspondent pas');
	}
}

require 'header.php';

?>
			








			<section id="contact" class="main style3 secondary">
				<div class="content">
					<<header class="aboveform">
						<h2>Modifier le Mot de passe</h2>
					</header>

					<div class="box">
						<form method="post" action="">
							<div class="field"><input type="password" name="password" placeholder="Nouveau mot de passe" required/></div>

							<div class="field"><input type="password" name="password_confirm" placeholder="Confirmez le nouveau mot de passe" required/></div>	
							<ul class="actions" href="#">
								<li><input type="submit" value="Valider les modifications" /></li>
							</ul>
						</form>
					</div>
				</div>
			</section>
<?php require 'footer.php'; ?>