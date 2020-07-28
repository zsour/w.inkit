<?php
     require_once("../../includes/init.php");
     require_once("../../classes/DB.php");
     require_once("../../classes/Config.php");
     require_once("../../classes/Validate.php");
     require_once("../../classes/Session.php");
     require_once("../../classes/User.php");
     $db = DB::getInstance();
     $user = new User();

     if(isset($_POST['title']) && isset($_POST['termHeader']) && $user->isLoggedIn()){
        DB::getInstance()->update('terms_and_conditions', $_POST['termHeader'], [
            'title' => $_POST['title']
        ]);

        header("Location: ../create-terms-and-conditions.php");
     }else{
         header("Location: ../create-terms-and-conditions.php");
     }

?>