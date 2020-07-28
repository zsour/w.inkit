<?php
    require_once("../../includes/init.php");
    require_once("../../classes/DB.php");
    require_once("../../classes/Config.php");
    require_once("../../classes/Session.php");
    require_once("../../classes/User.php");
    $user = new User();

    if(!empty($_POST) && $user->isLoggedIn()){
        $productId = $_POST['product-id'];
        $db = DB::getInstance();

        $result = $db->findFirst('products', [
            'conditions' => 'id = ?',
            'bind' => [$productId]
        ]);

        $images = json_decode($result->image);

        for($i = 0; $i < count($images); $i++){
            if(file_exists('../' . $images[$i])){
                $truePath = '../' . $images[$i];
                unlink($truePath);
            }
        }
        $db->delete("products", $_POST['product-id']);
        header("Location: ../all-products.php");
    }else{
        header("Location: ../all-products.php");
    }
?>
