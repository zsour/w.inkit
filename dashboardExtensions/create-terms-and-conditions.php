<?php
    include_once("../includes/dashboardhead.php");
 
?>
<div class="background">
    <div class="dashboard-content" id="content">

    <?php 
        include_once("dashboard-sidebar.php");
    ?>

    <div class="center-components-background">
        
    <div class="center-components" id="center-components"> 
        <div class="dashboardExtensionHeader">
            Terms and conditions
        </div>

        <div class="edit-terms-and-conditions-container">
            <div class="edit-terms-and-conditions-title">
                <div class="edit-terms-and-conditions-title-text">Edit terms and conditions</div>
            </div>

            <div class="edit-terms-and-conditions-button-container">
                <div class="edit-terms-and-conditions-button" onclick="Navigation.loadComponents('add-terms-and-conditions-header.php');">
                    <div class="edit-terms-and-conditions-button-text">ADD NEW HEADER</div>
                </div>

                <div class="edit-terms-and-conditions-button" onclick="Navigation.loadComponents('add-terms-and-conditions-paragraph.php');">
                    <div class="edit-terms-and-conditions-button-text">ADD NEW PARAGRAPH</div>
                </div>

                <div class="edit-terms-and-conditions-button" onclick="Navigation.loadComponents('preview-terms-and-conditions.php');">
                    <div class="edit-terms-and-conditions-button-text">PREVIEW</div>
                </div>
                    
                <div class="edit-terms-and-conditions-refresh-btn" onclick="document.getElementById('refresh-all-terms-form').submit();"></div>
                <form action="./functionality/refresh-terms.php" id="refresh-all-terms-form"></form>
            </div>
        </div>


        <?php
            $termsHeaders = DB::getInstance()->find('terms_and_conditions', [
                'order' => 'order_of_conditions'
                ]);
            foreach($termsHeaders as $termHeader):
                $switchPos = $termHeader->live == 0 ? 0 : 1;
        ?>
        <div class="terms-and-conditions-title">
            <form action="./functionality/remove-term-header.php" method="POST" id="remove-title-<?= $termHeader->id; ?>">
                <input type="hidden" name="orderId" value="<?= $termHeader->order_of_conditions; ?>">
            </form>
            <div class="terms-and-conditions-title-top">
                <div class="terms-and-conditions-title-top-text">Header: <?= $termHeader->title; ?></div>
            </div>
            
            <div class="terms-and-conditions-title-buttons">
                
                <div class="edit-terms-and-conditions-button small-btn" onclick="Navigation.loadComponents('all-paragraphs.php?termHeader=<?= $termHeader->id; ?>');">
                    <div class="edit-terms-and-conditions-button-text">ALL PARAGRAPHS</div>
                </div>

                <div class="edit-terms-and-conditions-button small-btn" onclick="Navigation.loadComponents('edit-term-header-title.php?termHeader=<?= $termHeader->id; ?>');">
                    <div class="edit-terms-and-conditions-button-text">EDIT HEADER</div>
                </div>

                <div class="editing-switch"  id="editing-switch-<?= $termHeader->id; ?>"<?php
                        if(!$switchPos){
                            echo('style="
                                background-color: #979696;
                            "');
                        }
                ?> onclick="flipSwitch(<?= $switchPos ?>, 'switchForm<?= $termHeader->id; ?>', 'editing-switch-<?= $termHeader->id; ?>', 'editing-switch-btn-<?= $termHeader->id; ?>');">
                        <div class="editing-switch-btn" id="editing-switch-btn-<?= $termHeader->id; ?>"
                            <?php
                                if(!$switchPos){
                                    echo('style="
                                        right: 20%;
                                    "');
                                }
                            ?>
                        ><span class="editing-switch-btn-icon"></span></div>
                </div>

                <div class="moveUpBtn" onclick="window.location.href = 'functionality/order-terms.php?termOrder=<?= $termHeader->order_of_conditions; ?>&pos=1'"></div>
                <div class="moveDownBtn" onclick="window.location.href = 'functionality/order-terms.php?termOrder=<?= $termHeader->order_of_conditions; ?>&pos=-1'"></div>
                <div class="removeBtn" onclick="document.getElementById('remove-title-<?= $termHeader->id; ?>').submit();"></div>
            </div>

            <form action="functionality/switchFlipper.php" id="switchForm<?= $termHeader->id; ?>" method="POST">
                <input type="hidden" name="id" value="<?= $termHeader->id; ?>">
                <input type="hidden" name="pos" value="<?= $switchPos; ?>">
            </form>
        </div>
        <?php
            endforeach;
        ?>

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
<script src="../public/js/terms-and-conditions-switches.js"></script>
