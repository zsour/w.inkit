<?php
     require_once("../../includes/init.php");
     require_once("../../classes/DB.php");
     require_once("../../classes/Config.php");
     require_once("../../classes/Validate.php");
     require_once("../../classes/Session.php");
     require_once("../../classes/User.php");
     $db = DB::getInstance();
     $user = new User();

     if(isset($_POST['title']) && isset($_POST['faqHeader']) && $user->isLoggedIn()){
        DB::getInstance()->update('faq', $_POST['faqHeader'], [
            'title' => $_POST['title']
        ]);

        header("Location: ../faq-page-edit.php");
     }else{
         header("Location: ../faq-page-edit.php");
     }

?>