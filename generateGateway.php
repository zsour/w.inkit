<?php
require_once("vendor/autoload.php");
$gateway = new Braintree\Gateway([
    'environment' => 'sandbox', //Ändra från sandbox vid live.
    'merchantId' => 'rjnzm5ktvgq4scrx',
    'publicKey' => 'v67j73yhh6yn5jgn',
    'privateKey' => '8a769082e7697c019bd2aff71b0acae2'
]);

?>