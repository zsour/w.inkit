<?php
require_once("vendor/autoload.php");
$gateway = new Braintree\Gateway([
    'environment' => 'sandbox', 
    'merchantId' => 'pftgdppv75qtpnd2',
    'publicKey' => 'wrb5knxzv4hp8ggd',
    'privateKey' => '7802072098f46c7078ef5a6da8f6d650'
]);

?>