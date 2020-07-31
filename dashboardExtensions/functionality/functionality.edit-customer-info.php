<?php
  require_once("../../includes/init.php");
  require_once("../../classes/DB.php");
  require_once("../../classes/Config.php");
  require_once("../../classes/Session.php");
  require_once("../../classes/Validate.php");
  require_once("../../classes/User.php"); 
  
  $user = new User();
  if($user->isLoggedIn()){
    if(isset($_POST['orderId']) && isset($_POST['fullName']) && isset($_POST['email']) && isset($_POST['phone']) && 
    isset($_POST['country']) && isset($_POST['city']) && isset($_POST['zip']) && isset($_POST['address'])){
        if(!empty($_POST['orderId']) && !empty($_POST['fullName']) && !empty($_POST['email']) && !empty($_POST['phone']) &&
        !empty($_POST['country']) && !empty($_POST['city']) && !empty($_POST['zip']) && !empty($_POST['address'])){

            $order = DB::getInstance()->findFirst('orders', [
                'conditions' => 'id = ?',
                'bind' => [$_POST['orderId']]
            ]);
            if($order){
                DB::getInstance()->update('orders', $order->id, array(
                    'full_name' => $_POST['fullName'],
                    'email' => $_POST['email'],
                    'phone' => $_POST['phone'],
                    'country' => $_POST['country'],
                    'city' => $_POST['city'],
                    'zip' => $_POST['zip'],
                    'address' => $_POST['address']
                ));

                if(isset($_POST['fromHeader']) && $_POST['fromHeader']){
                    header('Location: ../archived-orders.php');
                }else{
                    header('Location: ../all-orders.php');
                }   

            }else{
                if(isset($_POST['fromHeader']) && $_POST['fromHeader']){
                    header('Location: ../archived-orders.php');
                }else{
                    header('Location: ../all-orders.php');
                }   
            }

        }else{
            if(isset($_POST['fromHeader']) && $_POST['fromHeader']){
                header('Location: ../archived-orders.php');
            }else{
                header('Location: ../all-orders.php');
            }   
        }
    }else{
        if(isset($_POST['fromHeader']) && $_POST['fromHeader']){
            header('Location: ../archived-orders.php');
        }else{
            header('Location: ../all-orders.php');
        }   
    }

  }else{
    header("Location: ../../login");
  }
?>