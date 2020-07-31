<?php
   require_once("../../includes/init.php");
   require_once("../../classes/DB.php");
   require_once("../../classes/Config.php");
   require_once("../../classes/Validate.php");
   require_once("../../classes/Session.php");
   require_once("../../classes/User.php");

    $user = new User();
   
    if(isset($_GET['pos']) && isset($_GET['aboutOrder']) && $user->isLoggedIn()){

        if($_GET['pos'] == 1){
            $aboutHeaderAbove = DB::getInstance()->findFirst('about', [
                'conditions' => "order_of_info = ?",
                'bind' => [$_GET['aboutOrder'] - 1]
            ]);

            $currentAboutHeader = DB::getInstance()->findFirst('about', [
                'conditions' => "order_of_info = ?",
                'bind' => [$_GET['aboutOrder']]
            ]);
            
            if($aboutHeaderAbove && $currentAboutHeader){
                DB::getInstance()->update('about', $aboutHeaderAbove->id ,[
                    'order_of_info' => $aboutHeaderAbove->order_of_info + 1
                ]);
                
                DB::getInstance()->update('about', $currentAboutHeader->id ,[
                    'order_of_info' => $_GET['aboutOrder'] - 1 
                ]);
        
                header("Location: ../about-page-edit.php");
            }else{
                header("Location: ../about-page-edit.php");
            }
        }
        else if($_GET['pos'] == -1){
            $aboutHeaderBelow = DB::getInstance()->findFirst('about', [
                'conditions' => "order_of_info = ?",
                'bind' => [$_GET['aboutOrder'] + 1]
            ]);

            $currentAboutHeader = DB::getInstance()->findFirst('about', [
                'conditions' => "order_of_info = ?",
                'bind' => [$_GET['aboutOrder']]
            ]);

            if($aboutHeaderBelow){
                DB::getInstance()->update('about', $aboutHeaderBelow->id ,[
                    'order_of_info' => $aboutHeaderBelow->order_of_info - 1
                ]);
               
                DB::getInstance()->update('about', $currentAboutHeader->id ,[
                    'order_of_info' => $_GET['aboutOrder'] + 1 
                ]);
                
                header("Location: ../about-page-edit.php");
            }else{
                header("Location: ../about-page-edit.php");
            }
        }
        else{
            header("Location: ../about-page-edit.php");
        }
    }
    else{
        header("Location: ../about-page-edit.php"); 
    }


?>