<?php
    include_once("../includes/dashboardhead.php");
    $validation = new Validate();
    $fileValidation = new Validate();
    if(!empty($_POST)){
       
        $productTitle = (isset($_POST['product-title'])) ? $_POST['product-title'] : ""; 
        $productPrice = (isset($_POST['product-price'])) ? $_POST['product-price'] : 0; 
        $productListPrice = (isset($_POST['product-list-price'])) ? $_POST['product-list-price'] : 0; 
        $productQuantity = (isset($_POST['product-quantity'])) ? $_POST['product-quantity'] : 0; 
        $productWidth = (isset($_POST['product-width'])) ? $_POST['product-width'] : 0; 
        $productHeight = (isset($_POST['product-height'])) ? $_POST['product-height'] : 0; 
        $productWeight = (isset($_POST['product-weight'])) ? $_POST['product-weight'] : 0; 
        $productProductionValue = (isset($_POST['product-production-value'])) ? $_POST['product-production-value'] : 0; 
        $productDescription = (isset($_POST['product-description'])) ? $_POST['product-description'] : ""; 
        

        $validation->check($_POST, array(
            'product-title' => array(
                'required' => true
            ),

            'product-price' => array(
                'required' => true
            ),

            'product-list-price' => array(
                
            ),

            'product-quantity' => array(
                'required' => true
            ),

            'product-width' => array(
                
            ),

            'product-height' => array(
                
            ),

            'product-weight' => array(
                
            ),

            'product-production-value' => array(
                
            ),

            'product-description' => array(
                
            )
            ));

            $fileValidation->Check($_FILES, array(
                'product-images' => array(
                    'imgRequired' => true,
                    'imgCheck' => true
                )
            ));

            if($validation->passed() && $fileValidation->passed()){
                $nameList = isset($_FILES['product-images']['name']) ? $_FILES['product-images']['name'] : array();
                $numberOfFilesUploaded = count($nameList);
                
                $productImgArray = array();
                
                for($i = 0; $i < $numberOfFilesUploaded; $i++){
                    $fileName = $_FILES['product-images']['name'][$i];
                    $fileTmpName = $_FILES['product-images']['tmp_name'][$i];
                    $fileExt = explode('.', $fileName);
                    $fileActualExt = strtolower(end($fileExt));

                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                    $fileDestination = '../public/img/uploadedImages/' . $fileNameNew;

                    move_uploaded_file($fileTmpName, $fileDestination);

                    $productImgArray[] = $fileDestination;
                }

                $productImages = json_encode($productImgArray);

                date_default_timezone_set("Europe/Stockholm");
                $date = date('Y/m/d H:i:s', time());


                $max = DB::getInstance()->query("SELECT MAX( order_of_product ) AS max FROM `products`;")->results()[0]->max;
                $orderInDb = $max + 1;

                DB::getInstance()->insert('products', array(
                    'title' => $_POST['product-title'],
                    'price' => $_POST['product-price'],
                    'list_price' => $_POST['product-list-price'],
                    'quantity' => $_POST['product-quantity'],
                    'width' => $_POST['product-width'],
                    'height' => $_POST['product-height'],
                    'weight' => $_POST['product-weight'],
                    'production_value' => $_POST['product-production-value'],
                    'description' => $_POST['product-description'],
                    'image' => $productImages,
                    'created' => $date,
                    'updated' => $date,
                    'order_of_product' => $orderInDb
                ));
                $_POST = array();
                $_FILES = array();
                header("Location: all-products.php");
            }
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
                    Add Product
                </div>

                <div class="form-container">
                    <?php
                        if(!empty($validation->errors())){
                                    foreach($validation->errors() as $error){
                                        $errorOutput = "<div class='error'>
                                                            <div id='error-text-center'>{$error}</div>
                                                        </div>";
                                        echo($errorOutput);
                                    }
                        }         
                        
                        if(!empty($fileValidation->errors())){
                            foreach($fileValidation->errors() as $error){
                                $errorOutput = "<div class='error'>
                                                    <div id='error-text-center'>{$error}</div>
                                                </div>";
                                echo($errorOutput);
                            }
                        }   
                    ?>

                    <form method="POST" action="add-products.php" id="add-products" enctype="multipart/form-data">
                        <div class="headerAboveInput">Product Name</div>
                        <input type="text"   id="product-title" name="product-title" placeholder="Type The Name Of Your Product" value="<?= (isset($_POST['product-title'])) ? $_POST['product-title'] : ""; ?>">
                        <div class="headerAboveInput">Product Price</div>
                        <input type="number" id="product-price" name="product-price" placeholder="Type The Price Of Your Product - &euro;" value="<?= (isset($_POST['product-price'])) ? $_POST['product-price'] : ""; ?>">
                        <div class="headerAboveInput">Product List-Price</div>
                        <input type="number" id="product-list-price" name="product-list-price" placeholder="Type The List-Price Of Your Product (Optional) - &euro;" value="<?= (isset($_POST['product-list-price'])) ? $_POST['product-list-price'] : ""; ?>">
                        <div class="headerAboveInput">Product Quantity</div>
                        <input type="number" id="product-quantity" name="product-quantity" placeholder="Type The Quantity Of Your Product In Stock" value="<?= (isset($_POST['product-quantity'])) ? $_POST['product-quantity'] : ""; ?>">
                        <div class="headerAboveInput">Product Width</div>
                        <input type="number" id="product-width" name="product-width" placeholder="Type The Width Of Your Product (Optional) - mm" value="<?= (isset($_POST['product-width'])) ? $_POST['product-width'] : ""; ?>">
                        <div class="headerAboveInput">Product Height</div>
                        <input type="number" id="product-height" name="product-height" placeholder="Type The Height Of Your Product (Optional) - mm" value="<?= (isset($_POST['product-height'])) ? $_POST['product-height'] : ""; ?>">
                        <div class="headerAboveInput">Product Weight</div>
                        <input type="number" id="product-weight" name="product-weight" placeholder="Type The Weight Of Your Product (Optional) - kg" value="<?= (isset($_POST['product-weight'])) ? $_POST['product-weight'] : ""; ?>">
                        <div class="headerAboveInput">Product Production Value</div>
                        <input type="number" id="product-production-value" name="product-production-value" placeholder="Type The Production Value Of Your Product (Optional) - &euro;" value="<?= (isset($_POST['product-production-value'])) ? $_POST['product-production-value'] : ""; ?>">

                        <div class="headerAboveInput">Product Description</div>
                        <textarea name="product-description" id="product-description" cols="30" rows="10" placeholder="Type A Few Words About Your Product (Optional)"><?= (isset($_POST['product-description'])) ? trim($_POST['product-description']) : ""; ?></textarea>

                        <div class="headerAboveInput">Upload Images</div>
                        <input type="file" name="product-images[]" id="product-images" multiple="multiple" style="margin-bottom: 10px;"> 

                        <div id="submit-btn" onclick="document.getElementById('add-products').submit();">
                            <div class="submit-text-center">Add Product</div>
                        </div>

                        
                        

                    </form>
                </div>

        </div>  
    </div>

    <div class="modal-background" id="modalBG" onclick="Modal.closeModal();">
        <div class="modal-content" id="modalContent">
            
        </div>
    </div>
    
    </div>
    
</div>


<script src="../public/js/jquery.js"></script>
<script src="../public/js/dashboard-nav.js"></script>
<script src="../public/js/modal.js"></script>



