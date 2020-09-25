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
        <link rel="stylesheet" href="../public/style/about-page.css">
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

                        <div class="preview-exit" onclick="window.location.href = './about-page-edit.php';"></div>
                    </div>


                 <div class="about-page-content">
                    <?php
                         $aboutHeaders = DB::getInstance()->find('about', [
                            'order' => 'order_of_info'
                        ]);
                        foreach($aboutHeaders as $aboutHeader):
                            $paragraphArray = json_decode($aboutHeader->info_block);
                            if(empty($aboutHeader->image)):
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
                            else:
                        ?>

                        <div class="about-page-image" style="background-image: url('<?= $aboutHeader->image; ?>');"></div>
                    <?php
                        endif;
                        endforeach;
                    ?>
                 </div>
         </div>
    </div>
    </body>
    </html>