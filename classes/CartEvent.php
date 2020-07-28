<?php
    class CartEvent{      
        private static function initCart(){
            if(!isset($_SESSION['cart'])){
                $_SESSION['cart'] = array();
            }

            return $_SESSION['cart'];
        } 


        public function addToCart($id, $quantity){
            $currentCart = self::initCart();
            $productCartIndex = self::checkIfProductExistsInCart($id);
            if($productCartIndex == -1 && isset($quantity)){ 
                array_push($_SESSION['cart'], array(
                    'id' => $id,
                    'quantity' => $quantity
                ));
            }else if($productCartIndex != -1 && isset($quantity)){
                    $currentCart[$productCartIndex]['quantity'] += $quantity;
                    $_SESSION['cart'] = $currentCart;
            }else{
                return;
            }
        }

        public function removeFromCart($id, $quantity = -1){
            $currentCart = self::initCart();
            $productCartIndex = self::checkIfProductExistsInCart($id);
            if($productCartIndex == -1){ 
                return;
            }

           

            if($quantity != -1){
                $currentCart[$productCartIndex]['quantity'] -= $quantity;
                    if($currentCart[$productCartIndex]['quantity'] < 1){
                        unset($currentCart[$productCartIndex]);
                        $_SESSION['cart'] = $currentCart;
                    }else{
                        $_SESSION['cart'] = $currentCart;
                    }
            }else{
                unset($currentCart[$productCartIndex]);
                $_SESSION['cart'] = $currentCart;
            }
        }



        private function checkIfProductExistsInCart($id){
            $idExists = false;
            $cartArrayIndex = null;
            $currentCart = self::initCart();
            foreach($currentCart as $key => $product){
                if($product['id'] == $id){
                    $idExists = true;
                    $cartArrayIndex = $key;
                    break;
                }
            }

            if($idExists && isset($cartArrayIndex)){
                return $cartArrayIndex;
            }else{
                return -1;
            }
        }
    }
?>