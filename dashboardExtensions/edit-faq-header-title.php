<?php
    include_once("../includes/dashboardhead.php");
    
    if(isset($_GET['faqHeader'])){
        $faqHeader = DB::getInstance()->findFirst('faq', [
            'conditions' => 'id = ?',
            'bind' => [$_GET['faqHeader']]
        ]);

        if(!$faqHeader){
            header('Location: ./faq-page-edit.php');
        }else{
            $faqHeaderTitle = $faqHeader->title;
        }
    }else{
        header('Location: ./faq-page-edit.php');
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
            Edit faq header title
        </div>


        <form action="./functionality/functionality.edit-faq-header.php" id="edit-faq-header-form" method="POST">
            <div class="headerAboveInput">Header Title</div>
            <input type="text"  id="header-title" name="title" placeholder="Type The Title Of The Header" value="<?= (isset($faqHeaderTitle)) ? $faqHeaderTitle : ""; ?>">
            <input type="hidden" name="faqHeader" value="<?= $_GET['faqHeader']; ?>">
        </form>

        <div class="add-terms-and-conditions-submit-btn" onclick="document.getElementById('edit-faq-header-form').submit();">
        <div class="submit-text-center">EDIT HEADER</div>
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
