<?php
  require_once("../../includes/init.php");
  require_once("../../classes/DB.php");
  require_once("../../classes/Config.php");
  require_once("../../classes/Session.php");
  require_once("../../classes/Validate.php");
  require_once("../../classes/User.php"); 
  $user = new User();
  
  if($user->isLoggedIn()){
    DB::getInstance()->query("UPDATE about set
    live = 1");

      header("Location: ../about-page-edit.php");
  }else{
      header("Location: ../../login");
  }
  

?>