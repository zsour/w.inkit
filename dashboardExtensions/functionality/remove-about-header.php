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
        $ordersAbove = $db->find("about", [
            'conditions' => 'order_of_info > ?',
            'bind' => [$_POST['orderId']]
        ]);

        $currentHeader = $db->findFirst("about", [
            'conditions' => 'order_of_info = ?',
            'bind' => [$_POST['orderId']]
        ]);


        if($ordersAbove && $currentHeader){
            DB::getInstance()->delete('about', $currentHeader->id);

            foreach($ordersAbove as $aboutHeader){
                DB::getInstance()->update('about', $aboutHeader->id, [
                    'order_of_info' => ($aboutHeader->order_of_info - 1)
                ]);
            }
        }else if($currentHeader){
            DB::getInstance()->delete('about', $currentHeader->id);
        }
       
        

            header("Location: ../about-page-edit.php");
    }else{
            header("Location: ../about-page-edit.php");
    }
       
    


?>