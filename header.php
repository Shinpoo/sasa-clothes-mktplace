
<!DOCTYPE HTML>

<html>
	<head>
		<title>(-o")-o</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />

		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		 <script src="https://www.paypalobjects.com/api/checkout.js"></script>

	</head>
	<body>

		<!-- Header -->
			<header id="header">
				<h1><a href="accueil.php">K R Y P T O N</a></h1>
				<nav>
					<ul>
						<?php if(App::getAuth()->user()): ?>
							<li><a href="logout.php">Déconnexion</a></li>
							<li><a href="profil.php">Profil</a></li>
						<?php else: ?>
							<li><a href="register.php">Créer un compte</a></li>
							<li><a href="login.php">Se connecter</a></li>
						<?php endif; ?>
						<li><a href="boutique/boutique.php">Collection</a></li>
						<li> <a href="monpanier.php">
							<img class = "iconepanier" src="images/panier.png" style="vertical-align:middle" height ="28" href="monpanier.php">
							</a>
						</li>
						<!-- <a href="monpanier.php">Panier</a> -->
<!-- 						<li><a href="#work">Black Box</a></li>
						<li><a href="#work">Ventes Flash</a></li>
						<li><a href="#contact">Contact</a></li> -->
					</ul>
				</nav>
			</header>
			<a href="boutique/boutique.php" id ="logo"><img src="images/logo.png"></a>

			
		<?php if(Session::getInstance()->hasFlashes()): ?>
			<?php foreach(Session::getInstance()->getFlashes() as $type => $message): ?>
				<div class="alert-<?= $type; ?>">
					<?= $message; ?>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>