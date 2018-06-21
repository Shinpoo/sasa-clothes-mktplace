<?php 
require'bootstrap.php';
require'header.php';
$session = Session::getInstance();
$panier = App::getPanier();
$paniervide = false;
if(isset($_GET['del'])){
	$panier->del($_GET['del']);
}
if($session->read('panier')){
	$products = $panier->getProducts();
/*	$ids = array_keys($session->read('panier'));
	$ids = implode(", ", $ids);
	$products = $db->query("SELECT * FROM products WHERE id IN ($ids)")->fetchAll();*/
	$sous_total = $panier->total();
}else{
	$paniervide = true;
	$sous_total = 0;
}
?>

<section id="introPanier" class="main style1 dark fullscreen">

				<div class="contentPanier">
					<header id = "BigTitlePanier">
						<p>MON PANIER (<?=App::getPanier()->count();?>)</p>
					</header>

					<?php if(!$paniervide): ?>
						<?php foreach ($products as $product): ?>
						<div class = "articlepanier">
							<!-- <div class ="imagepanier"></div> -->
							<div class="panierbloc1 ">
								<img class = "imagepanier" src="boutique/images/<?=$product->image;?>.jpg">
							</div>
							<div class='panierbloc2'>
								<h1 class="titlearticlepanier"><?=$product->name;?></h1>
								<ul>
  									<li><?=$product->price;?>€</li>
  									<li>Taille: <?=$product->size;?></li>
 									<li>Couleur: <?=$product->color;?></li>
								</ul> 
							</div>
							<div class="panierbloc3">
								<div class = "mybutton">
								<a href="monpanier.php?del=<?=$product->id;?>" class="mybutton">RETIRER DU PANIER</a>
								</div>

							</div>
							
						</div>
						<?php endforeach ?>

					<?php else: ?>
						<div id = "BigTitlePanier">
							<p style="font-size: 15px">Votre panier est actuellement vide. <a href ="login.php" style = "text-decoration: underline">Connectez-vous </a> pour consulter votre panier et commencez vos achats !</p>
						</div>
					<?php endif; ?>

				<!-- 	<div class = "articlepanier">
					<a href="#work">PROMOS</a>
					</div>
					<div class = "articlepanier">
					<a href="boutique/index.html">COLLECTION</a>
					</div> -->
					<!-- <footer>
						<a href="#one" class="button style2 down">More</a>
					</footer> -->
				
				</div>
				<div class = "paiement">
					<div class="flexlign">
						<div id="paiementLeft">RECAPITULATIF</div>
					</div>
					<div class="flexlign">
						<div id="paiementLeft">Sous-total</div>
						<div id="paiementRight"><?=$sous_total;?>€</div>
					</div>
					<div class="flexlign">
						<div id="paiementLeft">Frais de livraison</div>
					</div>
					<div class="flexlign">
						<div id="paiementLeft">TOTAL</div>
					</div>
				<?php if(!$paniervide): ?>
					<div class = "flexlignpp">
						<div  id = "paypal-button"></div>
					</div>
				</div>
				<?php endif; ?>


			</section>

	<script>
	    paypal.Button.render({
	      env: 'sandbox', // Or 'sandbox','production'

	      commit: true, // Show a 'Pay Now' button
	      locale: 'fr_FR',
	      style: {
	        color: 'gold',
	        size: 'large',
	        label: 'pay',
	        tagline: 'false',
	        shape: 'pill'
	        // 
	      },

	      payment: function() {
	      		return paypal.request.post('payment.php').then(function(data){
	      			return data.id;
	      		});
	      },

	      onAuthorize: function(data, actions) {
	      		return paypal.request.post('pay.php', {
	      			paymentID: data.paymentID,
	      			payerID: data.payerID
	      		}).then(function(data){
	      			console.log(data)
	      			alert('Votre commande a bien été effectuée.')
	    		}).catch(function(err){
	    			console.log('erreur', err)
	      });/* ,

	      onCancel: function(data, actions) {
	      },

	      onError: function(err) {
	      }*/

	     }  
	    }, '#paypal-button');
	  </script>
			


<?php require'footer.php'; ?>