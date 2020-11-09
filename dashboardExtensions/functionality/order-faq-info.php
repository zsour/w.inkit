<?php
   require_once("../../includes/init.php");
   require_once("../../classes/DB.php");
   require_once("../../classes/Config.php");
   require_once("../../classes/Validate.php");
   require_once("../../classes/Session.php");
   require_once("../../classes/User.php");

    $user = new User();
   
    if(isset($_GET['faqHeader']) && isset($_GET['orderId']) && isset($_GET['pos']) && $user->isLoggedIn()){
        $allParagraphs = json_decode(DB::getInstance()->findFirst('faq', [
            'conditions' => "id = ?", 
            'bind' => [$_GET['faqHeader']]
        ])->info_block);
        if($_GET['pos'] == 1){
            if(isset($allParagraphs[$_GET['orderId'] - 1])){
                $temp = $allParagraphs[$_GET['orderId'] - 1];
                $allParagraphs[$_GET['orderId'] - 1] = $allParagraphs[$_GET['orderId']];
                $allParagraphs[$_GET['orderId']] = $temp;
                $newArray = json_encode($allParagraphs);
                DB::getInstance()->update('faq', $_GET['faqHeader'], [
                    'info_block' => $newArray
                ]);
            }else{
                header("Location: ../all-faq-paragraphs.php?faqHeader=" . $_GET['faqHeader']);
            }
        }else if($_GET['pos'] == -1){
            if(isset($allParagraphs[$_GET['orderId'] + 1])){
                $temp = $allParagraphs[$_GET['orderId'] + 1];
                $allParagraphs[$_GET['orderId'] + 1] = $allParagraphs[$_GET['orderId']];
                $allParagraphs[$_GET['orderId']] = $temp;
                $newArray = json_encode($allParagraphs);
                DB::getInstance()->update('faq', $_GET['faqHeader'], [
                    'info_block' => $newArray
                ]);
            }else{
                header("Location: ../all-faq-paragraphs.php?faqHeader=" . $_GET['faqHeader']);
            }
        }

        header("Location: ../all-faq-paragraphs.php?faqHeader=" . $_GET['faqHeader']); 
    }else{
        header("Location: ../all-faq-paragraphs.php?faqHeader=" . $_GET['faqHeader']); 
    }


?>