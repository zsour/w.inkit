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
        <link rel="stylesheet" href="./public/style/dashboard.css">
        <title>w.inkit | All Products</title>
    </head>


<body>
    <div class="content" id="content">
        <div class="center-content" id="center-content">
                <div class="products-nav-container">
                    <div class="products-nav-logo" onclick="window.location.href = './';"></div>
                    <div class="products-nav-button-container">
                        <div class="products-nav-button" onclick="window.location.href = 'products';">
                            <div class="button-text">PRODUCTS</div>
                        </div> 
                        
                        <div class="products-nav-button" id="products-nav-button-about">
                            <div class="button-text">ABOUT</div>

                            <div class="products-nav-button-expand-container">
                                <div class="product-nav-button-expand-alt"  onclick="window.location.href = 'faq';"><p>FAQ</p></div>
                                <div class="product-nav-button-expand-alt"  onclick="window.location.href = 'about';"><p>About Me</p></div>
                                <div class="product-nav-button-expand-alt"  onclick="window.location.href = 'terms-and-conditions';"><p>Terms And Conditions</p></div>
                            </div>
                        </div> 

                        <div class="products-nav-button" onclick="window.location.href = 'contact';">
                            <div class="button-text">CONTACT</div>
                        </div> 
                    </div>

                    <div class="product-shopping-cart" onclick="window.location.href = 'cart';">
                    <?php
                                    if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])):
                                ?>
                                <div class="shopping-cart-notice"></div>
                                <?php
                                    endif;
                                ?>
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
                      
                        <div class="products-display-slideshow-left-btn-container">
                            <?php
                                if($singleImage):
                            ?>
                            <div class="products-display-slideshow-left-btn" id="leftSlideshowbtn" onclick="slideshow.slideshowMoveLeft();"></div>
                            <?php
                                endif;
                            ?>
                        </div>
                        
                            <div class="products-display-slideshow" id="slideshow">
                                <?php
                                    foreach($productImages as $showcaseImage):
                                    $showcaseImage = explode("../", $showcaseImage);
                                    $imgDimensions = getimagesize($showcaseImage[1]);
                                ?>
                                <div class="products-display-slideshow-img" style="background-image: url('<?= $showcaseImage[1]; ?>');" onclick="Modal.imgModal(<?= $imgDimensions[0]/1.8; ?>, <?= $imgDimensions[1]/1.8; ?>, '<?= $showcaseImage[1]; ?>', 'content')"></div>
                                <?php
                                    endforeach;
                                ?>
                            </div>
                        
                        <div class="products-display-slideshow-right-btn-container">
                            <?php
                                if($singleImage):
                            ?>
                            <div class="products-display-slideshow-right-btn" id="rightSlideshowbtn" onclick="slideshow.slideshowMoveRight();"></div>
                            <?php
                                endif;
                            ?>
                        </div>
                        


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
                            <div class="products-product" onclick="window.location.href='products.php?product_id=<?= $product->id; ?>';">
                                
                            <div class="products-product-img" style="background-image: url('<?= $showcaseImage; ?>')"> </div>

                            <div class="product-product-expand-container">
                                    <div class="product-product-expand-title"><?= $product->title; ?></div>

                                    <div class="product-product-expand-price-container">
                                        <?php
                                            if(isset($product->list_price) && $product->list_price > $product->price):
                                        ?>         
                                            <div class="product-product-expand-price" style="color: rgb(214, 60, 60);"><?= $product->price; ?> &euro;</div>
                                            <span class="product-product-expand-list-price"><?= $product->list_price; ?> &euro;</span>
                                        <?php
                                            else:
                                        ?>
                                            <div class="product-product-expand-price"><?= $product->price; ?> &euro;</div>
                                        <?php
                                            endif;
                                        ?>
                                    </div>
                            </div>
                        
                            </div>
                    <?php 
                            endforeach;
                        endif;  
                    ?> 

            
        </div>
        <?php include_once('includes/footer.php'); ?>
    </div>

    <div class="modal-background" id="modalBG" onclick="Modal.closeModal('content');">
        <div class="modal-content" id="modalContent">
            
        </div>
    </div>
</div>



<script src="./public/js/modal.js"></script>
</body>
</html>