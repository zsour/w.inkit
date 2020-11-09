<?php
    include_once("../includes/dashboardhead.php");

    if(isset($_GET['aboutHeader']) && isset($_GET['orderId'])){
        $header = $db = DB::getInstance()->findFirst('about', array(
            'conditions' => "id = ?",
            'bind' => [$_GET['aboutHeader']]
        ));

        $currentEditingParagraph = json_decode($header->info_block)[$_GET['orderId']];
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
            Edit about page paragraph
        </div>

                   
        <form action="functionality/functionality.edit-about-page-paragraph.php" method="POST" id="edit-paragraph-form">
            <div class="headerAboveInput">Header For Paragraph</div>
           

                    <select name="headerTitle" id="headerTitleSelect">
                        <?php
                                 $db = DB::getInstance();
                                 $headerTitles = $db->find('about');
                                 foreach($headerTitles as $headerTitle):
                                if(empty($headerTitle->image)):
                        ?>
                        <option value="<?= $headerTitle->id; ?>" <?php
                            if($headerTitle->id == $_GET['aboutHeader']):
                            ?> selected <?php endif;?>><?= $headerTitle->title; ?></option>
                        <?php
                            endif;
                            endforeach;
                        ?>
                        </select>
   

            <div class="headerAboveInput">Paragraph Content</div>
            <textarea name="info" id="terms" cols="30" rows="10" placeholder="Type Your Information:"><?= (!empty($currentEditingParagraph)) ? trim($currentEditingParagraph) : ""; ?></textarea>
            <input type="hidden" name="aboutHeader" value="<?= $_GET['aboutHeader']; ?>">
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
