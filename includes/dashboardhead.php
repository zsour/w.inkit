<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

<link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Playfair+Display&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Big+Shoulders+Text&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto+Slab&display=swap" rel="stylesheet">

<link rel="stylesheet" href="../public/style/dashboard.css">
<link rel="stylesheet" href="../public/style/dashboard-forms.css">
<link rel="stylesheet" href="../public/style/all-products.css">
<link rel="stylesheet" href="../public/style/all-orders.css">
<link rel="stylesheet" href="../public/style/all-categories.css">
<link rel="stylesheet" href="../public/style/edit-website.css">
<link rel="stylesheet" href="../public/style/create-terms-and-conditions.css">
<link rel="stylesheet" href="../public/style/modal-style.css">


<?php
    require_once("../includes/init.php"); 
    $user = new User();
    if(!$user->isLoggedIn()){
        header("Location: ../login.php");
    }
?>