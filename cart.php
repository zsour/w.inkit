<?php
    require_once("includes/init.php");
    require_once("classes/DB.php");
    require_once("classes/Config.php");
    require_once("classes/CartEvent.php");
    require_once("classes/Session.php");

    $fullname = isset($_POST['full_name']) ? $_POST['full_name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $zip = isset($_POST['zip']) ? $_POST['zip'] : '';
    $country = isset($_POST['country']) ? $_POST['country'] : '';
    $city = isset($_POST['city']) ? $_POST['city'] : '';
    
   
    
    if(!empty($_POST['full_name']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['address']) &&
       !empty($_POST['zip']) && !empty($_POST['country']) && !empty($_POST['city']) && !empty($_SESSION['cart'])){
       
        if(empty($_SESSION['order_id'])){
            $uniqueId = uniqid();
        
            DB::getInstance()->insert('orders', array(
                'cart' => json_encode($_SESSION['cart']),
                'full_name' => $_POST['full_name'],
                'email' => $_POST['email'],
                'country' => $_POST['country'],
                'city' => $_POST['city'],
                'phone' => $_POST['phone'],
                'zip' => $_POST['zip'],
                'address' => $_POST['address'],
                'unique_id' => $uniqueId
            ));
    
            $_SESSION['order_id'] = $uniqueId;
        }else{
            $order = DB::getInstance()->findFirst('orders', [
                'conditions' => "unique_id = ?",
                'bind' => [$_SESSION['order_id']]
            ]);


            DB::getInstance()->update('orders', $order->id, array(
                'cart' => json_encode($_SESSION['cart']),
                'full_name' => $_POST['full_name'],
                'email' => $_POST['email'],
                'country' => $_POST['country'],
                'city' => $_POST['city'],
                'phone' => $_POST['phone'],
                'zip' => $_POST['zip'],
                'address' => $_POST['address'],
                'unique_id' => $_SESSION['order_id']
            ));
        }
        
        $_POST = array();

        header('Location: payment.php');
    }

    ?>
<html>
    <head>
        <?php
            include("includes/head.php");
        ?>    
        
    </head>


<body>
    <div class="content">
        <div class="center-content" id="center-content">
                    <div class="products-nav-container">
                        <div class="products-nav-logo" onclick="window.location.href = './';"></div>
                        <div class="products-nav-button-container">
                            <div class="products-nav-button" onclick="window.location.href = 'products';">
                                <div class="button-text">PRODUCTS</div>
                            </div> 
                            
                            <div class="products-nav-button" onclick="window.location.href = 'about';">
                                <div class="button-text">ABOUT</div>
                            </div> 

                            <div class="products-nav-button" onclick="window.location.href = 'contact';">
                                <div class="button-text">CONTACT</div>
                            </div> 
                        </div>

                        <div class="product-shopping-cart" onclick="window.location.href = 'cart';">
                                <?php
                                    if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])):
                                ?>
                                <div class="shopping-cart-notice" style="filter: invert(0%);"></div>
                                <?php
                                    endif;
                                ?>
                        
                        </div>
                    </div>


            <div class="cart-container">
                <?php 
                    if(count($_SESSION['cart']) == 0):
                ?>
                    <div class="cart-container-header"> 
                        <div class="cart-container-header-text">Your shopping cart is empty</div>
                    </div>

                <?php
                    else:
                ?>
                <div class="cart-product-container">
                    <?php   
                        foreach($_SESSION['cart'] as $cartProduct):
                            $db = DB::getInstance();
                            $product = $db->findFirst('products', [
                                'conditions' => "id = ?",
                                'bind' => [$cartProduct['id']]
                            ]);
                            $productImages = json_decode($product->image);
                            $showcaseImage = explode("../", $productImages[0])[1];
                    ?>
                    <div class="cart-product">
                        <div class="cart-product-image-container">
                            <div class="cart-product-image-image" style="background-image: url('<?= $showcaseImage; ?>');"></div>
                        </div>

                        <div class="cart-product-title-container">
                            <div class="cart-product-title"><?= sanitize($product->title); ?></div>
                        </div>

                        <div class="cart-product-quantity-container">
                        <div class="cart-product-quantity">
                            <form  id="cartAddProduct<?= sanitize($product->id); ?>" method="POST" action="frontendFunctionality/addToCart.php";>
                                <input type="hidden" name="product_id" value="<?= sanitize($product->id); ?>">
                            </form>

                            <form id="cartRemoveProduct<?= sanitize($product->id); ?>" method="POST" action="frontendFunctionality/removeFromCart.php";>
                                <input type="hidden" name="product_id" value="<?= sanitize($product->id); ?>">
                            </form>

                            <form id="cartDeleteProduct<?= sanitize($product->id); ?>" method="POST" action="frontendFunctionality/deleteFromCart.php";>
                                <input type="hidden" name="product_id" value="<?= sanitize($product->id); ?>">
                            </form>

                                <div class="cart-product-quantity-minus" onclick="document.getElementById('cartRemoveProduct<?= sanitize($product->id); ?>').submit();"></div>
                                <div class="cart-product-quantity-num">
                                    <div class="cart-product-quantity-num-text"><?= $cartProduct['quantity']; ?></div>
                                </div>
                                <div class="cart-product-quantity-plus" onclick="document.getElementById('cartAddProduct<?= sanitize($product->id); ?>').submit();"></div>

                                <div class="cart-product-quantity-remove" onclick="document.getElementById('cartDeleteProduct<?= sanitize($product->id); ?>').submit();"></div>
                        </div>

                            <div class="cart-product-quantity-price">
                                <div class="cart-product-quantity-price-text"><?= sanitize($product->price); ?> &euro; (price ea)</div>
                            </div>
                        </div>
                    </div>

                    <?php
                        endforeach;
                    ?>

            
                    <div class="cart-payment-information">
                        <?php
                            $productPriceCalculation = 0;
                            $totalPriceCalculation = 0;
                            $taxCalculation = 0;
                            foreach($_SESSION['cart'] as $cartProduct){
                                $db = DB::getInstance();
                                $product = $db->findFirst('products', [
                                    'conditions' => "id = ?",
                                    'bind' => [$cartProduct['id']]
                                ]);

                               
                                $productPriceCalculation += ($cartProduct['quantity'] * $product->price);
                            }

                            $totalPriceCalculation = $productPriceCalculation;
                            $taxCalculation = $totalPriceCalculation * 0.12;
                        ?>
                        <div class="cart-payment-information-textbox">
                            Shipping: Free
                        </div>
                        <div class="cart-payment-information-textbox">
                            Tax (12%): <?= sanitize(number_format($taxCalculation, 2)); ?> &euro;
                        </div>

                        <div class="cart-payment-information-textbox">
                            Total: <?= sanitize(number_format($totalPriceCalculation, 2)); ?> &euro;
                        </div>
                    </div>
                </div>

                <div class="cart-checkout-container">
                    <div class="cart-checkout-container-header">
                        <div class="cart-checkout-container-header-text">Check out</div>
                    </div>
                        <form action="cart.php" method="POST" id="cartForm">

                            <div class="cart-input-header">Full Name:</div>
                            <input type="text" class="cart-input-field" placeholder="Type your full name..."  spellcheck="false" name="full_name" value="<?= $fullname; ?>"
                            <?php
                                if(empty($fullname) && isset($_POST['full_name'])){
                                    echo('style="border: red solid 2px;"');
                                }
                            ?>>
                            <div class="cart-input-header">Email:</div>
                            <input type="text" class="cart-input-field" placeholder="Type your email..."  spellcheck="false" name="email" value="<?= $email; ?>"
                            <?php
                                if(empty($email) && isset($_POST['email'])){
                                    echo('style="border: red solid 2px;"');
                                }
                            ?>
                            >
                            <div class="cart-input-header">Address:</div>
                            <input type="text" class="cart-input-field" placeholder="Type your address..."  spellcheck="false" name="address" value="<?= $address; ?>"
                            <?php
                                if(empty($address) && isset($_POST['address'])){
                                    echo('style="border: red solid 2px;"');
                                }
                            ?>
                            > 
                            <div class="cart-input-header">Zip Code:</div>
                            <input type="text" class="cart-input-field" placeholder="Type your zip code..."  spellcheck="false" name="zip" value="<?= $zip; ?>"
                            <?php
                                if(empty($zip) && isset($_POST['zip'])){
                                    echo('style="border: red solid 2px;"');
                                }
                            ?>
                            >
                            <div class="cart-input-header">Country:</div>
                            <input type="text" class="cart-input-field" placeholder="Type your country..."  spellcheck="false" name="country" value="<?= $country; ?>"
                            <?php
                                if(empty($country) && isset($_POST['country'])){
                                    echo('style="border: red solid 2px;"');
                                }
                            ?>
                            > 
                            <div class="cart-input-header">City:</div>
                            <input type="text" class="cart-input-field" placeholder="Type your city..."  spellcheck="false" name="city" value="<?= $city; ?>"
                            <?php
                                if(empty($city) && isset($_POST['city'])){
                                    echo('style="border: red solid 2px;"');
                                }
                            ?>
                            >
                            <div class="cart-input-header">Phone:</div>
                            <input type="text" class="cart-input-field" placeholder="Type your phone number..."  spellcheck="false" name="phone" value="<?= $phone; ?>"
                            <?php
                                if(empty($phone) && isset($_POST['phone'])){
                                    echo('style="border: red solid 2px;"');
                                }
                            ?>
                            >

                            <div class="cart-checkout-continue">
                                <div class="cart-checkout-continue-accept-policy">  
                                    <input type="checkbox" class="cart-input-checkbox" id="policy-checkbox">
                                    <div class="cart-checkout-continue-accept-policy-text">I accept the Terms and Conditions</div>
                                </div>

                                <div class="cart-checkout-continue-button" id="checkout-btn" onclick="document.getElementById('cartForm').submit();">
                                    <span class="cart-checkout-continue-button-icon"></span>
                                    <div class="cart-checkout-continue-button-text">Payment</div>
                                </div>               
                            </div>
                            <script src="public/js/accept-policy.js"></script>
                        </form>
                </div>
                <?php
                    endif;
                ?>
            </div>



        </div>
    </div>
</body>
</html>