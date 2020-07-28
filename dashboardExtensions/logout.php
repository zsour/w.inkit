<?php
    include_once("../includes/dashboardhead.php");

    $user = new User();
    $user->logOut();

    header("Location: ../login.php");
?>