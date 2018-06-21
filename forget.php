<?php
	require 'bootstrap.php';
	App::getAuth()->logged_restrict();

	if(!empty($_POST) && !empty($_POST['email'])){
		$db = App::getDatabase();
		$auth = App::getAuth();
		$session = Session::getInstance();
		if($auth->resetPassword($db, $_POST['email'])){
			$session->setFlash('success','Consultez votre email pour réinitialiser votre mot de passe');
			App::redirect('login.php');
		}else{
			$session->setFlash('danger','Aucun compte ne correspond à cet adresse email');
		}
}
?>

<?php require 'header.php'; ?>
			<section id="contact" class="main style3 secondary">
				<div class="content">
					<header class="aboveform"> 
						<h2>Mot de passe oublié</h2>
					</header>

					<div class="box">
						<form method="post" action="">
							<div class="field"><input type="email" name="email" placeholder="Email" required /></div>
							<ul class="actions" href="#">
								<li><input type="submit" value="Envoyer un mail" /></li>
							</ul>
						</form>
					</div>
				</div>
			</section>
<?php require 'footer.php'; ?>