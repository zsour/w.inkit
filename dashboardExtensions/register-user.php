<?php
    include_once("../includes/dashboardhead.php");
    $validation = new Validate();


    if(!empty($_POST)){
        if(Token::check($_POST['token'])){
                $validation->check($_POST, array(
                    'username' => array(
                        'required' => true,
                        'min' => 4,
                        'max' => 20,
                        'unique' => 'users'
                    ),

                    'password' => array(
                        'required' => true,
                        'min' => 10,
                        'max' => 40
                    ),

                    'password_confirmation' => array(
                        'required' => true,
                        'matches' => 'password'
                    ),

                    'full_name' => array(
                        'required' => true,
                        'min' => 2,
                        'max' => 50
                    )
                    ));


                    if($validation->passed()){
                        $user = new User();

                        $salt = Hash::salt(32);
                        $password = Hash::make($_POST['password'], $salt);
                        
                        try{
                            $user->create(array(
                                'username' => $_POST['username'],
                                'password' => $password,
                                'salt' => $salt,
                                'name' => $_POST['full_name'],
                                'joined' => date('Y-m-d H:i:s'),
                                'groups' => 0
                            ));
                        }

                        catch(Exception $e){
                            die($e->getMessage());
                        }
            
                        $_POST = array();
                 
                        header("Location: all-users.php");
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
                    Add User
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

                    <form method="POST" action="register-user.php" id="register_user" enctype="multipart/form-data">
                        <div class="headerAboveInput">Username</div>
                        <input type="text"   id="username" name="username" placeholder="Type Your Username" value="<?= (isset($_POST['username'])) ? $_POST['username'] : ""; ?>">
                        <div class="headerAboveInput">Password</div>
                        <input type="password" id="password" name="password" placeholder="Type Your Password" value="<?= (isset($_POST['password'])) ? $_POST['password'] : ""; ?>">
                        <div class="headerAboveInput">Password Confirmation</div>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Your Password" value="<?= (isset($_POST['password_confirmation'])) ? $_POST['password_confirmation'] : ""; ?>">
                        <div class="headerAboveInput">Full Name</div>
                        <input type="text" id="full_name" name="full_name" placeholder="Type Your Full Name" value="<?= (isset($_POST['full_name'])) ? $_POST['full_name'] : ""; ?>">
        
                        <input type="hidden" name="token" value="<?= Token::generate();?>">

                        <div id="submit-btn" onclick="document.getElementById('register_user').submit();">
                            <div class="submit-text-center">Register User</div>
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



