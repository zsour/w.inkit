<?php
     require_once("../../includes/init.php");
     require_once("../../classes/DB.php");
     require_once("../../classes/Config.php");
     require_once("../../classes/Validate.php");
     require_once("../../classes/Session.php");
     require_once("../../classes/User.php");
     $db = DB::getInstance();
     $user = new User();

     if(isset($_POST['title']) && isset($_POST['aboutHeader']) && $user->isLoggedIn()){
        DB::getInstance()->update('about', $_POST['aboutHeader'], [
            'title' => $_POST['title']
        ]);

        header("Location: ../about-page-edit.php");
     }else{
         header("Location: ../about-page-edit.php");
     }

?>