<?php
  require_once("../../includes/init.php");
  require_once("../../classes/DB.php");
  require_once("../../classes/Config.php");
  require_once("../../classes/Session.php");
  require_once("../../classes/Validate.php");
  require_once("../../classes/User.php"); 
  $user = new User();
  
  if($user->isLoggedIn()){
    DB::getInstance()->query("UPDATE faq set
    live = 1");

      header("Location: ../faq-page-edit.php");
  }else{
      header("Location: ../../login");
  }
  

?>