<?php
   require_once("../../includes/init.php");
   require_once("../../classes/DB.php");
   require_once("../../classes/Config.php");
   require_once("../../classes/Validate.php");
   require_once("../../classes/Session.php");
   require_once("../../classes/User.php");

    $user = new User();
   
    if(isset($_GET['pos']) && isset($_GET['productOrder']) && $user->isLoggedIn()){

        if($_GET['pos'] == 1){
            $productAbove = DB::getInstance()->findFirst('products', [
                'conditions' => "order_of_product = ?",
                'bind' => [$_GET['productOrder'] - 1]
            ]);

            $currentProduct = DB::getInstance()->findFirst('products', [
                'conditions' => "order_of_product = ?",
                'bind' => [$_GET['productOrder']]
            ]);
            
            if($productAbove && $currentProduct){
                DB::getInstance()->update('products', $productAbove->id ,[
                    'order_of_product' => $productAbove->order_of_product + 1
                ]);
                
                DB::getInstance()->update('products', $currentProduct->id ,[
                    'order_of_product' => $_GET['productOrder'] - 1 
                ]);
        
                header("Location: ../indexProducts.php");
            }else{
                header("Location: ../indexProducts.php");
            }
        }
        else if($_GET['pos'] == -1){
            $productBelow = DB::getInstance()->findFirst('products', [
                'conditions' => "order_of_product = ?",
                'bind' => [$_GET['productOrder'] + 1]
            ]);

            $currentProduct = DB::getInstance()->findFirst('products', [
                'conditions' => "order_of_product = ?",
                'bind' => [$_GET['productOrder']]
            ]);

            if($productBelow){
                DB::getInstance()->update('products', $productBelow->id ,[
                    'order_of_product' => $productBelow->order_of_product - 1
                ]);
               
                DB::getInstance()->update('products', $currentProduct->id ,[
                    'order_of_product' => $_GET['productOrder'] + 1 
                ]);
                
                header("Location: ../indexProducts.php");
            }else{
                header("Location: ../indexProducts.php");
            }
        }
        else{
            header("Location: ../indexProducts.php");
        }
    }
    else{
        header("Location: ../indexProducts.php"); 
    }


?>