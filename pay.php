<?php
require 'vendor/autoload.php';
require 'bootstrap.php';
$ids = require('paypal.php');

$apicontext = new \PayPal\Rest\ApiContext(
	new \PayPal\Auth\OAuthTokenCredential(
		$ids['id'],
		$ids['secret']
	)
);

$panier = App::getPanier();
$payment = \PayPal\Api\Payment::get($_POST['paymentID'], $apicontext);

$execution = (new \PayPal\Api\PaymentExecution())
	->setPayerId($_POST['payerID'])
	/*->setTransactions($payment->getTransactions());*/
	->addTransaction(TransactionFactory::fromPanier($panier,0.2));

try{
	$payment->execute($execution, $apicontext);
	/*var_dump($payment->getTransactions()[0]->getCustom());
	var_dump($payment);*/
	echo json_encode([
		'id' => $payment->getId()
	]);
} catch(\PayPal\Exception\PayPalConnectionException $e){
	header('HTTP 500 Internal Server Error',true,500);
	var_dump(json_decode( $e->getData() ) );
}