<?php
    include_once("../includes/dashboardhead.php");

    $validation = new Validate();
    
    if(!empty($_FILES) && isset($_FILES['newImage'])){
     
        $validation->Check($_FILES, array(
            'newImage' => array(
                'imgRequired' => true,
                'imgCheckSingleFile' => true
            )
        ));

      

        if($validation->passed()){
            $max = DB::getInstance()->query("SELECT MAX( order_of_info ) AS max FROM `about`;")->results()[0]->max;
            $orderInDb = $max + 1;
            
            $fileName = $_FILES['newImage']['name'];
            $fileTmpName = $_FILES['newImage']['tmp_name'];
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $fileNameNew = uniqid('', true).".".$fileActualExt;
            $fileDestination = '../public/img/uploadedImages/' . $fileNameNew;

            move_uploaded_file($fileTmpName, $fileDestination);
            
            
            if($max >= 0){
                DB::getInstance()->insert('about', array(
                    'image' => $fileDestination,
                    'order_of_info' => $orderInDb
                ));
            }
            
            
            header("Location: about-page-edit.php");
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
            Add about page image
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

        <form action="add-about-page-image.php" id="add-about-header-form" method="POST" enctype="multipart/form-data">
            <div class="headerAboveInput">Upload Image</div>
            <input type="file" name="newImage" style="margin: 10px">
        </form>

        <div class="add-terms-and-conditions-submit-btn" onclick="document.getElementById('add-about-header-form').submit();">
        <div class="submit-text-center">ADD IMAGE</div>
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
