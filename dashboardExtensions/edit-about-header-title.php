<?php
    include_once("../includes/dashboardhead.php");
    
    if(isset($_GET['aboutHeader'])){
        $aboutHeader = DB::getInstance()->findFirst('about', [
            'conditions' => 'id = ?',
            'bind' => [$_GET['aboutHeader']]
        ]);

        if(!$aboutHeader){
            header('Location: ./about-page-edit.php');
        }else{
            $aboutHeaderTitle = $aboutHeader->title;
        }
    }else{
        header('Location: ./about-page-edit.php');
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
            Edit about header title
        </div>


        <form action="./functionality/functionality.edit-about-header.php" id="edit-about-header-form" method="POST">
            <div class="headerAboveInput">Header Title</div>
            <input type="text"  id="header-title" name="title" placeholder="Type The Title Of The Header" value="<?= (isset($aboutHeaderTitle)) ? $aboutHeaderTitle : ""; ?>">
            <input type="hidden" name="aboutHeader" value="<?= $_GET['aboutHeader']; ?>">
        </form>

        <div class="add-terms-and-conditions-submit-btn" onclick="document.getElementById('edit-about-header-form').submit();">
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
