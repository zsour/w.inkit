<?php
    include_once("../includes/dashboardhead.php");

    if(isset($_GET['faqHeader']) && isset($_GET['orderId'])){
        $header = $db = DB::getInstance()->findFirst('faq', array(
            'conditions' => "id = ?",
            'bind' => [$_GET['faqHeader']]
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
            Edit faq page paragraph
        </div>

                   
        <form action="functionality/functionality.edit-faq-page-paragraph.php" method="POST" id="edit-paragraph-form">
            <div class="headerAboveInput">Header For Paragraph</div>
           

                        <select name="headerTitle" id="headerTitleSelect">
                        <?php
                                 $db = DB::getInstance();
                                 $headerTitles = $db->find('faq');
                                 foreach($headerTitles as $headerTitle):
                        ?>
                        <option value="<?= $headerTitle->id; ?>" <?php
                            if($headerTitle->id == $_GET['faqHeader']){
                                    echo(' selected');
                            }
                        ?> <?php if($headerTitle->id == $_GET['faqHeader']):
                            ?> selected <?php endif;?>><?= $headerTitle->title; ?></option>
                        <?php
                            endforeach;
                        ?>
                        </select>
   

            <div class="headerAboveInput">Paragraph Content</div>
            <textarea name="info" id="terms" cols="30" rows="10" placeholder="Type Your Information:"><?= (!empty($currentEditingParagraph)) ? trim($currentEditingParagraph) : ""; ?></textarea>
            <input type="hidden" name="faqHeader" value="<?= $_GET['faqHeader']; ?>">
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
