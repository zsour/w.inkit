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
    if(isset($_POST['orderId']) && isset($_POST['archived'])){
        $order = DB::getInstance()->findFirst('orders', [
            'conditions' => 'id = ?',
            'bind' => [$_POST['orderId']]
        ]);

        if($order){
            if($_POST['archived'] == 1){
                DB::getInstance()->update('orders', $order->id, [
                    'archived' => 0
                ]);

                header("Location: ../archived-orders.php");
            }else if($_POST['archived'] == 0){
                DB::getInstance()->update('orders', $order->id, [
                    'archived' => 1
                ]);

                header("Location: ../all-orders.php");
            }
        }else{
            header("Location: ../all-orders.php");
        }
    }

  }else{
    header("Location: ../../login");
  }
?>