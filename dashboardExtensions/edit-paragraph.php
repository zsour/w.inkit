<?php
    include_once("../includes/dashboardhead.php");

    if(isset($_GET['termHeader']) && isset($_GET['orderId'])){
        $header = $db = DB::getInstance()->findFirst('terms_and_conditions', array(
            'conditions' => "id = ?",
            'bind' => [$_GET['termHeader']]
        ));

        $currentEditingParagraph = json_decode($header->terms_conditions)[$_GET['orderId']];
    }else{
        header("Location: ./create-terms-and-conditions.php");
    }
?>
<div class="background">
    <div class="dashboard-content" id="content">

    <?php 
        include_once("dashboard-sidebar.php")
    ?>

    <div class="center-components-background">
        
    <div class="center-components" id="center-components"> 
        <div class="dashboardExtensionHeader">
            Edit terms and conditions paragraph
        </div>

                   
        <form action="functionality/functionality.edit-paragraph.php" method="POST" id="edit-paragraph-form">
            <div class="headerAboveInput">Header For Paragraph</div>
           

                        <select name="headerTitle" id="headerTitleSelect">
                        <?php
                                 $db = DB::getInstance();
                                 $headerTitles = $db->find('terms_and_conditions');
                                 foreach($headerTitles as $headerTitle):
                        ?>
                        <option value="<?= $headerTitle->id; ?>" <?php
                            if($headerTitle->id == $_GET['termHeader']){
                                    echo(' selected');
                            }
                        ?> <?php if($headerTitle->id == $_GET['termHeader']):
                            ?> selected <?php endif;?>><?= $headerTitle->title; ?></option>
                        <?php
                            endforeach;
                        ?>
                        </select>
   

            <div class="headerAboveInput">Paragraph Content</div>
            <textarea name="terms" id="terms" cols="30" rows="10" placeholder="Type Your Terms And Conditions"><?= (!empty($currentEditingParagraph)) ? trim($currentEditingParagraph) : ""; ?></textarea>
            <input type="hidden" name="termHeader" value="<?= $_GET['termHeader']; ?>">
            <input type="hidden" name="orderId" value="<?= $_GET['orderId']; ?>">
        </form>
        

        <div class="add-terms-and-conditions-submit-btn" onclick="document.getElementById('edit-paragraph-form').submit();">
        <div class="submit-text-center">EDIT PARAGRAPH</div>
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
