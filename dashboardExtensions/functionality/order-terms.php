<?php
   require_once("../../includes/init.php");
   require_once("../../classes/DB.php");
   require_once("../../classes/Config.php");
   require_once("../../classes/Validate.php");
   require_once("../../classes/Session.php");
   require_once("../../classes/User.php");

    $user = new User();
   
    if(isset($_GET['pos']) && isset($_GET['termOrder']) && $user->isLoggedIn()){

        if($_GET['pos'] == 1){
            $termHeaderAbove = DB::getInstance()->findFirst('terms_and_conditions', [
                'conditions' => "order_of_conditions = ?",
                'bind' => [$_GET['termOrder'] - 1]
            ]);

            $currentTermHeader = DB::getInstance()->findFirst('terms_and_conditions', [
                'conditions' => "order_of_conditions = ?",
                'bind' => [$_GET['termOrder']]
            ]);
            
            if($termHeaderAbove && $currentTermHeader){
                DB::getInstance()->update('terms_and_conditions', $termHeaderAbove->id ,[
                    'order_of_conditions' => $termHeaderAbove->order_of_conditions + 1
                ]);
                
                DB::getInstance()->update('terms_and_conditions', $currentTermHeader->id ,[
                    'order_of_conditions' => $_GET['termOrder'] - 1 
                ]);
        
                header("Location: ../create-terms-and-conditions.php");
            }else{
                header("Location: ../create-terms-and-conditions.php");
            }
        }
        else if(isset($_GET['pos']) && $_GET['pos'] == -1 && $user->isLoggedIn()){
            $termHeaderBelow = DB::getInstance()->findFirst('terms_and_conditions', [
                'conditions' => "order_of_conditions = ?",
                'bind' => [$_GET['termOrder'] + 1]
            ]);

            $currentTermHeader = DB::getInstance()->findFirst('terms_and_conditions', [
                'conditions' => "order_of_conditions = ?",
                'bind' => [$_GET['termOrder']]
            ]);

            if($termHeaderBelow){
                DB::getInstance()->update('terms_and_conditions', $termHeaderBelow->id ,[
                    'order_of_conditions' => $termHeaderBelow->order_of_conditions - 1
                ]);
               
                DB::getInstance()->update('terms_and_conditions', $currentTermHeader->id ,[
                    'order_of_conditions' => $_GET['termOrder'] + 1 
                ]);
                
                header("Location: ../create-terms-and-conditions.php");
            }else{
                header("Location: ../create-terms-and-conditions.php");
            }
        }
        else{
            header("Location: ../create-terms-and-conditions.php");
        }
    }
    else{
        header("Location: ../create-terms-and-conditions.php"); 
    }


?>