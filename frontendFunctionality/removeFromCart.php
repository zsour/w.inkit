<?php
    require_once("../includes/init.php");
    require_once("../classes/CartEvent.php");
    require_once("../classes/Session.php");

    $productId = isset($_POST['product_id']) ? $_POST['product_id'] : null;

    if(isset($productId)){
        CartEvent::removeFromCart($productId, 1);
        header('Location: ../cart');
    }
?>