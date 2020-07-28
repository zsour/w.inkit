<?php
   require_once("../../includes/init.php");
   require_once("../../classes/DB.php");
   require_once("../../classes/Config.php");
   require_once("../../classes/Validate.php");
   require_once("../../classes/Session.php");
   require_once("../../classes/User.php");

    $user = new User();
   
    if(isset($_GET['termHeader']) && isset($_GET['orderId']) && isset($_GET['pos']) && $user->isLoggedIn()){
        $allParagraphs = json_decode(DB::getInstance()->findFirst('terms_and_conditions', [
            'conditions' => "id = ?", 
            'bind' => [$_GET['termHeader']]
        ])->terms_conditions);
        if($_GET['pos'] == 1){
            if(isset($allParagraphs[$_GET['orderId'] - 1])){
                $temp = $allParagraphs[$_GET['orderId'] - 1];
                $allParagraphs[$_GET['orderId'] - 1] = $allParagraphs[$_GET['orderId']];
                $allParagraphs[$_GET['orderId']] = $temp;
                $newArray = json_encode($allParagraphs);
                DB::getInstance()->update('terms_and_conditions', $_GET['termHeader'], [
                    'terms_conditions' => $newArray
                ]);
            }else{
                header("Location: ../all-paragraphs.php?termHeader=" . $_GET['termHeader']);
            }
        }else if($_GET['pos'] == -1){
            if(isset($allParagraphs[$_GET['orderId'] + 1])){
                $temp = $allParagraphs[$_GET['orderId'] + 1];
                $allParagraphs[$_GET['orderId'] + 1] = $allParagraphs[$_GET['orderId']];
                $allParagraphs[$_GET['orderId']] = $temp;
                $newArray = json_encode($allParagraphs);
                DB::getInstance()->update('terms_and_conditions', $_GET['termHeader'], [
                    'terms_conditions' => $newArray
                ]);
            }else{
                header("Location: ../all-paragraphs.php?termHeader=" . $_GET['termHeader']);
            }
        }

        header("Location: ../all-paragraphs.php?termHeader=" . $_GET['termHeader']); 
    }else{
        header("Location: ../all-paragraphs.php?termHeader=" . $_GET['termHeader']); 
    }


?>