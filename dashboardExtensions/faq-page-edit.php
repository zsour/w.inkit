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
            FAQ Page
        </div>

        <div class="edit-terms-and-conditions-container">
            <div class="edit-terms-and-conditions-title">
                <div class="edit-terms-and-conditions-title-text">Edit FAQ page</div>
            </div>

            <div class="edit-terms-and-conditions-button-container">
                <div class="edit-terms-and-conditions-button" onclick="Navigation.loadComponents('./add-faq-page-header.php');">
                    <div class="edit-terms-and-conditions-button-text">ADD NEW HEADER</div>
                </div>

                <div class="edit-terms-and-conditions-button" onclick="Navigation.loadComponents('./add-faq-page-paragraph.php');">
                    <div class="edit-terms-and-conditions-button-text">ADD NEW PARAGRAPH</div>
                </div>


                <div class="edit-terms-and-conditions-button" onclick="Navigation.loadComponents('./preview-faq-page.php');">
                    <div class="edit-terms-and-conditions-button-text">PREVIEW</div>
                </div>

                    
                <div class="edit-terms-and-conditions-refresh-btn" onclick="document.getElementById('refresh-all-faq-info-form').submit();"></div>
                <form action="./functionality/refresh-all-faq-info.php" id="refresh-all-faq-info-form"></form>
            </div>
        </div>


        <?php
            $faqHeaders = DB::getInstance()->find('faq', [
                'order' => 'order_of_info'
                ]);
            foreach($faqHeaders as $faqHeader):
                $switchPos = $faqHeader->live == 0 ? 0 : 1;
        ?>
        <div class="terms-and-conditions-title">
            <form action="./functionality/remove-faq-header.php" method="POST" id="remove-title-<?= $faqHeader->id; ?>">
                <input type="hidden" name="orderId" value="<?= $faqHeader->order_of_info; ?>">
            </form>
            <div class="terms-and-conditions-title-top"
                <?php
                    if(!empty($faqHeader->image)):
                ?>
                    style="background-color: none;"
                <?php
                    endif;
                ?>>

                <?php
                    if(empty($faqHeader->image)):
                ?>
                    <div class="terms-and-conditions-title-top-text">Header: <?= $faqHeader->title; ?></div>
                    
                <?php
                    else:
                ?>
                    <div class="terms-and-conditions-title-top-text">Image</div>
                <?php
                    endif;
                ?>
            </div>
            
            <div class="terms-and-conditions-title-buttons"
                    <?php
                        if(!empty($faqHeader->image)):
                    ?>
                        style="height: 100px; text-align: right;"
                    <?php
                        endif;
                    ?>>
                
                <?php
                    if(empty($faqHeader->image)):
                ?>
                <div class="edit-terms-and-conditions-button small-btn" onclick="Navigation.loadComponents('./all-faq-paragraphs.php?faqHeader=<?= $faqHeader->id; ?>');">
                    <div class="edit-terms-and-conditions-button-text">ALL PARAGRAPHS</div>
                </div>

                <div class="edit-terms-and-conditions-button small-btn" onclick="Navigation.loadComponents('./edit-faq-header-title.php?faqHeader=<?= $faqHeader->id; ?>');">
                    <div class="edit-terms-and-conditions-button-text">EDIT HEADER</div>
                </div>

                <?php
                    else:
                ?>
                    <div class="faq-page-image-header" style="background-image: url('<?= $faqHeader->image; ?>');"></div>
                <?php
                    endif;
                ?>

                <div class="editing-switch"  id="editing-switch-<?= $faqHeader->id; ?>"<?php
                        if(!$switchPos){
                            echo('style="
                                background-color: #979696;
                            "');
                        }
                ?> onclick="flipSwitch(<?= $switchPos ?>, 'switchForm<?= $faqHeader->id; ?>', 'editing-switch-<?= $faqHeader->id; ?>', 'editing-switch-btn-<?= $faqHeader->id; ?>');">
                        <div class="editing-switch-btn" id="editing-switch-btn-<?= $faqHeader->id; ?>"
                            <?php
                                if(!$switchPos){
                                    echo('style="
                                        right: 20%;
                                    "');
                                }
                            ?>
                        ><span class="editing-switch-btn-icon"></span></div>
                </div>

                <div class="moveUpBtn" onclick="window.location.href = 'functionality/order-faq-headers.php?faqOrder=<?= $faqHeader->order_of_info; ?>&pos=1'"></div>
                <div class="moveDownBtn" onclick="window.location.href = 'functionality/order-faq-headers.php?faqOrder=<?= $faqHeader->order_of_info; ?>&pos=-1'"></div>
                <div class="removeBtn" onclick="document.getElementById('remove-title-<?= $faqHeader->id; ?>').submit();"></div>
            </div>

            <form action="functionality/faqSwitchFlipper.php" id="switchForm<?= $faqHeader->id; ?>" method="POST">
                <input type="hidden" name="id" value="<?= $faqHeader->id; ?>">
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
