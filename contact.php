<?php
    require_once("includes/init.php");
    require_once("classes/DB.php");
    require_once("classes/Config.php");
    require_once("classes/CartEvent.php");
    
    $company = DB::getInstance()->findFirst('company', array(
        'conditions' => 'id = 0'
    ));

    $sendToEmail = $company->email;
    
    $fullName = (isset($_POST['fullName']) && !empty($_POST['fullName'])) ? $_POST['fullName'] : "";
    $email = (isset($_POST['email']) && !empty($_POST['email'])) ? $_POST['email'] : "";
    $subject = (isset($_POST['subject']) && !empty($_POST['subject'])) ? $_POST['subject'] : "";
    $content = (isset($_POST['content']) && !empty($_POST['content'])) ? $_POST['content'] : "";

    $errorCheck = false;

    if(!empty($fullName) && !empty($email) && !empty($subject) && !empty($content)){
        $body = "Customer email from " . $fullName . " (" . $email . ") 
        
        " . $content;
        mail($sendToEmail, $subject, $body, "From: no-reply@winkitprints.com\r\n" . "Content-Type: text/html; charset=UTF-8\r\n");
        $errorCheck = true;
    }
?>
<html>
    <head>
        <?php
          include("includes/head.php");
        ?>    
        <link rel="stylesheet" href="./public/style/contact.css">
        <title>w.inkit | Contact</title>
    </head>


<body>
    <div class="content">
        <div class="center-content" id="center-content">
                    <div class="products-nav-container">
                        <div class="products-nav-logo" onclick="window.location.href = './';"></div>
                        <div class="products-nav-button-container">
                            <div class="products-nav-button" onclick="window.location.href = 'products';">
                                <div class="button-text">PRODUCTS</div>
                            </div> 
                            
                            <div class="products-nav-button" onclick="window.location.href = 'about';">
                                <div class="button-text">ABOUT</div>
                            </div> 

                            <div class="products-nav-button" onclick="window.location.href = 'contact';">
                                <div class="button-text">CONTACT</div>
                            </div> 
                        </div>

                        <div class="product-shopping-cart" onclick="window.location.href = 'cart';">
                                <?php
                                    if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])):
                                ?>
                                <div class="shopping-cart-notice" style="filter: invert(0%);"></div>
                                <?php
                                    endif;
                                ?>
                        
                        </div>
                    </div>
                 
                    <div class="contact-container"> 
                        <?php
                            if($errorCheck):
                        ?>

                                <div class="success-container">
                                    Your email has been sent.
                                </div>

                        <?php
                            endif;
                        ?>
                        <form action="./contact.php" id="sendMailForm" method="post">
                            <div class="input-header">Your Full Name</div>
                            <input type="text" class="subject-input" placeholder="Type your full name here" name="fullName" spellcheck="false"
                                <?php
                                    if(empty($fullName) && isset($_POST['fullName'])){
                                        echo('style="border: red solid 2px;"');
                                    }else{
                                        echo('value="'. $fullName . '"');
                                    }
                                ?>
                            >
                            <div class="input-header">Your Email Address</div>
                            <input type="text" class="subject-input" placeholder="Type your email address here" name="email" spellcheck="false" 
                                <?php
                                    if(empty($email) && isset($_POST['email'])){
                                        echo('style="border: red solid 2px;"');
                                    }else{
                                        echo('value="'. $email . '"');
                                    }
                                ?>
                            >
                            <div class="input-header">Subject</div>
                            <input type="text" class="subject-input" placeholder="Type the subject of your email here" name="subject" spellcheck="false"
                                <?php
                                    if(empty($subject) && isset($_POST['subject'])){
                                        echo('style="border: red solid 2px;"');
                                    }else{
                                        echo('value="'. $subject . '"');
                                    }
                                ?>
                            >
                            <div class="input-header">Mail content</div>
                            <textarea name="content" class="mail-input" placeholder="Type your email here" name="content" spellcheck="false"
                                <?php
                                    if(empty($content) && isset($_POST['content'])){
                                        echo('style="border: red solid 2px;"');
                                    }
                                ?>
                            ><?= (isset($_POST['content'])) ? trim($_POST['content']) : ""; ?></textarea>


                            <div class="contact-send-mail-btn-container">
                                <div class="contact-send-mail-btn" onclick="document.getElementById('sendMailForm').submit();">
                                    <div class="contact-send-mail-btn-text">SEND MAIL</div>
                                </div>
                            </div>
                            
                        </form>    
                    </div>
                    
                <?php include_once('includes/footer.php'); ?>
        </div>
    </div>        

    </body>

    </html>