<?php
    include_once("../includes/dashboardhead.php");
    include_once("../generateGateway.php");
    $refundCheck = false;
    if(isset($_GET['orderId']) && isset($_GET['productId'])){
        $currentProduct = DB::getInstance()->findFirst('products', array(
            'conditions' => 'id = ?',
            'bind' => [$_GET['productId']]
        ));
        $image = json_decode($currentProduct->image)[0];
        $currentOrder = DB::getInstance()->findFirst('orders', array(
            'conditions' => 'id = ?',
            'bind' => [$_GET['orderId']]
        ));

        $transactionStatus = $gateway->transaction()->find($currentOrder->braintree_id)->status;
        
        if($transactionStatus == "settling" || $transactionStatus == "settled"){
            $refundCheck = true;
        }


        if($currentProduct && $currentOrder){
            $cart = json_decode($currentOrder->cart);
            $currentAmountInCart = 0;
            $priceDuringOrder = 0;
            foreach($cart as $item){
                if($item->id == $_GET['productId']){
                    $currentAmountInCart = $item->quantity;
                    $priceDuringOrder = $item->priceDuringOrder;
                }
            }
           

            if($currentAmountInCart == 0 || $priceDuringOrder == 0){
               header('Location: ./all-orders.php');
            }
        }else{
            header('Location: ./all-orders.php');
        }
    }else{
        header('Location: ./all-orders.php');
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
                Edit Order Cart Product
            </div>
            <div id="errorContainer">
                <?php
                    if(!$refundCheck){
                        $errorOutput = "<div class='error'>
                                                    <div id='error-text-center' style='white-space: nowrap;'>You can't edit your order - the transaction isn't settled yet.</div>
                                        </div>";
                        echo($errorOutput);
                    }
                ?>
            </div>
            
            <div class="product-to-edit-container">
                <div class="product-to-edit-img" style="background-image: url('<?= $image; ?>');"></div>
                <div class="product-to-edit-info-container">
                    <div class="product-to-edit-info-block">
                        <p class="product-to-edit-info-block-text">Product ID: <?= $currentProduct->id; ?></p>
                    </div>
                    <div class="product-to-edit-info-block">
                        <p class="product-to-edit-info-block-text">Current Price: <?= $currentProduct->price; ?></p>
                    </div>
                    <div class="product-to-edit-info-block">
                        <p class="product-to-edit-info-block-text">Current List Price: <?= 
                        $currentProduct->list_price == 0 ? "None" : $currentProduct->list_price; ?>
                        </p>
                    </div>
                    <div class="product-to-edit-info-block">
                        <p class="product-to-edit-info-block-text">Price When Ordered: <?= $priceDuringOrder; ?></p>
                    </div>
                </div>
                
                <div class="dashboardExtensionHeader" style="margin-top: 20px;
                     <?php
                        if(!$refundCheck){
                            echo("opacity: 0.6");
                        }
                    ?>
                ">
                Current Quantity In Order (Remove Only):
                </div>
                <form action="./functionality/functionality.edit-order-cart-product.php" id="form-to-update-product-in-cart">
                    <input type="hidden" name="oldPrice" id="oldPrice" value="<?= $priceDuringOrder; ?>">
                    <input type="hidden" name="oldQuantity" id="oldQuantity" value="<?= $currentAmountInCart; ?>">
                    <input type="number" name="newQuantity" id="newQuantity" value="<?= $currentAmountInCart; ?>"
                        <?php
                            if(!$refundCheck){
                                echo("style='pointer-events: none; opacity: 0.6;'");
                            }
                        ?>
                    >
                </form>
                
                <div class="save-changes-btn" id="save-changes"
                    <?php
                        if(!$refundCheck){
                            echo("style='pointer-events: none; opacity: 0.6;'");
                        }
                    ?>
                >
                    <div class="save-changes-text">SAVE CHANGES</div>
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
<script src="../public/js/edit-order-cart-product-quanity.js"></script>
