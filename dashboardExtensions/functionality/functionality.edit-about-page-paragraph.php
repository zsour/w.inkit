<?php
       require_once("../../includes/init.php");
       require_once("../../classes/DB.php");
       require_once("../../classes/Config.php");
       require_once("../../classes/Validate.php");
       require_once("../../classes/Session.php");
       require_once("../../classes/User.php");
       $db = DB::getInstance();
       $user = new User();

    if(isset($_POST['aboutHeader']) && isset($_POST['orderId'])  && isset($_POST['headerTitle']) && isset($_POST['info']) && $user->isLoggedIn()){
        $aboutHeaderToUpdate = $db->findFirst("about", array(
            "conditions" => "id = ?",
            "bind" => [$_POST['aboutHeader']]
        ));
        if($aboutHeaderToUpdate){
            $oldArray = json_decode($aboutHeaderToUpdate->info_block);
            if($_POST['headerTitle'] == $_POST['aboutHeader']){
                $oldArray[$_POST['orderId']] = $_POST['info'];
                $newArray = json_encode($oldArray);
        
                $db->update("about", $_POST['aboutHeader'], array(
                    "info_block" => $newArray
                ));
            }else{
                unset($oldArray[$_POST['orderId']]);
                $newArray = array();
                
                foreach($oldArray as $paragraph){
                    $newArray[] = $paragraph;
                }

                $db->update("about", $_POST['aboutHeader'], array(
                    "info_block" => json_encode($newArray)
                ));

                $secondaboutHeaderToUpdate = $db->findFirst("about", array(
                    "conditions" => "id = ?",
                    "bind" => [$_POST['headerTitle']]
                ));

                $secondOldArray = json_decode($secondaboutHeaderToUpdate->info_block);
                $secondOldArray[] = $_POST['info'];
                $secondNewArray = json_encode($secondOldArray);

                $db->update("about", $_POST['headerTitle'], array(
                    "info_block" => $secondNewArray
                ));
            }
            header("Location: ../all-about-paragraphs.php?aboutHeader=" . $_POST['aboutHeader']);
        }else{
            header("Location: ../about-page-edit.php");
        }
       
    }else{
        header("Location: ../about-page-edit.php");
    }


?>