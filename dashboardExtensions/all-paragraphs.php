<?php
    include_once("../includes/dashboardhead.php");

    if(isset($_GET['termHeader'])){
        $db = DB::getInstance();
        
        $termHeader = $db->findFirst('terms_and_conditions', [
            'conditions' => 'id = ?',
            'bind' => [$_GET['termHeader']]
        ]);

    
    }else{
        header('Location: ./create-terms-and-conditions.php');
    }
?>
<link rel="stylesheet" href="../public/style/all-paragraphs.css">
<div class="background">
    <div class="dashboard-content" id="content">

    <?php 
        include_once("dashboard-sidebar.php");
    ?>

    <div class="center-components-background">
        <div class="center-components" id="center-components"> 
            <div class="dashboardExtensionHeader">All Paragraphs Connected To: <?= $termHeader->title; ?></div>
                <?php
                    $allParagraphs = json_decode($termHeader->terms_conditions);
                    for($i = 0; $i < count($allParagraphs); $i++):  
                ?>
                    <div class="paragraph-container">
                        <form action="./functionality/remove-paragraph.php" id="remove-form-<?= $i; ?>" method="POST">
                            <input type="hidden" name="termHeader" value="<?= $termHeader->id; ?>">
                            <input type="hidden" name="orderId" value="<?= $i; ?>">
                        </form>

                        <div class="paragraph-header">
                            <div class="edit-terms-and-conditions-button paragraph-header-btn" onclick="Navigation.loadComponents('edit-paragraph.php?termHeader=<?= $termHeader->id; ?>&orderId=<?= $i; ?>');">
                                <div class="edit-terms-and-conditions-button-text">EDIT PARAGRAPH</div>
                            </div>

                            <div class="moveUpBtn" onclick="window.location.href = 'functionality/order-paragraphs.php?termHeader=<?= $termHeader->id; ?>&orderId=<?= $i; ?>&pos=1'"></div>
                            <div class="moveDownBtn" onclick="window.location.href = 'functionality/order-paragraphs.php?termHeader=<?= $termHeader->id; ?>&orderId=<?= $i; ?>&pos=-1'"></div>
                            <div class="removeBtn" onclick="document.getElementById('remove-form-<?= $i; ?>').submit();"></div>
                        </div>
                        <div class="paragraph-content"><?=
                            $allParagraphs[$i];
                        ?></div>
                    </div>
                <?php
                    endfor;
                ?>
               

        </div>  
    </div>


    
    </div>
    

    <div class="modal-background" id="modalBG" onclick="Modal.closeModal();">
        <div class="modal-content" id="modalContent">
            
        </div>
    </div>
</div>

<script src="../public/js/jquery.js"></script>
<script src="../public/js/dashboard-nav.js"></script>
<script src="../public/js/modal.js"></script>
<script src="../public/js/edit-product-images.js"></script>



