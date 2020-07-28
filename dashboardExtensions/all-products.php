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
        All Products
    </div>

   <div class="all-products-container">
    <?php
        $db = DB::getInstance();
        $results = $db->find('products');
        foreach($results as $product):
            $productImages = json_decode($product->image);
    ?>
        <div class="all-products-product">
            <div class="all-products-product-title"><span class="placeholder-information">Title:</span><?= $product->title; ?></div>
            <div class="all-products-product-price"><span class="placeholder-information">Price (Euro &euro;):</span><?= $product->price; ?></div>
            <div class="all-products-product-list-price"><span class="placeholder-information">List-Price (Euro &euro;):</span><?= $product->list_price; ?></div>
            <div class="all-products-product-quantity"><span class="placeholder-information">Quantity:</span><?= $product->quantity; ?></div>
            <div class="all-products-product-width"><span class="placeholder-information">Width (mm):</span><?= $product->width; ?></div>
            <div class="all-products-product-height"><span class="placeholder-information">Height (mm):</span><?= $product->height; ?></div>
            <div class="all-products-product-weight"><span class="placeholder-information">Weight (kg):</span><?= $product->weight; ?></div>
            <div class="all-products-product-production-value"><span class="placeholder-information">Production Value (Euro &euro;):</span><?= $product->production_value; ?></div>

            <div class="all-products-img-and-buttons-container">
                <div class="all-products-buttons">
                    <div class="all-products-edit" onclick="Navigation.loadComponents('edit-product.php?product_id=<?= $product->id; ?>');">
                        <div class="button-text">Edit</div>
                    </div>
                    <div class="all-products-remove" onclick="document.getElementById('remove-product-<?= $product->id; ?>').submit()">
                        <form action="functionality/remove-product.php" method="post" id="remove-product-<?= $product->id; ?>">
                            <input type="hidden" value="<?= $product->id; ?>" name="product-id">
                        </form>
                        <div class="button-text">Remove</div>
                    </div>
                </div>

                <div class="all-products-img-icons">
                        <?php
                           

                            for($i = 0; $i < count($productImages); $i++):
                                $imgDimensions = getimagesize($productImages[$i]);
                                if($i < 4):
                        ?>

                                    <div class="all-products-img-icon" onclick="Modal.imgModal(<?= $imgDimensions[0] / 2; ?>, <?= $imgDimensions[1] / 2; ?>, '<?= $productImages[$i]; ?>');"
                                    style="background-image:url('<?= $productImages[$i]; ?>'")></div>

                        <?php              
                            else:
                                break;
                            
                            endif;
                            
                            endfor;
                        ?>
                </div>
            </div>
            <?php
                if(count($productImages) > 4):
            ?>

            <div class="otherImg">
                <div class="button-text" id="otherImgText">+<?=(count($productImages) - 4)?></div>
            </div>

            <?php
                endif;
            ?>
            <div class="all-products-product-descripiton"></div>
        </div>

    <?php
        endforeach;
        $productImages = array();
    ?> 
   </div>


        </div>
    </div>

    
    
    </div>
    
    <div class="modal-background" id="modalBG" onclick="Modal.closeModal();">
        <div class="modal-content" id="modalContent">
            
        </div>
    </div>
</div>


<script src="../public/js/jquery.js"></script>
<script src="../public/js/dashboard-nav.js"></script>
<script src="../public/js/modal.js"></script>
