<?php 
require '../../bootstrap.php';
if(isset($_GET['id'])){
	$db = App::getDatabase();
	$product = $db->query('SELECT * FROM products WHERE id = ? AND onSale = ?',[$_GET['id'], 1])->fetch();
	if(!$product){
		Session::getInstance()->setFlash('danger','Page inaccessible');
		App::redirect('../boutique.php');
	}else{
		$panier = App::getPanier();
		$panier->add($product->id);
		App::redirect('../../monpanier.php');

	}
}else{
	Session::getInstance()->setFlash('danger','Page inaccessible');
	App::redirect('../boutique.php');
}
?>
