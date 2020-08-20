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

        <link rel="stylesheet" href="./public/style/about-page.css">
        <title>w.inkit | About</title>
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


                    <div class="about-page-content">
                    <?php
                         $aboutHeaders = DB::getInstance()->find('about', [
                            'conditions' => 'live = ?',
                            'bind' => [1],
                            'order' => 'order_of_info'
                        ]);
                        foreach($aboutHeaders as $aboutHeader):
                            $paragraphArray = json_decode($aboutHeader->info_block);
                     ?>
                     
                        <div class="about-content-header">
                            <p class="about-header-text"><?= $aboutHeader->title; ?></p>
                        </div>
                  

                         <div class="about-paragraph-content">
                            <?php
                                foreach($paragraphArray as $paragraph):
                            ?>
                                <div class="about-paragraph"><?= $paragraph; ?></div>
                            <?php
                                endforeach;
                            ?>
                        </div>
                    <?php
                        endforeach;
                    ?>
                 </div>
                 <?php include_once('includes/footer.php'); ?>
        </div>
    </div>        
    
    </body>

    </html>