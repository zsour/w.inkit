<?php
  require_once("../../includes/init.php");
  require_once("../../classes/DB.php");
  require_once("../../classes/Config.php");
  require_once("../../classes/Session.php");
  require_once("../../classes/Validate.php");
  require_once("../../classes/User.php"); 
  require_once("../../generateGateway.php"); 
  
  $user = new User();
  if($user->isLoggedIn()){
    if(isset($_POST['orderId']) && !empty($_POST['orderId'])){
        $order = DB::getInstance()->findFirst('orders', array(
                'conditions' => 'braintree_id = ?',
                'bind' => [$_POST['orderId']]
        ));
        if($order){
            $result = $gateway->transaction()->refund($_POST['orderId']);
            if($result->success){
                if($order->refunded){
                    $temp = json_decode($order->refunded);
                    foreach(json_decode($order->cart) as $item){
                        $existsInArray = false;
                        foreach($temp as $refundedItem){
                            if($refundedItem->id == $item->id){
                                $existsInArray = true;
                            }
                        }

                        if($existsInArray == true){
                            $refundedItem->quantity += $item->quantity;
                        }else{
                            array_push($temp, $item);
                        }
                    }

                    DB::getInstance()->update('orders', $order->id, array(
                        'cart' => json_encode(array()),
                        'archived' => 1,
                        'refunded' => json_encode($temp)
                    ));

                }else{
                    DB::getInstance()->update('orders', $order->id, array(
                        'cart' => json_encode(array()),
                        'archived' => 1,
                        'refunded' => $order->cart
                    ));
                }
                
                header("Location: ../all-orders.php");
            }else{
                $result = $gateway->transaction()->void($_POST['orderId']);
                if($result->success){
                    DB::getInstance()->update('orders', $order->id, array(
                        'archived' => 1,
                        'refunded' => $order->cart
                    ));

                    header("Location: ../all-orders.php");
                }else{
                    header("Location: ../all-orders.php");
                }
            }
        }else{
                header("Location: ../all-orders.php");
        }

        }else{
            header("Location: ../all-orders.php");
        }

  }else{
      header("Location: ../../login");
  }
  

?>