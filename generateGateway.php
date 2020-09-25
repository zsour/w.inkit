<?php
require_once("vendor/autoload.php");
$gateway = new Braintree\Gateway([
    'environment' => 'production', 
    'merchantId' => '',
    'publicKey' => '',
    'privateKey' => ''
]);

?>