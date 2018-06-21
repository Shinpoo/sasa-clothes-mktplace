<?php 
$db = App::getDatabase();
$panier = App::getPanier();
?>
<!-- Main -->
					<div id="main">
						<div class="inner">
							<header>
								<h1>NOS DERNIERS DROPS</h1>
								
							</header>
							<section class="tiles">

								<?php $products = $db->query('SELECT * FROM products')->fetchAll(); ?>
								<?php $durationArray= []; ?>
								<?php foreach ($products as $product): ?>
								<?php $durationArray[$product->id] = strtotime($product->dropDate) - (time() + 7200 ); ?>
								<article class="style1">
									<span class="image">
										<img src="images/<?= $product->image;?>.jpg" alt="<?= $product->image;?>" />
									</span>
									<a href="detail/detail.php?id=<?=$product->id;?>">
										<h2><?= $product->name;?> </h2>
										<div class="content">
											<p><?= $product->price;?>€</p>
											<?php if($durationArray[$product->id]/3600 > 24): ?>
											<h2><?= date("d/m/Y", strtotime($product->dropDate)); ?></h2>
											<?php elseif ($durationArray[$product->id] < 0):  ?>
											<?php $db->query('UPDATE products SET onSale = ? WHERE id = ?',[1, $product->id]); ?>
											<h2 id="name_<?php echo $product->id; ?>" >  </h2>			
											<?php else: ?>
											<h2 id="name_<?php echo $product->id; ?>" >  </h2>
											<?php endif; ?>
											
										</div>
									</a>
								</article>
								<?php endforeach ?>
								<p style="margin-top: 60px">Les drops présents ne sont disponibles qu'en un exemplaire, il faudra attendre plusieurs mois pour en revoir un identique. Premiers arrivés, premiers servis !</p>
								<a href="../accueil.php" id ="logo"><img src="../images/logo.png"></a>
								
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
								            display.textContent = "AVAILABLE";
								        }
								    }, 1000);
								}
								
								window.onload = function () {
								    
								    <?php foreach ($durationArray as $prodid =>$duration_time): ?>
								    	var duration = <?= $duration_time;?>,
								        display = document.querySelector("#name_<?php echo $prodid; ?>");
								        startTimer(duration, display);
								    <?php endforeach ?>
								    
								};
									
								</script>

								
								<!-- <script type="text/javascript">
									$('[data-countdown]').each(function() {
										var $this = $(this), finalDate = $(this).data('countdown');
									    $this.countdown(finalDate, function(event) {
									    	$this.html(event.strftime('%D days %H:%M:%S'));
									  });
									});
								</script>
 -->								
								<!-- <article class="style2">
									<span class="image">
										<img src="images/pic02.jpg" alt="" />
									</span>
									<a href="generic.html">
										<h2>Lorem</h2>
										<div class="content">
											<p>Sed nisl arcu euismod sit amet nisi lorem etiam dolor veroeros et feugiat.</p>
										</div>
									</a>
								</article>
								<article class="style3">
									<span class="image">
										<img src="images/pic03.jpg" alt="" />
									</span>
									<a href="generic.html">
										<h2>Feugiat</h2>
										<div class="content">
											<p>Sed nisl arcu euismod sit amet nisi lorem etiam dolor veroeros et feugiat.</p>
										</div>
									</a>
								</article>
								<article class="style4">
									<span class="image">
										<img src="images/pic04.jpg" alt="" />
									</span>
									<a href="generic.html">
										<h2>Tempus</h2>
										<div class="content">
											<p>Sed nisl arcu euismod sit amet nisi lorem etiam dolor veroeros et feugiat.</p>
										</div>
									</a>
								</article>
								<article class="style5">
									<span class="image">
										<img src="images/pic05.jpg" alt="" />
									</span>
									<a href="generic.html">
										<h2>Aliquam</h2>
										<div class="content">
											<p>Sed nisl arcu euismod sit amet nisi lorem etiam dolor veroeros et feugiat.</p>
										</div>
									</a>
								</article>
								<article class="style6">
									<span class="image">
										<img src="images/pic06.jpg" alt="" />
									</span>
									<a href="generic.html">
										<h2>Veroeros</h2>
										<div class="content">
											<p>Sed nisl arcu euismod sit amet nisi lorem etiam dolor veroeros et feugiat.</p>
										</div>
									</a>
								</article>
								<article class="style2">
									<span class="image">
										<img src="images/pic07.jpg" alt="" />
									</span>
									<a href="generic.html">
										<h2>Ipsum</h2>
										<div class="content">
											<p>Sed nisl arcu euismod sit amet nisi lorem etiam dolor veroeros et feugiat.</p>
										</div>
									</a>
								</article>
								<article class="style3">
									<span class="image">
										<img src="images/pic08.jpg" alt="" />
									</span>
									<a href="generic.html">
										<h2>Dolor</h2>
										<div class="content">
											<p>Sed nisl arcu euismod sit amet nisi lorem etiam dolor veroeros et feugiat.</p>
										</div>
									</a>
								</article>
								<article class="style1">
									<span class="image">
										<img src="images/pic09.jpg" alt="" />
									</span>
									<a href="generic.html">
										<h2>Nullam</h2>
										<div class="content">
											<p>Sed nisl arcu euismod sit amet nisi lorem etiam dolor veroeros et feugiat.</p>
										</div>
									</a>
								</article>
								<article class="style5">
									<span class="image">
										<img src="images/pic10.jpg" alt="" />
									</span>
									<a href="generic.html">
										<h2>Ultricies</h2>
										<div class="content">
											<p>Sed nisl arcu euismod sit amet nisi lorem etiam dolor veroeros et feugiat.</p>
										</div>
									</a>
								</article>
								<article class="style6">
									<span class="image">
										<img src="images/pic11.jpg" alt="" />
									</span>
									<a href="generic.html">
										<h2>Dictum</h2>
										<div class="content">
											<p>Sed nisl arcu euismod sit amet nisi lorem etiam dolor veroeros et feugiat.</p>
										</div>
									</a>
								</article>
								<article class="style4">
									<span class="image">
										<img src="images/pic12.jpg" alt="" />
									</span>
									<a href="generic.html">
										<h2>Pretium</h2>
										<div class="content">
											<p>Sed nisl arcu euismod sit amet nisi lorem etiam dolor veroeros et feugiat.</p>
										</div>
									</a>
								</article> -->
							</section>
						</div>
					</div>

