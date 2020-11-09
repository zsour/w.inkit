<?php
       require_once("../../includes/init.php");
       require_once("../../classes/DB.php");
       require_once("../../classes/Config.php");
       require_once("../../classes/Validate.php");
       require_once("../../classes/Session.php");
       require_once("../../classes/User.php");
       $db = DB::getInstance();
       $user = new User();

    if(isset($_POST['faqHeader']) && isset($_POST['orderId'])  && isset($_POST['headerTitle']) && isset($_POST['info']) && $user->isLoggedIn()){
        $faqHeaderToUpdate = $db->findFirst("faq", array(
            "conditions" => "id = ?",
            "bind" => [$_POST['faqHeader']]
        ));
        if($faqHeaderToUpdate){
            $oldArray = json_decode($faqHeaderToUpdate->info_block);
            if($_POST['headerTitle'] == $_POST['faqHeader']){
                $oldArray[$_POST['orderId']] = $_POST['info'];
                $newArray = json_encode($oldArray);
        
                $db->update("faq", $_POST['faqHeader'], array(
                    "info_block" => $newArray
                ));
            }else{
                unset($oldArray[$_POST['orderId']]);
                $newArray = array();
                
                foreach($oldArray as $paragraph){
                    $newArray[] = $paragraph;
                }

                $db->update("faq", $_POST['faqHeader'], array(
                    "info_block" => json_encode($newArray)
                ));

                $secondfaqHeaderToUpdate = $db->findFirst("faq", array(
                    "conditions" => "id = ?",
                    "bind" => [$_POST['headerTitle']]
                ));

                $secondOldArray = json_decode($secondfaqHeaderToUpdate->info_block);
                $secondOldArray[] = $_POST['info'];
                $secondNewArray = json_encode($secondOldArray);

                $db->update("faq", $_POST['headerTitle'], array(
                    "info_block" => $secondNewArray
                ));
            }
            header("Location: ../all-faq-paragraphs.php?faqHeader=" . $_POST['faqHeader']);
        }else{
            header("Location: ../faq-page-edit.php");
        }
       
    }else{
        header("Location: ../faq-page-edit.php");
    }


?>