<html>
    <head>
        <?php
            require_once("includes/init.php");
            require_once("classes/DB.php");
            require_once("classes/Config.php");
            require_once("classes/CartEvent.php");
            include("includes/head.php");
        ?>    
        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Big+Shoulders+Text&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="./public/style/terms-and-conditions.css">
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

                    <div class="terms-and-conditions-menu">
                     <?php
                         $termsHeaders = DB::getInstance()->find('terms_and_conditions', [
                            'conditions' => 'live = 1',
                            'order' => 'order_of_conditions'
                        ]);
                        foreach($termsHeaders as $termHeader):
                     ?>
                    <a class="terms-and-conditions-menu-alt" href="#<?= $termHeader->id; ?>"><div class="dot"></div><?= $termHeader->title; ?></a>
                    <?php
                        endforeach;
                    ?>
                 </div>

                 <div class="terms-and-conditions-content">
                    <?php
                         $termsHeaders = DB::getInstance()->find('terms_and_conditions', [
                            'conditions' => 'live = 1',
                            'order' => 'order_of_conditions'
                        ]);
                        foreach($termsHeaders as $termHeader):
                            $paragraphArray = json_decode($termHeader->terms_conditions);
                     ?>
                     
                        <div class="terms-and-conditions-content-header">
                            <a name="<?= $termHeader->id; ?>"><?= $termHeader->title; ?></a>
                        </div>
                            <?php
                                foreach($paragraphArray as $paragraph):
                            ?>
                                <div class="terms-and-conditions-content-paragraph"><?= $paragraph; ?></div>
                            <?php
                                endforeach;
                            ?>

                    <?php
                        endforeach;
                    ?>
                 </div>
                 <?php include_once('includes/footer.php'); ?>
        </div>
    </div>        
    
    </body>

    </html>