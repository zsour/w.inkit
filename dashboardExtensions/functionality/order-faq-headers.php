<?php
   require_once("../../includes/init.php");
   require_once("../../classes/DB.php");
   require_once("../../classes/Config.php");
   require_once("../../classes/Validate.php");
   require_once("../../classes/Session.php");
   require_once("../../classes/User.php");

    $user = new User();
   
    if(isset($_GET['pos']) && isset($_GET['faqOrder']) && $user->isLoggedIn()){

        if($_GET['pos'] == 1){
            $faqHeaderAbove = DB::getInstance()->findFirst('faq', [
                'conditions' => "order_of_info = ?",
                'bind' => [$_GET['faqOrder'] - 1]
            ]);

            $currentfaqHeader = DB::getInstance()->findFirst('faq', [
                'conditions' => "order_of_info = ?",
                'bind' => [$_GET['faqOrder']]
            ]);
            
            if($faqHeaderAbove && $currentfaqHeader){
                DB::getInstance()->update('faq', $faqHeaderAbove->id ,[
                    'order_of_info' => $faqHeaderAbove->order_of_info + 1
                ]);
                
                DB::getInstance()->update('faq', $currentfaqHeader->id ,[
                    'order_of_info' => $_GET['faqOrder'] - 1 
                ]);
        
                header("Location: ../faq-page-edit.php");
            }else{
                header("Location: ../faq-page-edit.php");
            }
        }
        else if($_GET['pos'] == -1){
            $faqHeaderBelow = DB::getInstance()->findFirst('faq', [
                'conditions' => "order_of_info = ?",
                'bind' => [$_GET['faqOrder'] + 1]
            ]);

            $currentfaqHeader = DB::getInstance()->findFirst('faq', [
                'conditions' => "order_of_info = ?",
                'bind' => [$_GET['faqOrder']]
            ]);

            if($faqHeaderBelow){
                DB::getInstance()->update('faq', $faqHeaderBelow->id ,[
                    'order_of_info' => $faqHeaderBelow->order_of_info - 1
                ]);
               
                DB::getInstance()->update('faq', $currentfaqHeader->id ,[
                    'order_of_info' => $_GET['faqOrder'] + 1 
                ]);
                
                header("Location: ../faq-page-edit.php");
            }else{
                header("Location: ../faq-page-edit.php");
            }
        }
        else{
            header("Location: ../faq-page-edit.php");
        }
    }
    else{
        header("Location: ../faq-page-edit.php"); 
    }


?>