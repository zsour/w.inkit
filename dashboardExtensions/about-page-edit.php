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
            About Page
        </div>

        <div class="edit-terms-and-conditions-container">
            <div class="edit-terms-and-conditions-title">
                <div class="edit-terms-and-conditions-title-text">Edit terms and conditions</div>
            </div>

            <div class="edit-terms-and-conditions-button-container">
                <div class="edit-terms-and-conditions-button" onclick="Navigation.loadComponents('./add-about-page-header.php');">
                    <div class="edit-terms-and-conditions-button-text">ADD NEW HEADER</div>
                </div>

                <div class="edit-terms-and-conditions-button" onclick="Navigation.loadComponents('./add-about-page-paragraph.php');">
                    <div class="edit-terms-and-conditions-button-text">ADD NEW PARAGRAPH</div>
                </div>

                <div class="edit-terms-and-conditions-button" onclick="Navigation.loadComponents('./preview-about-page.php');">
                    <div class="edit-terms-and-conditions-button-text">PREVIEW</div>
                </div>
                    
                <div class="edit-terms-and-conditions-refresh-btn" onclick="document.getElementById('refresh-all-about-info-form').submit();"></div>
                <form action="./functionality/refresh-all-about-info.php" id="refresh-all-about-info-form"></form>
            </div>
        </div>


        <?php
            $aboutHeaders = DB::getInstance()->find('about', [
                'order' => 'order_of_info'
                ]);
            foreach($aboutHeaders as $aboutHeader):
                $switchPos = $aboutHeader->live == 0 ? 0 : 1;
        ?>
        <div class="terms-and-conditions-title">
            <form action="./functionality/remove-about-header.php" method="POST" id="remove-title-<?= $aboutHeader->id; ?>">
                <input type="hidden" name="orderId" value="<?= $aboutHeader->order_of_info; ?>">
            </form>
            <div class="terms-and-conditions-title-top">
                <div class="terms-and-conditions-title-top-text">Header: <?= $aboutHeader->title; ?></div>
            </div>
            
            <div class="terms-and-conditions-title-buttons">
                
                <div class="edit-terms-and-conditions-button small-btn" onclick="Navigation.loadComponents('./all-about-paragraphs.php?aboutHeader=<?= $aboutHeader->id; ?>');">
                    <div class="edit-terms-and-conditions-button-text">ALL PARAGRAPHS</div>
                </div>

                <div class="edit-terms-and-conditions-button small-btn" onclick="Navigation.loadComponents('./edit-about-header-title.php?aboutHeader=<?= $aboutHeader->id; ?>');">
                    <div class="edit-terms-and-conditions-button-text">EDIT HEADER</div>
                </div>

                <div class="editing-switch"  id="editing-switch-<?= $aboutHeader->id; ?>"<?php
                        if(!$switchPos){
                            echo('style="
                                background-color: #979696;
                            "');
                        }
                ?> onclick="flipSwitch(<?= $switchPos ?>, 'switchForm<?= $aboutHeader->id; ?>', 'editing-switch-<?= $aboutHeader->id; ?>', 'editing-switch-btn-<?= $aboutHeader->id; ?>');">
                        <div class="editing-switch-btn" id="editing-switch-btn-<?= $aboutHeader->id; ?>"
                            <?php
                                if(!$switchPos){
                                    echo('style="
                                        right: 20%;
                                    "');
                                }
                            ?>
                        ><span class="editing-switch-btn-icon"></span></div>
                </div>

                <div class="moveUpBtn" onclick="window.location.href = 'functionality/order-about-headers.php?aboutOrder=<?= $aboutHeader->order_of_info; ?>&pos=1'"></div>
                <div class="moveDownBtn" onclick="window.location.href = 'functionality/order-about-headers.php?aboutOrder=<?= $aboutHeader->order_of_info; ?>&pos=-1'"></div>
                <div class="removeBtn" onclick="document.getElementById('remove-title-<?= $aboutHeader->id; ?>').submit();"></div>
            </div>

            <form action="functionality/aboutSwitchFlipper.php" id="switchForm<?= $aboutHeader->id; ?>" method="POST">
                <input type="hidden" name="id" value="<?= $aboutHeader->id; ?>">
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
