<?php
  require_once("../../includes/init.php");
  require_once("../../classes/DB.php");
  require_once("../../classes/Config.php");
  require_once("../../classes/Session.php");
  require_once("../../classes/Validate.php");
  require_once("../../classes/User.php"); 
  $user = new User();
  
  if($user->isLoggedIn()){
    DB::getInstance()->query("UPDATE terms_and_conditions set
    live = 1");

      header("Location: ../create-terms-and-conditions.php");
  }else{
      header("Location: ../../login");
  }
  

?>