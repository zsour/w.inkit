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
                    if(!$order->refunded && $order->shipped == 1){
                        echo('<span class="order-complete-icon"></span>');
                    }else if($order->refunded && empty(json_decode($order->cart))){
                        echo('<span class="order-complete-icon"></span>');
                        echo('<span class="complete-refund-icon"></span>');
                    }else if($order->refunded && !empty(json_decode($order->cart))){
                        echo('<span class="refund-icon"></span>');
                        if($order->shipped == 0){
                            echo('<span class="shipping-icon"></span>');
                        }
                    }else if(!$order->refunded && $order->shipped == 0){
                        echo('<span class="shipping-icon"></span>');
                    }
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
                        $priceCounter += ($cartProduct->quantity * $cartProduct->priceDuringOrder);
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
                                <div class="all-orders-order-product-row-info-alt">Product Price During Order: <b><?= $cartProduct->priceDuringOrder; ?> &euro;</b></div>
                                <div class="all-orders-order-product-row-info-alt">Quantity In Stock: <b><?= $product->quantity; ?></b></div>
                                <div class="all-orders-order-product-row-info-alt">Quantity In Order: <b><?= $cartProduct->quantity; ?></b></div>
                           
                        </div>
                        <div class="all-orders-order-product-row-buttons">
                            <div class="all-orders-order-product-row-buttons-container">
                                <div class="all-orders-order-product-row-button" onclick="Navigation.loadComponents('./edit-order-cart-product.php?orderId=<?=$order->id;?>&productId=<?=$product->id;?>');">
                                   <div class="button-text-align">EDIT</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                    endforeach;
                    if($order->refunded):
                ?>
                <div class="refunds-header">
                    Refunds:
                </div>
                <?php
                    endif;
                    if($order->refunded):
                        $refunded = json_decode($order->refunded);
                        foreach($refunded as $cartProduct):
                            $refundedProduct = $db->findFirst('products', [
                                'conditions' => 'id = ?',
                                'bind' => [$cartProduct->id]
                            ]);  
                            $image = json_decode($refundedProduct->image)[0];
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
                                
                                    <div class="all-orders-order-product-row-info-alt">Product ID: <b><?= $refundedProduct->id; ?></b></div>
                                    <div class="all-orders-order-product-row-info-alt" style="overflow: hidden;">Product Title: <b><?= $refundedProduct->title; ?></b></div>
                                    <div class="all-orders-order-product-row-info-alt">Product Price During Order: <b><?= $cartProduct->priceDuringOrder; ?> &euro;</b></div>
                                    <div class="all-orders-order-product-row-info-alt">Quantity In Stock: <b><?= $refundedProduct->quantity; ?></b></div>
                                    <div class="all-orders-order-product-row-info-alt">Quantity Refunded: <b><?= $cartProduct->quantity; ?></b></div>
                            
                            </div>
                            <div class="all-orders-order-product-row-buttons">
                                <div class="all-orders-order-product-row-buttons-container">
                                 
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    endforeach;
                    endif;
                ?>
                <div class="all-orders-customer-information-block">
                    <div class="all-orders-customer-information-block-alt">Customer Full Name: <b><?= $order->full_name; ?></b></div>
                    <div class="all-orders-customer-information-block-alt">Order ID: <b><?= $order->id; ?></b></div>
                    <div class="all-orders-customer-information-block-alt">Address: <b><?= $order->address; ?></b></div>
                    <div class="all-orders-customer-information-block-alt">City: <b><?= $order->city; ?></b></div>
                    <div class="all-orders-customer-information-block-alt">Country: <b><?= $order->country; ?></b></div>
                    <div class="all-orders-customer-information-block-alt">Zip: <b><?= $order->zip; ?></b></div>
                    <div class="all-orders-customer-information-block-alt">Email: <b><?= $order->email; ?></b></div>
                    <div class="all-orders-customer-information-block-alt">Phone: <b><?= $order->phone; ?></b></div>
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
                                if(!$priceCounter){
                                    echo("Order Refunded - No Profit");
                                }else{
                                    echo($priceCounter - $totalProductionValue);
                                }
                            }else{
                                if(!$priceCounter){
                                    echo("Order Refunded - No Profit");
                                }else{
                                    echo('?');
                                } 
                            }
                        ?>
                    &euro;</b></div>
                    <div class="all-orders-customer-information-block-alt">Braintree ID: <b style="user-select: all; display: inline-block;"><?= $order->braintree_id ?></b></div>
                </div>


                <div class="all-orders-setup-buttons-container">

                <?php
                    if(!empty(json_decode($order->cart))):
                ?>
                    <form action="functionality/refund-order.php" method="post" id="refundOrder<?= $order->id; ?>">
                        <input type="hidden" name="orderId" value="<?= $order->braintree_id; ?>">
                    </form>
                  
                    <div class="all-orders-setup-buttons-button bg-red" onclick="Modal.securityCheckModal('refundOrder<?= $order->id; ?>', 'Are you sure you want to refund/void the complete order for <?= $priceCounter?>&euro;?');">
                        <div class="button-text-align">
                            REFUND/VOID
                        </div>
                    </div>
                <?php
                    endif;
                ?>
                    <form action="./edit-customer-information.php" method="post" id="edit-customer-information-<?= $order->id; ?>">
                        <input type="hidden" name="orderId" value="<?= $order->id; ?>">
                        <input type="hidden" name="fromHeader" value="0">
                    </form>

                    <div class="all-orders-setup-buttons-button" onclick="document.getElementById('edit-customer-information-<?= $order->id; ?>').submit();">
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

                    <?php
                        if($order->shipped == 0 && !empty(json_decode($order->cart))):
                    ?>
                    <div class="all-orders-setup-buttons-button important-button" onclick="Modal.sendShippingInfo(<?= $order->id; ?>);">
                        <div class="button-text-align">UPDATE SHIPPING STATUS</div>
                    </div>
                    <?php
                        endif;
                    ?>
                </div>

        </div>
        </div>
    </div>

    <?php
        endforeach;
    ?>

  
    
    </div>

    
    
</div>

<div class="modal-background" id="modalBG">
        <div class="modal-content" id="modalContent">
          
        </div>
</div>


<script src="../public/js/jquery.js"></script>
<script src="../public/js/dashboard-nav.js"></script>
<script src="../public/js/modal.js"></script>
<script src="../public/js/order-buttons.js"></script>
