<?php
     require_once("../../includes/init.php");
     require_once("../../classes/DB.php");
     require_once("../../classes/Config.php");
     require_once("../../classes/Validate.php");
     require_once("../../classes/Session.php");
     require_once("../../classes/User.php");
     require_once("../../generateGateway.php"); 

     $db = DB::getInstance();
     $user = new User();

     if($user->isLoggedIn() && isset($_POST['oldPrice']) && isset($_POST['oldQuantity']) && isset($_POST['newQuantity']) && isset($_POST['orderId']) && isset($_POST['productId'])){
        
        $amountToRemove = ($_POST['oldQuantity'] - $_POST['newQuantity']);
        $amountToRefund = $amountToRemove * $_POST['oldPrice'];

        $currentProduct = DB::getInstance()->findFirst('products', array(
            'conditions' => 'id = ?',
            'bind' => [$_POST['productId']]
        ));
        $currentOrder = DB::getInstance()->findFirst('orders', array(
            'conditions' => 'id = ?',
            'bind' => [$_POST['orderId']]
        ));

        
           $result = $gateway->transaction()->refund($currentOrder->braintree_id, $amountToRefund);
            
            if($result->success){
                $oldCart = json_decode($currentOrder->cart);
                foreach($oldCart as $key => $item){
                    if($item->id == $currentProduct->id){
                        if($_POST['newQuantity'] == 0){
                            print_r($key);
                                unset($oldCart[$key]);
                            break;
                        }else{
                            $item->quantity = (int)$_POST['newQuantity'];
                        }   
                    }
                }
                $newCart = [];
                foreach($oldCart as $item){
                    array_push($newCart, $item);
                }

                DB::getInstance()->update('orders', $currentOrder->id, array(
                    'cart' => json_encode($newCart)
                ));

                if($currentOrder->refunded){
                    $temp = json_decode($currentOrder->refunded);
                    $existsInArray = false;
                    foreach($temp as $key => $item){
                        if($item->id == $_POST['productId']){
                            $existsInArray = true;
                            $item->quantity += $amountToRemove;
                        }
                    }

                    if($existsInArray){
                        DB::getInstance()->update('orders', $currentOrder->id, array(
                            'refunded' => json_encode($temp)
                        ));

                        header('Location: ../all-orders.php');
                    }else{
                        array_push($temp, array(
                            'id' => $_POST['productId'],
                            'quantity' => $amountToRemove,
                            'priceDuringOrder' => $_POST['oldPrice']
                        ));

                        DB::getInstance()->update('orders', $currentOrder->id, array(
                            'refunded' => json_encode($temp)
                        ));

                        header('Location: ../all-orders.php');
                    }
                }else{
                    $temp = [[
                        'id' => $_POST['productId'],
                        'quantity' => $amountToRemove,
                        'priceDuringOrder' => $_POST['oldPrice']
                    ]];

                    DB::getInstance()->update('orders', $currentOrder->id, array(
                        'refunded' => json_encode($temp)
                    ));

                   header('Location: ../all-orders.php');
                }
            }else{
                header('Location: ../edit-order-cart-product.php?orderId=' . $_POST["orderId"] . '&productId=' . $_POST["productId"]);
            }
        
        
      



     }elseif(isset($_POST['orderId']) && isset($_POST['productId'])){
         header('Location: ../edit-order-cart-product.php?orderId=' . $_POST["orderId"] . '&productId=' . $_POST["productId"]);
     }else{
        header('Location: ../all-orders.php');
     }
?>