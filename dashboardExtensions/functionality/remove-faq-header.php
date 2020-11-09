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
        $ordersAbove = $db->find("faq", [
            'conditions' => 'order_of_info > ?',
            'bind' => [$_POST['orderId']]
        ]);

        $currentHeader = $db->findFirst("faq", [
            'conditions' => 'order_of_info = ?',
            'bind' => [$_POST['orderId']]
        ]);


        if($ordersAbove && $currentHeader){
            DB::getInstance()->delete('faq', $currentHeader->id);

            foreach($ordersAbove as $faqHeader){
                DB::getInstance()->update('faq', $faqHeader->id, [
                    'order_of_info' => ($faqHeader->order_of_info - 1)
                ]);
            }
        }else if($currentHeader){
            DB::getInstance()->delete('faq', $currentHeader->id);
        }
       
        

            header("Location: ../faq-page-edit.php");
    }else{
            header("Location: ../faq-page-edit.php");
    }
       
    


?>