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
                Add Category
            </div>

            <div class="form-container">
                <form>
                    <input type="text" id="category-title" name="category-title" placeholder="Category Title">
                    <textarea name="category-description" id="category-description" cols="30" rows="10" placeholder="Description (Optional)"></textarea>

                    <div id="submit-btn">
                        <div class="submit-text-center">Create Category</div>
                    </div>

                   <!-- <div class="error">
                        <div id="error-text-center">Error: No product title</div>
                    </div> -->

                </form>
            </div>
    
        </div>
    
    </div>

    <div class="modal-background" id="modalBG" onclick="Modal.closeModal();">
        <div class="modal-content" id="modalContent">
            
        </div>
    </div>
    
    </div>
    
</div>


<script src="../public/js/jquery.js"></script>
<script src="../public/js/dashboard-nav.js"></script>
<script src="../public/js/modal.js"></script>
