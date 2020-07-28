<?php
       require_once("../../includes/init.php");
       require_once("../../classes/DB.php");
       require_once("../../classes/Config.php");
       require_once("../../classes/Validate.php");
       require_once("../../classes/Session.php");
       require_once("../../classes/User.php");
       $db = DB::getInstance();
       $user = new User();

    if(isset($_POST['termHeader']) && isset($_POST['orderId'])  && isset($_POST['headerTitle']) && isset($_POST['terms']) && $user->isLoggedIn()){
        $termHeaderToUpdate = $db->findFirst("terms_and_conditions", array(
            "conditions" => "id = ?",
            "bind" => [$_POST['termHeader']]
        ));
        if($termHeaderToUpdate){
            $oldArray = json_decode($termHeaderToUpdate->terms_conditions);
            if($_POST['headerTitle'] == $_POST['termHeader']){
                $oldArray[$_POST['orderId']] = $_POST['terms'];
                $newArray = json_encode($oldArray);
        
                $db->update("terms_and_conditions", $_POST['termHeader'], array(
                    "terms_conditions" => $newArray
                ));
            }else{
                unset($oldArray[$_POST['orderId']]);
                $newArray = array();
                
                foreach($oldArray as $paragraph){
                    $newArray[] = $paragraph;
                }

                $db->update("terms_and_conditions", $_POST['termHeader'], array(
                    "terms_conditions" => json_encode($newArray)
                ));

                $secondTermHeaderToUpdate = $db->findFirst("terms_and_conditions", array(
                    "conditions" => "id = ?",
                    "bind" => [$_POST['headerTitle']]
                ));

                $secondOldArray = json_decode($secondTermHeaderToUpdate->terms_conditions);
                $secondOldArray[] = $_POST['terms'];
                $secondNewArray = json_encode($secondOldArray);

                $db->update("terms_and_conditions", $_POST['headerTitle'], array(
                    "terms_conditions" => $secondNewArray
                ));
            }
            header("Location: ../all-paragraphs.php?termHeader=" . $_POST['termHeader']);
        }else{
            header("Location: ../create-terms-and-conditions.php");
        }
       
    }else{
        header("Location: ../create-terms-and-conditions.php");
    }


?>