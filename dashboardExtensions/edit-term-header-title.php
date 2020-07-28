<?php
    include_once("../includes/dashboardhead.php");
    
    if(isset($_GET['termHeader'])){
        $termHeader = DB::getInstance()->findFirst('terms_and_conditions', [
            'conditions' => 'id = ?',
            'bind' => [$_GET['termHeader']]
        ]);

        if(!$termHeader){
            header('Location: ./create-terms-and-conditions.php');
        }else{
            $termHeaderTitle = $termHeader->title;
        }
    }else{
        header('Location: ./create-terms-and-conditions.php');
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
            Edit terms and conditions header
        </div>


        <form action="./functionality/functionality.edit-term-header-title.php" id="edit-terms-and-conditions-form" method="POST">
            <div class="headerAboveInput">Header Title</div>
            <input type="text"  id="header-title" name="title" placeholder="Type The Title Of The Header" value="<?= (isset($termHeaderTitle)) ? $termHeaderTitle : ""; ?>">
            <input type="hidden" name="termHeader" value="<?= $_GET['termHeader']; ?>">
        </form>

        <div class="add-terms-and-conditions-submit-btn" onclick="document.getElementById('edit-terms-and-conditions-form').submit();">
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
