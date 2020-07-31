<?php
    require_once("../../includes/init.php");
    require_once("../../classes/DB.php");
    require_once("../../classes/Config.php");
    require_once("../../classes/Validate.php");
    require_once("../../classes/Session.php");
    require_once("../../classes/User.php");
    $db = DB::getInstance();
    $user = new User();

    $validation = new Validate();
    $fileValidation = new Validate();
    if(!empty($_POST) && isset($_POST['product-id']) && $user->isLoggedIn()){
        $productTitle = (isset($_POST['product-title'])) ? $_POST['product-title'] : ""; 
        $productPrice = (isset($_POST['product-price'])) ? $_POST['product-price'] : 0; 
        $productListPrice = (isset($_POST['product-list-price'])) ? $_POST['product-list-price'] : 0; 
        $productQuantity = (isset($_POST['product-quantity'])) ? $_POST['product-quantity'] : 0; 
        $productWidth = (isset($_POST['product-width'])) ? $_POST['product-width'] : 0; 
        $productHeight = (isset($_POST['product-height'])) ? $_POST['product-height'] : 0; 
        $productWeight = (isset($_POST['product-weight'])) ? $_POST['product-weight'] : 0; 
        $productProductionValue = (isset($_POST['product-production-value'])) ? $_POST['product-production-value'] : 0; 
        $productDescription = (isset($_POST['product-description'])) ? $_POST['product-description'] : "";
        $imageArray = (isset($_POST['product-image-array'])) ? json_decode($_POST['product-image-array']) : array();
        $removedImageArray = (isset($_POST['product-removed-image-array'])) ? json_decode($_POST['product-removed-image-array']) : array();
        
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
                    'imgCheck' => true
                )
            ));

            $errorArray = array();

            if(!empty($validation->errors())){
                foreach($validation->errors() as $error){
                    $errorArray[] = $error;
                }
            }         
    
            if(!empty($fileValidation->errors())){
                foreach($fileValidation->errors() as $error){
                    $errorArray[] = $error;
                }
            }   
    
        $query = http_build_query(array('errors' => $errorArray));

        if(!empty($validation->errors()) || !empty($fileValidation->errors())){
            header('Location: ../edit-product.php?product_id='. $_POST['product-id'] . "&" .$query);
        }else{
            if(count($removedImageArray) > 0){
                for($i = 0; $i < count($removedImageArray); $i++){
                    print_r($removedImageArray[$i][0]);
                    unlink('../' . $removedImageArray[$i][0]);
                }
            }
            

            if($_FILES['product-images']['name'][0] !== ""){
                $nameList = isset($_FILES['product-images']['name']) ? $_FILES['product-images']['name'] : array();
                $numberOfFilesUploaded = count($nameList);
                
                for($i = 0; $i < $numberOfFilesUploaded; $i++){
                    $fileName = $_FILES['product-images']['name'][$i];
                    $fileTmpName = $_FILES['product-images']['tmp_name'][$i];
                    $fileExt = explode('.', $fileName);
                    $fileActualExt = strtolower(end($fileExt));
    
                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                    $fileDestination = '../public/img/uploadedImages/' . $fileNameNew;
    
                    move_uploaded_file($fileTmpName, '../'. $fileDestination);
    
                    $imageArray[] = $fileDestination;
                }
            }

            $imageArray = json_encode($imageArray);

            date_default_timezone_set("Europe/Stockholm");
            $date = date('Y/m/d H:i:s', time());

            $db->update('products', $_POST['product-id'], array(
                'title' => $_POST['product-title'],
                'price' => $_POST['product-price'],
                'list_price' => $_POST['product-list-price'],
                'quantity' => $_POST['product-quantity'],
                'width' => $_POST['product-width'],
                'height' => $_POST['product-height'],
                'weight' => $_POST['product-weight'],
                'production_value' => $_POST['product-production-value'],
                'description' => $_POST['product-description'],
                'image' => $imageArray,
                'updated' =>  $date
            ));
           header('Location: ../all-products.php');
        }
    }else{
        header('Location: ../all-products.php');
    }
?>