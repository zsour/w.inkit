<?php
       require_once("../../includes/init.php");
       require_once("../../classes/DB.php");
       require_once("../../classes/Config.php");
       require_once("../../classes/Validate.php");
       require_once("../../classes/Session.php");
       require_once("../../classes/User.php");
       $db = DB::getInstance();
       $user = new User();

    if(isset($_POST['orderId'])  && $user->isLoggedIn()){
            DB::getInstance()->delete('orders', $_POST['orderId']);
            header("Location: ../archived-orders.php");
    }else{
        header("Location: ../archived-orders.php");
    }
       
?>