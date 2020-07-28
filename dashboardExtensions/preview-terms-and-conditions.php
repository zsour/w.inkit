<html>
    <head>
        <?php
             include_once("../includes/dashboardhead.php");
        ?>    

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../public/style/index.css">
        <link rel="stylesheet" href="../public/style/products.css">
        <link rel="stylesheet" href="../public/style/terms-and-conditions.css">
    </head>


<body>
    <div class="content">
        <div class="center-content" id="center-content">
                    <div class="products-nav-container">
                        <div class="products-nav-logo"></div>
                        <div class="products-nav-button-container">
                            <div class="products-nav-button">
                                <div class="button-text" style="white-space: nowrap;">PREVIEW MODE</div>
                            </div> 
                        </div>

                        <div class="preview-exit" onclick="window.location.href = './create-terms-and-conditions.php';"></div>
                    </div>

                 <div class="terms-and-conditions-menu">
                     <?php
                         $termsHeaders = DB::getInstance()->find('terms_and_conditions', [
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
         </div>
    </div>
    </body>

    </html>