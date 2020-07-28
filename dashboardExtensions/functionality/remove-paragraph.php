<?php
       require_once("../../includes/init.php");
       require_once("../../classes/DB.php");
       require_once("../../classes/Config.php");
       require_once("../../classes/Validate.php");
       require_once("../../classes/Session.php");
       require_once("../../classes/User.php");
       $db = DB::getInstance();
       $user = new User();

    if(isset($_POST['termHeader']) && isset($_POST['orderId']) && $user->isLoggedIn()){
        $termHeaderToUpdate = $db->findFirst("terms_and_conditions", array(
            "conditions" => "id = ?",
            "bind" => [$_POST['termHeader']]
        ));
        if($termHeaderToUpdate){
            $oldArray = json_decode($termHeaderToUpdate->terms_conditions);
            unset($oldArray[$_POST['orderId']]);
            $newArray = array();
            foreach($oldArray as $paragraph){
                $newArray[] = $paragraph;
            }
            
        
            print_r($newArray);
            $db->update("terms_and_conditions", $_POST['termHeader'], array(
                "terms_conditions" => json_encode($newArray)
            ));

            header("Location: ../all-paragraphs.php?termHeader=" . $_POST['termHeader']);
        }else{
            header("Location: ../create-terms-and-conditions.php");
        }
       
    }


?>