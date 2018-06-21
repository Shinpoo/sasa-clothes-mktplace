<?php
class TransactionFactory{
	static function fromPanier(Panier $panier,$vatRate = 0){
		$list = new \PayPal\Api\ItemList();
		foreach ($panier->getProducts() as $product) {
			$item = (new \PayPal\Api\Item())
				->setName($product->name)
				->setPrice($product->price)
				->setCurrency('EUR')
				->setQuantity(1);
			$list->addItem($item);	  
		}

		$details = (new \PayPal\Api\Details())
			->setTax($panier->getVatPrice($vatRate))
			->setSubtotal($panier->total());

		$amount = (new \PayPal\Api\Amount())
			->setTotal($panier->total() + $panier->getVatPrice($vatRate))
			->setCurrency("EUR")
			->setDetails($details);

		/*$transaction =*/ 
		return (new \PayPal\Api\Transaction())
			->setItemList($list)
			->setDescription("Achat sur Krypton")
			->setAmount($amount)
			->setCustom("demo-1"); // clef perso : id de commande, id du user etc
	}
}