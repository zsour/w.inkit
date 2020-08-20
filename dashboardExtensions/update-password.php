<?php
    include_once("../includes/dashboardhead.php");
    $validation = new Validate();

    if(!empty($_POST)){
        if(Token::check($_POST['token'])){
                $validation->check($_POST, array(
                    'password' => array(
                        'required' => true,
                        'min' => 10,
                        'max' => 40
                    ),

                    'password_confirmation' => array(
                        'required' => true,
                        'matches' => 'password'
                    )
                    ));


                    if($validation->passed()){
                        $user = new User();

                        if(!$user->isLoggedIn()){
                            $_POST = array();
                            header('Location: login.php');
                        }else{

                            $salt = Hash::salt(32);
                            $password = Hash::make($_POST['password'], $salt);
                    
                            $user->updatePassword($password, $salt, $user->data()->id);
                            $_POST = array();
                            $user->logOut();
                            header("Location: update-password.php");
                        }
                    }
            }
    }
?>

<link rel="stylesheet" href="../public/style/register-user.css">
<div class="background">
    <div class="dashboard-content" id="content">

    <?php 
        include_once("dashboard-sidebar.php");
    ?>

    <div class="center-components-background">
        <div class="center-components" id="center-components"> 
                    <div class="dashboardExtensionHeader">
                    Update Password
                </div>

                <div class="form-container">
                    <?php
                        if(!empty($validation->errors())){
                                    foreach($validation->errors() as $error){
                                        $errorOutput = "<div class='error'>
                                                            <div id='error-text-center'>{$error}</div>
                                                        </div>";
                                        echo($errorOutput);
                                    }
                        }         
                        
                    ?>

                    <form method="POST" action="update-password.php" id="update_password" enctype="multipart/form-data">
                        <div class="headerAboveInput">New Password</div>
                        <input type="password" id="password" name="password" placeholder="Type Your New Password" value="<?= (isset($_POST['password'])) ? $_POST['password'] : ""; ?>">
                        <div class="headerAboveInput">Confirm Your New Password</div>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Your New Password" value="<?= (isset($_POST['password_confirmation'])) ? $_POST['password_confirmation'] : ""; ?>">
                       
                        <input type="hidden" name="token" value="<?= Token::generate();?>">

                        <div id="submit-btn" onclick="document.getElementById('update_password').submit();">
                            <div class="submit-text-center">Update Password</div>
                        </div>

                        
                        

                    </form>
                </div>

        </div>  
    </div>

    <div class="modal-background" id="modalBG" onclick="Modal.closeModal();">
        <div class="modal-content" id="modalContent">
            
        </div>
    </div>
    
    </div>
    
</div>


<script src="../public/js/jquery.js"></script>
<script src="../public/js/dashboard-nav.js"></script>
<script src="../public/js/modal.js"></script>



