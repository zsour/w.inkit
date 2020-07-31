<?php
       require_once("../../includes/init.php");
       require_once("../../classes/DB.php");
       require_once("../../classes/Config.php");
       require_once("../../classes/Validate.php");
       require_once("../../classes/Session.php");
       require_once("../../classes/User.php");
       $db = DB::getInstance();
       $user = new User();

    if(isset($_POST['aboutHeader']) && isset($_POST['orderId']) && $user->isLoggedIn()){
        $aboutHeaderToUpdate = $db->findFirst("about", array(
            "conditions" => "id = ?",
            "bind" => [$_POST['aboutHeader']]
        ));
        if($aboutHeaderToUpdate){
            $oldArray = json_decode($aboutHeaderToUpdate->info_block);
            unset($oldArray[$_POST['orderId']]);
            $newArray = array();
            foreach($oldArray as $paragraph){
                $newArray[] = $paragraph;
            }
            
        
            print_r($newArray);
            $db->update("about", $_POST['aboutHeader'], array(
                "info_block" => json_encode($newArray)
            ));

            header("Location: ../all-about-paragraphs.php?aboutHeader=" . $_POST['aboutHeader']);
        }else{
            header("Location: ../about-page-edit.php");
        }
       
    }


?>