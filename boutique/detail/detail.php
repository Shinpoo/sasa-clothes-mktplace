<?php require '../../bootstrap.php';?>
<?php if(isset($_GET['id'])){
	$db = App::getDatabase();
	$product = $db->query('SELECT * FROM products WHERE id = ?',[$_GET['id']])->fetch();
	if(!$product){
		Session::getInstance()->setFlash('danger','Page inaccessible');
		App::redirect('../boutique.php');
	}
}else{
	Session::getInstance()->setFlash('danger','Page inaccessible');
	App::redirect('../boutique.php');
}
?>
<!DOCTYPE HTML>
<!--
	Lens by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title><?=$product->name;?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-loading-0 is-loading-1 is-loading-2">

		<!-- Main -->
			<div id="main">

				<!-- Header -->
					<header id="header">
						<h1><?=$product->name;?></h1>
						<h2><?=$product->price;?>€</h2>
						<h5>TAILLE: <?=$product->size;?></h5>
						<h5>COULEUR: <?=$product->color;?></h5>
						<?php $duration_time = strtotime($product->dropDate) - (time() + 7200 ); ?>
						<?php if($duration_time/3600 > 24): ?>
						<h1><?= date("d/m/Y", strtotime($product->dropDate)); ?></p>
						<?php elseif ($duration_time < 0):  ?> <!-- Available -->
						<?php $db->query('UPDATE products SET onSale = ? WHERE id = ?',[1, $product->id]); ?>
						<a href="addpanier.php?id=<?=$product->id;?>" class="button">AJOUTER AU PANIER</a>							
						<?php else: ?> <!-- 1 day  -> animation -->
						<h1 id ="timer"></h1>
						<?php endif; ?>

						

					
					</header>

				<!-- Thumbnail -->
					<section id="thumbnails">
						<article>
							<a class="thumbnail" href="../images/<?=$product->image;?>.jpg"><img src="../images/<?=$product->image;?>.jpg" alt="" /></a>
							<!-- <h2>Diam tempus accumsan</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
						</article>
						 <article>
							<a class="thumbnail" href="../images/<?=$product->imageDetail1;?>.jpg"><img src="../images/<?=$product->imageDetail1;?>.jpg" alt="" /></a>
						</article>
						<article>
							<a class="thumbnail" href="../images/<?=$product->imageDetail1;?>.jpg"><img src="../images/<?=$product->imageDetail1;?>.jpg" alt="" /></a>
						</article>
						<article>
							<a class="thumbnail" href="../images/<?=$product->imageDetail1;?>.jpg"><img src="../images/<?=$product->imageDetail1;?>.jpg" alt="" /></a>
						</article>
						<!--
						<article>
							<a class="thumbnail" href="images/fulls/03.jpg" data-position="top center"><img src="images/thumbs/03.jpg" alt="" /></a>
							<h2>Nec accumsan enim felis</h2>
							<p>Maecenas eleifend tellus ut turpis eleifend, vitae pretium faucibus.</p>
						</article>
						<article>
							<a class="thumbnail" href="images/fulls/04.jpg"><img src="images/thumbs/04.jpg" alt="" /></a>
							<h2>Donec maximus nisi eget</h2>
							<p>Tristique in nulla vel congue. Sed sociis natoque parturient nascetur.</p>
						</article>
						<article>
							<a class="thumbnail" href="images/fulls/05.jpg" data-position="top center"><img src="images/thumbs/05.jpg" alt="" /></a>
							<h2>Nullam vitae nunc vulputate</h2>
							<p>In pellentesque cursus velit id posuere. Donec vehicula nulla.</p>
						</article>
						<article>
							<a class="thumbnail" href="images/fulls/06.jpg"><img src="images/thumbs/06.jpg" alt="" /></a>
							<h2>Phasellus magna faucibus</h2>
							<p>Nulla dignissim libero maximus tellus varius dictum ut posuere magna.</p>
						</article>
						<article>
							<a class="thumbnail" href="images/fulls/07.jpg"><img src="images/thumbs/07.jpg" alt="" /></a>
							<h2>Proin quis mauris</h2>
							<p>Etiam ultricies, lorem quis efficitur porttitor, facilisis ante orci urna.</p>
						</article>
						<article>
							<a class="thumbnail" href="images/fulls/08.jpg"><img src="images/thumbs/08.jpg" alt="" /></a>
							<h2>Gravida quis varius enim</h2>
							<p>Nunc egestas congue lorem. Nullam dictum placerat ex sapien tortor mattis.</p>
						</article>
						<article>
							<a class="thumbnail" href="images/fulls/09.jpg"><img src="images/thumbs/09.jpg" alt="" /></a>
							<h2>Morbi eget vitae adipiscing</h2>
							<p>In quis vulputate dui. Maecenas metus elit, dictum praesent lacinia lacus.</p>
						</article>
						<article>
							<a class="thumbnail" href="images/fulls/10.jpg"><img src="images/thumbs/10.jpg" alt="" /></a>
							<h2>Habitant tristique senectus</h2>
							<p>Vestibulum ante ipsum primis in faucibus orci luctus ac tincidunt dolor.</p>
						</article>
						<article>
							<a class="thumbnail" href="images/fulls/11.jpg"><img src="images/thumbs/11.jpg" alt="" /></a>
							<h2>Pharetra ex non faucibus</h2>
							<p>Ut sed magna euismod leo laoreet congue. Fusce congue enim ultricies.</p>
						</article>
						<article>
							<a class="thumbnail" href="images/fulls/12.jpg"><img src="images/thumbs/12.jpg" alt="" /></a>
							<h2>Mattis lorem sodales</h2>
							<p>Feugiat auctor leo massa, nec vestibulum nisl erat faucibus, rutrum nulla.</p>
						</article> -->


					</section>
					<a href="../boutique.php" id ="croix"></a>

				<!-- Footer -->
					<footer id="footer">
						<ul class="icons">
							<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
							<li><a href="#" class="icon fa-facebook"><span class="label">Github</span></a></li>
							<li><a href="#" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
						</ul>
						<ul class="copyright">
							<li>&copy; 2018 KRYPTON. Tous droits réservés.</li>
						</ul>
					</footer>

			</div>

		<!-- Scripts -->
			<script>
				function startTimer(duration, display) {
				    var timer = duration, minutes, seconds;
				    setInterval(function () {
				    	hours = parseInt(timer / 3600, 10)
				        minutes = parseInt((timer % 3600)/60, 10)
				        seconds = parseInt(timer % 60, 10);
						
						hours = hours < 10 ? "0" + hours : hours;
				        minutes = minutes < 10 ? "0" + minutes : minutes;
				        seconds = seconds < 10 ? "0" + seconds : seconds;
				
				        display.textContent = hours + ":" + minutes + ":" + seconds;
				
				        if (--timer < 0) {
							location.reload();
				        }
				    }, 1000);
				}
				
				window.onload = function () {
				    
				    	var duration = <?= $duration_time;?>,
				        display = document.querySelector("#timer");
				        startTimer(duration, display);
				    
				};
					
			</script>
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>