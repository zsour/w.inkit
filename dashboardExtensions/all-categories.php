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
        All Categories
    </div>

    <div class="all-categories-container">
        <div class="all-categories-category" id="4421">
            <div class="all-categories-category-title" id="category-4421-button">
                    Category 1  <span class="display-arrow all-categories-category-arrow" id="category-4421-button-arrow"></span>
            </div>    
            
            <div id="category-4421" class="extended-info-container">
                <div class="all-categories-category-description" >
                    <div class="all-categories-category-description-title">Description:</div>
                    <div class="all-categories-category-description-text">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse 
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </div>
                    <div class="all-categories-category-description-buttons">
                        <div class="all-categories-category-description-buttons-button" onclick="Navigation.loadComponents('edit-category.php');"><div class="button-text-align">EDIT</div></div>
                        <div class="all-categories-category-description-buttons-button"><div class="button-text-align">REMOVE</div></div>
                    </div>
                </div>
            </div>
        </div>
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
<script src="../public/js/categories-buttons.js"></script>
