<?php
       require_once("../../includes/init.php");
       require_once("../../classes/DB.php");
       require_once("../../classes/Config.php");
       require_once("../../classes/Validate.php");
       require_once("../../classes/Session.php");
       require_once("../../classes/User.php");
       $db = DB::getInstance();
       $user = new User();

    if(isset($_POST['faqHeader']) && isset($_POST['orderId']) && $user->isLoggedIn()){
        $faqHeaderToUpdate = $db->findFirst("faq", array(
            "conditions" => "id = ?",
            "bind" => [$_POST['faqHeader']]
        ));
        if($faqHeaderToUpdate){
            $oldArray = json_decode($faqHeaderToUpdate->info_block);
            unset($oldArray[$_POST['orderId']]);
            $newArray = array();
            foreach($oldArray as $paragraph){
                $newArray[] = $paragraph;
            }
            
        
            print_r($newArray);
            $db->update("faq", $_POST['faqHeader'], array(
                "info_block" => json_encode($newArray)
            ));

            header("Location: ../all-faq-paragraphs.php?faqHeader=" . $_POST['faqHeader']);
        }else{
            header("Location: ../faq-page-edit.php");
        }
       
    }


?>