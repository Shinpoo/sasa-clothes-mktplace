<?php

class Panier
{

	private $session;
	private $db;

	public function __construct($session, $db){
		$this->session = $session;
		$this->session->createPanier();
		$this->db = $db;
	}

	public function add($product_id){
		$this->session->write2keys('panier',$product_id,1);
	}

	public function del($product_id){
		$this->session->del2keys('panier',$product_id);
	}

	public function total(){
		$total = 0;
		$products = $this->getProducts();
		foreach ($products as $product){
			$total += $product->price;
		}
		return $total;	
	}


	public function count(){
		return array_sum($this->session->read('panier'));
	}

	public function getProducts(){
		$ids = array_keys($this->session->read('panier'));
		$ids = implode(", ", $ids);
		$products = $this->db->query("SELECT * FROM products WHERE id IN ($ids)")->fetchAll();
		return $products;
	}

	public function getVatPrice($rate){
		return round($this->total()*$rate*100)/100;
	}
}