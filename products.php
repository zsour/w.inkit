<?php
    require_once("includes/init.php");
    require_once("classes/DB.php");
    require_once("classes/Config.php");
    require_once("classes/CartEvent.php");

    if(isset($_POST) && isset($_POST['product_id']) && isset($_POST['product_quantity'])){
        $productID = sanitize($_POST['product_id']);
        $productQuantity = sanitize($_POST['product_quantity']);

        CartEvent::addToCart($productID, $productQuantity);
        header('Location: cart.php');
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
                    <div class="shopping-cart-notice" style="filter: invert(0%);"></div>
                    </div>
                </div>


            <div class="product-content">
                <?php if(isset($_GET['product_id'])): 
                        $db = DB::getInstance();
                        $product = $db->findFirst('products', [
                            'conditions' => "id = ?",
                            'bind' => [$_GET['product_id']]
                        ]);
                        $productImages = json_decode($product->image);
                        $singleImage = false;
                        if(count($productImages) > 1){
                            $singleImage = true;
                        }
                    ?>
                        
                        <div class="read-more-container">
                        <?php
                            if($singleImage):
                        ?>
                        <div class="products-display-slideshow-left-btn-container">
                            <div class="products-display-slideshow-left-btn"></div>
                        </div>
                        <?php
                            endif;
                        ?>
                            <div class="products-display-slideshow" id="slideshow">
                                <?php
                                    foreach($productImages as $showcaseImage):
                                    $showcaseImage = explode("../", $showcaseImage);
                                ?>
                                <div class="products-display-slideshow-img<?php
                                    if(!$singleImage){
                                        echo(' large-product-image');
                                    }
                                ?>" style="background-image: url('<?= $showcaseImage[1]; ?>');"></div>
                                <?php
                                    endforeach;
                                ?>
                            </div>
                        <?php
                            if($singleImage):
                        ?>
                        <div class="products-display-slideshow-right-btn-container">
                            <div class="products-display-slideshow-right-btn" onclick="slideShow.slideshowMoveRight();"></div>
                        </div>
                        <?php
                            endif;
                        ?>


                            <div class="read-more-buttons">
                                <div class="read-more-buttons-info">
                                    <div class="read-more-buttons-info-title"><?= sanitize($product->title); ?></div>
                                    <div class="read-more-buttons-info-price"><?= sanitize($product->price); ?> &euro;</div>
                                    <div class="read-more-buttons-info-desc"><?= sanitize($product->description); ?></div>
                                </div>

                                <div class="read-more-buttons-add-to-cart">
                                    <form action="products.php?product_id=<?= $product->id; ?>" method="POST" id="addToCartProductsID<?= $product->id ?>">
                                        <input type="hidden" name="product_id" value="<?= $product->id ?>">
                                        <input type="hidden" name="product_quantity" value="1" id="productQuantityHiddenInput">
                                    </form>
                                   
                                    <div class="add-to-cart-container">
                                        <div class="add-to-cart-less-btn" onclick="removeOne();"></div>
                                        <div class="add-to-cart-counter-display">
                                                <div class="button-text" id="add-to-cart-counter-text">1</div>
                                        </div>
                                        <div class="add-to-cart-more-btn" onclick="addOne();"></div>

                                        <script src="public/js/add-product-quantity-handler.js"></script>

                                        <div class="add-to-cart-button" onclick="document.getElementById('addToCartProductsID<?= $product->id ?>').submit();">
                                            <div class="add-to-cart-icon"></div>
                                            <div id="add-to-cart-text">Add to cart</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="product-description">
                                <div class="product-desc-header">
                                    <div class="product-desc-header-text">SPECIFICATION</div>
                                </div>

                                <div class="product-description-alt">
                                    <div class="product-description-alt-text">
                                        Width: <b><?= $product->width != 0 ? $product->width . " mm" : "Information Missing."; ?></b>
                                    </div>
                                </div>

                                <div class="product-description-alt">
                                    <div class="product-description-alt-text">
                                        Height: <b><?= $product->height != 0 ? $product->height . " mm" : "Information Missing."; ?></b>
                                    </div>
                                </div>

                                <div class="product-description-alt">
                                    <div class="product-description-alt-text">
                                        Weight: <b><?= $product->weight != 0 ? $product->weight . " kg" : "Information Missing."; ?></b>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                        <script src="public/js/slideshow.js"></script>
                    <?php
                        else:
                            $db = DB::getInstance();
                            $results = $db->find('products');
                            foreach($results as $product):
                                $productImages = json_decode($product->image);
                                $showcaseImage = explode("../", $productImages[0])[1];
                    ?>
                            <div class="products-product">
                                
                            <div class="products-product-img" style="background-image: url('<?= $showcaseImage; ?>')"> </div>

                            <div class="product-product-expand-container">
                                
                            </div>
                                <!--
                                <div class="products-product-button-container">
                                <form action="frontendFunctionality/addToCart.php" method="POST" id="addToCartProduct<?= $product->id; ?>">
                                    <input type="hidden" name="product_id" value="<?= $product->id; ?>">
                                </form>

                                <div class="products-product-add-to-cart" onclick="document.getElementById('addToCartProduct<?= $product->id; ?>').submit();">
                                <div class="products-product-add-to-cart-text">ADD TO CART</div>
                                </div>

                                <div class="products-product-read-more" onclick="window.location.href='products.php?product_id=<?= $product->id; ?>';">
                                <div class="products-product-read-more-text">READ MORE</div>
                                </div>
                                </div>-->
                            </div>
                    <?php 
                            endforeach;
                        endif;  
                    ?> 
        </div>
    </div>



</body>
</html>