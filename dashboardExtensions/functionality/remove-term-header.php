<?php
       require_once("../../includes/init.php");
       require_once("../../classes/DB.php");
       require_once("../../classes/Config.php");
       require_once("../../classes/Validate.php");
       require_once("../../classes/Session.php");
       require_once("../../classes/User.php");
       $db = DB::getInstance();
       $user = new User();

    if(isset($_POST['orderId']) && $user->isLoggedIn()){
        $ordersAbove = $db->find("terms_and_conditions", [
            'conditions' => 'order_of_conditions > ?',
            'bind' => [$_POST['orderId']]
        ]);

        $currentHeader = $db->findFirst("terms_and_conditions", [
            'conditions' => 'order_of_conditions = ?',
            'bind' => [$_POST['orderId']]
        ]);


        if($ordersAbove && $currentHeader){
            DB::getInstance()->delete('terms_and_conditions', $currentHeader->id);

            foreach($ordersAbove as $termHeader){
                DB::getInstance()->update('terms_and_conditions', $termHeader->id, [
                    'order_of_conditions' => ($termHeader->order_of_conditions - 1)
                ]);
            }
        }else if($currentHeader){
            DB::getInstance()->delete('terms_and_conditions', $currentHeader->id);
        }
       
        

            header("Location: ../create-terms-and-conditions.php");
    }else{
            header("Location: ../create-terms-and-conditions.php");
    }
       
    


?>