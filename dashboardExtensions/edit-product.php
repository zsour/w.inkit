<?php
    include_once("../includes/dashboardhead.php");

    if(isset($_GET['product_id'])){
        $db = DB::getInstance();
        
        $product = $db->findFirst('products', [
            'conditions' => 'id = ?',
            'bind' => [$_GET['product_id']]
        ]);
    }else{
        header('Location: all-products.php');
    }
?>

<div class="background">
    <div class="dashboard-content" id="content">

    <?php 
        include_once("dashboard-sidebar.php");
    ?>

    <div class="center-components-background">
        <div class="center-components" id="center-components"> 
                    <div class="dashboardExtensionHeader">
                    Edit Product
                </div>

                <div class="form-container">

                <?php
                    if(isset($_GET['errors'])){
                                    foreach($_GET['errors'] as $error){
                                        $errorOutput = "<div class='error'>
                                                            <div id='error-text-center'>{$error}</div>
                                                        </div>";
                                        echo($errorOutput);
                                    }
                    }
                    ?>




                    <form method="POST" action="./functionality/functionality.edit-product.php" id="edit-products" enctype="multipart/form-data">
                        <div class="headerAboveInput">Product Name</div>
                        <input type="text"   id="product-title" name="product-title" placeholder="Type The Name Of Your Product" value="<?= (isset($product->title)) ? $product->title : ""; ?>">
                        <div class="headerAboveInput">Product Price</div>
                        <input type="number" id="product-price" name="product-price" placeholder="Type The Price Of Your Product - SEK" value="<?= (isset($product->price)) ? $product->price : ""; ?>">
                        <div class="headerAboveInput">Product List-Price</div>
                        <input type="number" id="product-list-price" name="product-list-price" placeholder="Type The List-Price Of Your Product (Optional) - SEK" value="<?= (isset($product->list_price)) ? $product->list_price : ""; ?>">
                        <div class="headerAboveInput">Product Quantity</div>
                        <input type="number" id="product-quantity" name="product-quantity" placeholder="Type The Quantity Of Your Product In Stock" value="<?= (isset($product->quantity)) ? $product->quantity : ""; ?>">
                        <div class="headerAboveInput">Product Width</div>
                        <input type="number" id="product-width" name="product-width" placeholder="Type The Width Of Your Product (Optional) - mm" value="<?= (isset($product->width)) ? $product->width : ""; ?>">
                        <div class="headerAboveInput">Product Height</div>
                        <input type="number" id="product-height" name="product-height" placeholder="Type The Height Of Your Product (Optional) - mm" value="<?= (isset($product->height)) ? $product->height : ""; ?>">
                        <div class="headerAboveInput">Product Weight</div>
                        <input type="number" id="product-weight" name="product-weight" placeholder="Type The Weight Of Your Product (Optional) - kg" value="<?= (isset($product->weight)) ? $product->weight : ""; ?>">
                        <div class="headerAboveInput">Product Production Value</div>
                        <input type="number" id="product-production-value" name="product-production-value" placeholder="Type The Production Value Of Your Product (Optional) - SEK" value="<?= (isset($product->production_value)) ? $product->production_value : ""; ?>">
                        <input type="hidden" name="product-id" value="<?= $product->id; ?>">

                        <div class="headerAboveInput">Product Description</div>
                        <textarea name="product-description" id="product-description" cols="30" rows="10" placeholder="Type A Few Words About Your Product (Optional)"><?= (isset($product->description)) ? trim($product->description) : ""; ?></textarea>

                        <div class="headerAboveInput">Upload Images</div>
                        <input type="file" name="product-images[]" id="product-images" multiple="multiple" style="margin-bottom: 10px;"> 

                        <input type="hidden" name="product-image-array" id="imageArray" value='<?= $product->image; ?>'>
                        <input type="hidden" name="product-removed-image-array" id="removedImageArray" value='[]'>

                        <div class="image-gallery" id="imageGallery">
                            <?php
                                $images = json_decode($product->image);
                                for($i = 0; $i < count($images); $i++):
                                    $imgDimensions = getimagesize($images[$i]);
                            ?>
                                <div class="image" id="image<?= $i; ?>" style="background-image:url('<?= $images[$i]; ?>')"><div class="remove-image" onclick="removeImage('<?= $images[$i]; ?>', <?= $i; ?>)"></div></div>
                            <?php
                                endfor;                            
                            ?>    
                        </div>
                        


                        <div id="submit-btn" onclick="document.getElementById('edit-products').submit();">
                            <div class="submit-text-center">Edit Product</div>
                        </div>

                        
                        

                    </form>
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
<script src="../public/js/edit-product-images.js"></script>



