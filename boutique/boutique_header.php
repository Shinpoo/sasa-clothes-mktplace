<!DOCTYPE HTML>
<!--
	Phantom by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Krypton Boutique</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body>
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<div class="inner">

							<!-- Logo -->
								<!-- <a href="../accueil.php" class="logo">
									<span class="symbol"><img src="../images/logo.png" alt="" /></span><span class="title">KRYPTON</span>
								</a> -->

							<!-- Nav -->
								<nav>
									<ul>
										<li><a href="#menu">Menu</a></li>
									</ul>
								</nav>

						</div>
					</header>

				<!-- Menu -->
					<nav id="menu">
						<h2>Menu</h2>
						<ul>
							<?php if(App::getAuth()->user()): ?>
								<li><a href="../logout.php">Déconnexion</a></li>
								<li><a href="../profil.php">Profil</a></li>
							<?php else: ?>
								<li><a href="../register.php">Créer un compte</a></li>
								<li><a href="../login.php">Connexion</a></li>
							<?php endif; ?>
							<li><a href="../monpanier.php">Panier</a></li>
							
							<li><a href="#footer">Contact</a></li>
							<!-- <li><a href="generic.html">Consequat dolor</a></li>
							<li><a href="elements.html">Elements</a></li> -->
						</ul>
					</nav>



				








				