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
        if($order && $order->refunded == 0){
            $result = $gateway->transaction()->refund($_POST['orderId']);
            if($result->success){
                DB::getInstance()->update('orders', $order->id, array(
                    'archived' => 1,
                    'refunded' => 1
                ));
                
                header("Location: ../all-orders.php");
            }else{
                $result = $gateway->transaction()->void($_POST['orderId']);
                if($result->success){
                    DB::getInstance()->update('orders', $order->id, array(
                        'archived' => 1,
                        'refunded' => 1
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