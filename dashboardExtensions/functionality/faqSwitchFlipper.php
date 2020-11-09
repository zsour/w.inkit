<?php

    require_once("../../includes/init.php");
    require_once("../../classes/DB.php");
    require_once("../../classes/Config.php");
    require_once("../../classes/Validate.php");
    require_once("../../classes/Session.php");
    require_once("../../classes/User.php");
    $user = new User();

    if(isset($_POST['id']) && isset($_POST['pos']) && $user->isLoggedIn()){
        $switchPos = $_POST['pos'] == 1 ? 0 : 1;
        DB::getInstance()->update('faq', $_POST['id'], array(
            'live' => $switchPos
        ));

        header("Location: ../faq-page-edit.php");
    }

        header("Location: ../faq-page-edit.php");
?>