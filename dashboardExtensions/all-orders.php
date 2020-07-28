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
        All Orders
    </div>

    <?php
            $db = DB::getInstance();
            $orders = $db->find('orders', [
                'conditions' => ['paid = 1', 'archived = 0']
            ]);  
            foreach($orders as $order):     
    ?>

    <div class="all-orders-container" id="<?= $order->id; ?>">
        <div class="all-orders-order">
                <div class="all-orders-order-id" id="order-<?= $order->id; ?>-button">
                <p class="order-title-text">Order: <?= $order->id; ?></p> 
        
                <?php
                    if($order->refunded == 1):
                ?>
                    <span class="refund-icon"></span>
                <?php
                    endif;
                ?>
                <span class="display-arrow all-orders-order-arrow" id="order-<?= $order->id; ?>-button-arrow"></span>
                </div>
               

        <div id="order-<?= $order->id; ?>" class="extended-info-container">
                <?php
                    $cart = json_decode($order->cart);
                    $priceCounter = 0;
                    $totalProductionValue = 0;
                    $productionValueCheck = false;
                    foreach($cart as $cartProduct):
                        $product = $db->findFirst('products', [
                            'conditions' => 'id = ?',
                            'bind' => [$cartProduct->id]
                        ]);  
                        $image = json_decode($product->image)[0];
                        $priceCounter += ($cartProduct->quantity * $product->price);
                        $totalProductionValue += ($cartProduct->quantity * $product->production_value);
                        if($product->production_value == 0){
                            $productionValueCheck = true;
                        }
                ?>

                <div class="all-orders-order-product">
                    <div class="all-orders-order-product-row">
                        <div class="all-orders-order-product-row-img-container">
                            
                            <div class="all-orders-order-product-row-img" style="
                                background-image: url('<?= $image;?>');
                                background-size: contain;
                                background-position: center;
                                background-repeat: no-repeat;
                            "></div>
                        </div>
                        <div class="all-orders-order-product-row-info">
                            
                                <div class="all-orders-order-product-row-info-alt">Product ID: <b><?= $product->id; ?></b></div>
                                <div class="all-orders-order-product-row-info-alt" style="overflow: hidden;">Product Title: <b><?= $product->title; ?></b></div>
                                <div class="all-orders-order-product-row-info-alt">Product Price: <b><?= $product->price; ?> &euro;</b></div>
                                <div class="all-orders-order-product-row-info-alt">Quantity In Stock: <b><?= $product->quantity; ?></b></div>
                                <div class="all-orders-order-product-row-info-alt">Quantity In Order: <b><?= $cartProduct->quantity; ?></b></div>
                           
                        </div>
                        <div class="all-orders-order-product-row-buttons">
                            <div class="all-orders-order-product-row-buttons-container">
                                <div class="all-orders-order-product-row-button">
                                   <div class="button-text-align">EDIT</div>
                                </div>

                                <div class="all-orders-order-product-row-button">
                                   <div class="button-text-align">REMOVE</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                    endforeach;
                ?>

                <div class="all-orders-customer-information-block">
                    <div class="all-orders-customer-information-block-alt">Customer Full Name: <b><?= $order->full_name; ?></b></div>
                    <div class="all-orders-customer-information-block-alt">Order ID: <b><?= $order->id; ?></b></div>
                    <div class="all-orders-customer-information-block-alt">Address: <b><?= $order->address; ?></b></div>
                    <div class="all-orders-customer-information-block-alt">City: <b><?= $order->city; ?></b></div>
                    <div class="all-orders-customer-information-block-alt">Country: <b><?= $order->country; ?></b></div>
                    <div class="all-orders-customer-information-block-alt">Zip: <b><?= $order->zip; ?></b></div>
                    <div class="all-orders-customer-information-block-alt">Email: <b><?= $order->email; ?></b></div>
                    <div class="all-orders-customer-information-block-alt">Current Order Status: <b class="green-text">Paid</b></div>
                    <div class="all-orders-customer-information-block-alt">Current Shipping Status: <b><?php
                        if($order->shipped == 1){
                            echo('Shipped');
                        }else{
                            echo('Processing');
                        }
                    ?></b></div>
                    <div class="all-orders-customer-information-block-alt">Total Order Cost: <b class="green-text"><?= $priceCounter; ?> &euro;</b></div>
                    <div class="all-orders-customer-information-block-alt">Total Product Production Value: <b class="red-text"> 
                        <?php
                            if($totalProductionValue > 0 && !$productionValueCheck){
                                echo($totalProductionValue);
                            }else{
                                echo('?');
                            }
                        
                        ?>
                    &euro;</b></div>
                    <div class="all-orders-customer-information-block-alt">Total Profit: <b class="green-text">
                    <?php
                            if($totalProductionValue > 0 && !$productionValueCheck){
                                echo($priceCounter - $totalProductionValue);
                            }else{
                                echo('?');
                            }
                        ?>
                    &euro;</b></div>
                    <div class="all-orders-customer-information-block-alt">Braintree ID: <b style="user-select: all; display: inline-block;"><?= $order->braintree_id ?></b></div>
                </div>


                <div class="all-orders-setup-buttons-container">

                <?php
                    if($order->refunded != 1):
                ?>
                    <form action="functionality/refund-order.php" method="post" id="refundOrder<?= $order->id; ?>">
                        <input type="hidden" name="orderId" value="<?= $order->braintree_id; ?>">
                    </form>
                  
                    <div class="all-orders-setup-buttons-button bg-red" onclick="document.getElementById('refundOrder<?= $order->id; ?>').submit();">
                        <div class="button-text-align">
                            REFUND/VOID
                        </div>
                    </div>
                <?php
                    endif;
                ?>
                
                    <div class="all-orders-setup-buttons-button">
                        <div class="button-text-align">EDIT INFORMATION</div>
                    </div>

                    <form action="./functionality/archive-order.php" method="post" id="order-restore<?= $order->id; ?>">
                            <input type="hidden" name="orderId" value="<?= $order->id; ?>">
                            <input type="hidden" name="archived" value="<?= $order->archived; ?>">
                    </form>
                    <div class="all-orders-setup-buttons-button" onclick="document.getElementById('order-restore<?= $order->id; ?>').submit()">
                        <div class="button-text-align">ARCHIVE</div>
                    </div>

                    <div class="all-orders-setup-buttons-button">
                        <div class="button-text-align">EMAIL CUSTOMER</div>
                    </div>

                    <div class="all-orders-setup-buttons-button important-button">
                        <div class="button-text-align">UPDATE SHIPPING STATUS</div>
                    </div>
                </div>

        </div>
        </div>
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


<script src="../public/js/jquery.js"></script>
<script src="../public/js/dashboard-nav.js"></script>
<script src="../public/js/modal.js"></script>
<script src="../public/js/order-buttons.js"></script>
