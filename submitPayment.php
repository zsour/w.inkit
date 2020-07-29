<?php

    require_once("includes/init.php");
    require_once("classes/DB.php");
    require_once("classes/Config.php");
    require_once("classes/Session.php");

    require_once("vendor/autoload.php");
    require_once("generateGateway.php");
   

    if(!isset($_POST['order_id'])){
      unset($_SESSION['order_id']);
      header('Location: cart.php'); 
    }

    $db = DB::getInstance();
    $order = $db->findFirst('orders', [
        'conditions' => "unique_id = ?",
        'bind' => [$_POST['order_id']]
    ]);


    if(!$order || empty($_POST['deviceData']) || $order->paid == 1){
      unset($_SESSION['order_id']);
      header('Location: cart.php');  
    }else{
        $cart = json_decode($order->cart);
        $totalAmount = 0;

        foreach($cart as $product){
            $productQuery = $db->findFirst('products', [
                'conditions' => "id = ?",
                'bind' => [$product->id]
            ]);

            if(!$productQuery){
                unset($_SESSION['order_id']);
                header('Location: cart.php');  
            }else{
                $totalAmount += ($product->quantity * $productQuery->price);
            }
        }


        $result = $gateway->transaction()->sale([
            'amount' => $totalAmount,
            'paymentMethodNonce' => $_POST['nonce'],
            'deviceData' => $_POST['deviceData'],
            'options' => [
              'submitForSettlement' => True
            ]
          ]);
        

          if ($result->success) {
            date_default_timezone_set("Europe/Stockholm");
            $date = date('Y/m/d H:i:s', time());

            DB::getInstance()->update('orders', $order->id, array(
                'paid' => 1,
                'braintree_id' => $result->transaction->id,
                'payment_date' => $date
            ));
              unset($_SESSION['cart']);;
              header('Location: thankyou.php');

          }else {
            header('Location: payment?error=1');  
          }
    }

    
    
?>