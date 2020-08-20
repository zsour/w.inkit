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
            Index Products
        </div>


        <?php
         $products = DB::getInstance()->find('products', [
             'order' => 'order_of_product'
             ]);
         foreach($products as $product):
             $switchPos = $product->live == 0 ? 0 : 1;
    
        ?>


        <div class="index-products-container">
            <div class="index-products-product">
                <div class="index-products-product-title"><?= $product->title; ?></div>


                <div class="editing-switch"  id="editing-switch-<?= $product->id; ?>"<?php
                        if(!$switchPos){
                            echo('style="
                                background-color: #979696;
                            "');
                        }
                ?> onclick="flipSwitch(<?= $switchPos ?>, 'switchForm<?= $product->id; ?>', 'editing-switch-<?= $product->id; ?>', 'editing-switch-btn-<?= $product->id; ?>');">
                        <div class="editing-switch-btn" id="editing-switch-btn-<?= $product->id; ?>"
                            <?php
                                if(!$switchPos){
                                    echo('style="
                                        right: 20%;
                                    "');
                                }
                            ?>
                        ><span class="editing-switch-btn-icon"></span></div>
                </div>

                <div class="moveUpBtn" style="width: 50px; height: 50px;" onclick="window.location.href = 'functionality/order-index-products.php?productOrder=<?= $product->order_of_product; ?>&pos=1'"></div>
                <div class="moveDownBtn"  style="width: 50px; height: 50px;" onclick="window.location.href = 'functionality/order-index-products.php?productOrder=<?= $product->order_of_product; ?>&pos=-1'"></div>
            </div>


            <form action="functionality/index-product-flipper.php" id="switchForm<?= $product->id; ?>" method="POST">
                <input type="hidden" name="id" value="<?= $product->id; ?>">
                <input type="hidden" name="pos" value="<?= $switchPos; ?>">
            </form>
        </div>

        <?php
            endforeach;
        ?>
    
    </div>
    </div>
    
    </div>
    
</div>

<script src="../public/js/terms-and-conditions-switches.js"></script>
<script src="../public/js/jquery.js"></script>
<script src="../public/js/dashboard-nav.js"></script>
<script src="../public/js/modal.js"></script>
