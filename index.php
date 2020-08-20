
<?php
    require_once("includes/init.php");
    require_once("classes/DB.php");
    require_once("classes/Config.php");
?>
<html>
    <head>
        <?php
            include("includes/head.php");
        ?>    
        <title>w.inkit | Prints By Malin Wejrot</title>
    </head>


        <body>
        <div class="content">
        <div class="nav-logo"></div>
            <div class="center-content" id="center-content">
                <div class="index-nav">
                            <div class="nav-button-container">
                                    <a class="nav-button" href="./products">
                                        <div class="button-text">PRODUCTS</div>
                                    </a>

                                    <a class="nav-button" href="./about">
                                        <div class="button-text">ABOUT</div>
                                    </a>

                                    <a class="nav-button" href="./contact">
                                        <div class="button-text">CONTACT</div>
                                    </a>
                                    
                            </div>

                            <div class="index-shopping-cart" onclick="window.location.href = 'cart';">
                                <?php
                                    if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])):
                                ?>
                                <div class="shopping-cart-notice"></div>
                                <?php
                                    endif;
                                ?>
                            </div>
                </div>


                    <div class="load-content-container">
                        <div class="showcase-container">
                            <div class="showcase-img-overlay"></div>
                            <div class="showcase-img"></div>
                            <div class="showcase-title">W.INKIT</div>
                            <div class="showcase-description">PRINTS BY MALIN WEJROT</div>
                        </div>

                       

                        <div class="product-container">

                        <?php
                            $db = DB::getInstance();
                            $results = $db->find('products', [
                                'conditions' => 'live = 1',
                                'order' => 'order_of_product'
                            ]);
                            foreach($results as $product):
                                $productImages = json_decode($product->image);
                                $showcaseImage = explode("../", $productImages[0])[1];                        
                        ?>

                            <div class="product">
                                <div class="product-img" style="background-image: url('<?= $showcaseImage; ?>')" onclick="window.location.href = './products?product_id=<?= $product->id; ?>'; "></div>

                                <div class="product-title" onclick="window.location.href = './products?product_id=<?= $product->id; ?>'; "><?= $product->title; ?></div>
                                <div class="product-price">
                                <?php
                                    if($product->list_price > 0 && $product->list_price > $product->price):
                                ?>
                                    <div class="product-list-price"><?= $product->price; ?> &euro;</div> 
                                    <div style="font-size: 18px; text-decoration: line-through; display: inline-block; vertical-align: top;"><?= $product->list_price; ?> &euro;</div> 
                                <?php
                                    else:
                                ?>
                                    <?= $product->price; ?> &euro;
                                <?php
                                    endif;
                                ?>
                                </div>
                                

                                <form action="frontendFunctionality/addToCart.php" method="POST" id="addToCartProduct<?= $product->id; ?>">
                                    <input type="hidden" name="product_id" value="<?= $product->id; ?>">
                                </form>

                                <div class="product-add-to-cart"  onclick="document.getElementById('addToCartProduct<?= $product->id; ?>').submit();">
                                    <div class="product-add-to-cart-text">ADD TO CART</div>
                                </div>
                            </div>

                        <?php
                            endforeach;
                        ?>
                        </div>
                    </div>
               
                    <?php include_once('includes/footer.php'); ?>
            </div>
        </div>
        <script src="public/js/jquery.js"></script>
        </body>

</html>