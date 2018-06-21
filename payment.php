<?php
require 'bootstrap.php';
require 'vendor/autoload.php';
$ids = require('paypal.php');
$panier = App::getPanier();

$apicontext = new \PayPal\Rest\ApiContext(
	new \PayPal\Auth\OAuthTokenCredential(
		$ids['id'],
		$ids['secret']
	)
);
		

$payment = new \PayPal\Api\Payment();
/*$payment->setTransactions([$transaction]);
*/
$payment->addTransaction(TransactionFactory::fromPanier($panier));
$payment->setIntent('sale');
$redirectUrls = (new \PayPal\Api\RedirectUrls())
	->setReturnUrl('http://localhost/sasa/pay.php')
	->setCancelUrl('http://localhost/sasa/monpanier.php');
$payment->setRedirectUrls($redirectUrls);
$payment->setPayer((new \PayPal\Api\Payer())->setPaymentMethod('paypal'));

try{
	$payment->create($apicontext);
	echo json_encode([
		'id' => $payment->getId()
	]);
	// App::redirect($payment->getApprovalLink());
} catch(\PayPal\Exception\PayPalConnectionException $e){
	var_dump(json_decode( $e->getData() ) );
}
/*$payment = new \PayPal\Api\Payment('{
  "intent": "sale",
  "redirect_urls":
  {
    "return_url": "https://example.com",
    "cancel_url": "https://example.com"
  },
  "payer":
  {
    "payment_method": "paypal"
  },
  "transactions": [
  {
    "amount":
    {
      "total": "4.00",
      "currency": "USD",
      "details":
      {
        "subtotal": "2.00",
        "shipping": "1.00",
        "tax": "2.00",
        "shipping_discount": "-1.00"
      }
    },
    "item_list":
    {
      "items": [
      {
        "quantity": "1",
        "name": "item 1",
        "price": "1",
        "currency": "USD",
        "description": "item 1 description",
        "tax": "1"
      },
      {
        "quantity": "1",
        "name": "item 2",
        "price": "1",
        "currency": "USD",
        "description": "item 2 description",
        "tax": "1"
      }]
    },
    "description": "The payment transaction description.",
    "invoice_number": "merchant invoice",
    "custom": "merchant custom data"
  }]
}');*/



/*var_dump($payment);
*/
