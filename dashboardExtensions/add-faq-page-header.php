<?php
    include_once("../includes/dashboardhead.php");

    $validation = new Validate();
    if(!empty($_POST) && isset($_POST['title'])){
        $headerTitle = (isset($_POST['title'])) ? $_POST['title'] : ""; 

        $validation->check($_POST, array(
            'title' => array(
                'required' => true
            )
        ));
    
        if($validation->passed()){
            $max = DB::getInstance()->query("SELECT MAX( order_of_info ) AS max FROM `faq`;")->results()[0]->max;
            $orderInDb = $max + 1;
            
            if($max >= 0){
                DB::getInstance()->insert('faq', array(
                    'title' => $headerTitle,
                    'order_of_info' => $orderInDb
                ));
            }
            
            $_POST = array();
            header("Location: faq-page-edit.php");
        }
    }
?>
<div class="background">
    <div class="dashboard-content" id="content">

    <?php 
        include_once("dashboard-sidebar.php");
    ?>

    <div class="center-components-background">
        
    <div class="center-components" id="center-components"> 

        <div class="dashboardExtensionHeader">
            Add faq page header
        </div>

        
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

        <form action="add-faq-page-header.php" id="add-faq-header-form" method="POST">
            <div class="headerAboveInput">Header Title</div>
            <input type="text" spellcheck="false" id="header-title" name="title" placeholder="Type The Title Of The Header" value="<?= (isset($_POST['header-title'])) ? $_POST['header-title'] : ""; ?>">
        </form>

        <div class="add-terms-and-conditions-submit-btn" onclick="document.getElementById('add-faq-header-form').submit();">
        <div class="submit-text-center">ADD HEADER</div>
        </div>


        <div class="modal-background" id="modalBG" onclick="Modal.closeModal();">
            <div class="modal-content" id="modalContent">
                
            </div>
        </div>
    
    
    </div>
    </div>
    
    </div>
    
</div>


<script src="../public/js/jquery.js"></script>
<script src="../public/js/dashboard-nav.js"></script>
<script src="../public/js/modal.js"></script>
