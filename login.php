<?php
require 'bootstrap.php';
$auth = App::getAuth();
$auth->logged_restrict();
$db = App::getDatabase();
$auth->connectFromCookie($db);

if($auth->user()){
	App::redirect('account.php');
}
if( !empty($_POST) && !empty($_POST['email']) && !empty($_POST['password']) ){
	$user = $auth->login($db, $_POST['email'], $_POST['password'], isset($_POST['remember']));
	$session = Session::getInstance();
	if($user){
		$session->setFlash('success','Vous êtes maintenant connecté');
		App::redirect('account.php');
	}else{
		$session->setFlash('danger','Email ou mot de passe incorrect');
		$errors['connexion'] = 'Email ou mot de passe incorrect';
	}
}else{
	if( !empty($_POST) ){
		$errors['connexion'] = 'Veuillez remplir le formulaire';
	}
}
?>

<?php require 'header.php'; ?>
			<section id="contact" class="main style3 secondary">
				<div class="content">
					<header class = "aboveform">
						<h2>Connectez-vous</h2>
						<p><a href="register.php">S'inscrire</a></p>
					</header>

					<?php if(!empty($errors)): ?>
					<div class="alert-danger">
						<ul>
							<?php foreach ($errors as $error): ?> 
								<li> <?= $error; ?></li>
							<?php endforeach; ?>
						</ul>
					</div> 
					<?php endif; ?>

					<div class="box">
						<form method="post" action="">
							<div class="field"><input type="email" name="email" placeholder="Email" required /></div>

							<div class="field"><input type="password" name="password" placeholder="Mot de Passe" required/></div>	
							<p><a href="forget.php">Mot de passe oubié</a></p>
							<label>
							<div class="field"><input type="checkbox" name="remember" value="1"/>Se souvenir de moi</div>
							</label>

							<ul class="actions" href="#">
								<li><input type="submit" value="Connexion" /></li>
							</ul>
						</form>
					</div>
				</div>
			</section>
<?php require 'footer.php'; ?>