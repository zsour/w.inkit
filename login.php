<?php
    require_once("includes/init.php");
    require_once("classes/Config.php");
    require_once("classes/Token.php");
    require_once("classes/DB.php");
    require_once("classes/Session.php");
    require_once("classes/Validate.php");
    require_once("classes/User.php");
    require_once("classes/Cookie.php");
    require_once("classes/Hash.php");

    $user = new User();
    if($user->isLoggedIn()){
        header('Location: dashboardExtensions/dashboard.php');
    }

    $validate = new Validate();
    if(!empty($_POST)){
        if(Token::check($_POST['token'])){
            
            $validation = $validate->check($_POST, array(
                'username' => array(
                    'required' => true
                ),  

                'password' => array(
                    'required' => true
                )
            )); 

            if($validation->passed()){
                $login = $user->login($_POST['username'], $_POST['password']);
                if($login){
                    header('Location: dashboardExtensions/dashboard.php');
                } else{
                    
                    header('Location: login.php');                    
                }
            }
        }
    }

?>

<link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Playfair+Display&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Big+Shoulders+Text&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto+Slab&display=swap" rel="stylesheet">
<link rel="stylesheet" href="public/style/login-form.css">



<div class="login-form-container">
    
    <form method="POST" action="login.php" id="login-form">
        <input type="hidden" name="token" value="<?= Token::generate(); ?>">
        <div class="username-text">USERNAME</div>
        <input type="text" class="username" spellcheck="false" name="username"> 
        <div class="password-text">PASSWORD</div>
        <input type="password" class="password" spellcheck="false" name="password">

        <div class="login-btn-container">
            <?php
            if(!empty($validate->errors())){
                foreach($validate->errors() as $error){
                    $errorOutput = "<div class='error-field'>
                                        <div class='error-field-text'>{$error}</div>
                                    </div>";
                    echo($errorOutput);
                }
            }         
            ?>
            <div class="login-btn" onclick="document.getElementById('login-form').submit();">
                <div class="login-btn-text">LOG IN</div>
            </div>
        </div>
    </form>
</div>