<?php
  require_once("../../includes/init.php");
  require_once("../../classes/DB.php");
  require_once("../../classes/Config.php");
  require_once("../../classes/Session.php");
  require_once("../../classes/Validate.php");
  require_once("../../classes/User.php"); 
  require_once("../../generateGateway.php"); 
  
  $user = new User();
  if($user->isLoggedIn()){
    if(isset($_POST['orderId']) && isset($_POST['shippingVia'])){
        $order = DB::getInstance()->findFirst('orders', [
            'conditions' => 'id = ?',
            'bind' => [$_POST['orderId']]
        ]);

        if($order){
            $body = "
            <html>
     
            <head>
            <style>
                .content{
                    width: 1000px;
                    height: auto;   
                    background-color: #151515;
                    position: relative;
                }
     
                .order{
                    width: 960px;
                    margin-left: 20px;
                    height: auto;   
                    background-color: #151515;
                    padding-top: 20px;
                    padding-bottom: 20px;
                }
     
                .order-header{
                    width: 960px;
                    min-height: 280px;
                    position: relative;
                    border-bottom: solid 1px rgba(0,0,0,0.25);
                    background-color: white;
                    font-size: 0px;
                }
     
                .order-header-container{
                    width: 480px;
                    min-height: 250px;
                    height: auto;
                    display: inline-block;
                    position: relative;
                    font-size: 16px;
                    vertical-align: middle;
                }
     
     
                .company-info{
                    width: 440px;
                    height: auto;
                    margin-top:25px;
                    margin-left: 20px;
                }
     
                .company-info-alt{
                    width: 100%;
                    height: auto;
                    background-color: white;
                    border-bottom: solid 1px rgba(0,0,0,0.15);
                    line-height: 40px;
                    font-size: 16px;
                    font-family: 'Arial';
                }
     
                .company-logo{
                    background-image: url('https://kubkompaniet.com/public/img/logo.png');
                    width: 150px;
                    height: 150px;
                    background-size: contain;
                    background-repeat: no-repeat;
                    background-position: center;
                    display: inline-block;
                    margin-right: 20px;
                    margin-top: 10px;
                }
     
                .date-and-id{
                    width: 440px;
                    height: auto;
                    margin-right: 25px;
                    position: relative;
                    margin-top: 15px;
                }
     
                .date-and-id-alt{
                    width: 100%;
                    height: 30px;
                    line-height: 30px;
                    font-size: 16px;
                    font-family: 'Arial';
                }
     
                .sold-to-container{
                    width: 940px;
                    min-height: 200px;
                    position: relative;
                    border-bottom: solid 1px rgba(0,0,0,0.25);
                    background-color: white;
                    padding-left: 20px;
                    padding-top: 15px;
                    font-family: 'Arial';
                    padding-bottom: 20px;
                }
     
                .sold-to-header{
                    width: 100%;
                    height: 30px;
                    line-height: 30px;
                    font-size: 16px;
                }
     
                .sold-to-alt{
                    width: 900px;
                    height: auto;
                    line-height: 30px;
                    font-size: 16px;
                    padding-left: 10px;
                }
     
     
                .order-products{
                    width: 960px;
                    height: auto;
                    background-color: white;
                    position: relative;
                }
     
                .product-header{
                    width: 940px;
                    height: 30px;
                    line-height: 30px;
                    margin-left: 20px;
                    font-family: 'Arial';
                    margin-top: 20px;
                    padding-top: 5px;
                }
     
                .product-header-alt{
                    font-size: 16px;
                    display: inline-block;
                }
     
                .product{
                    width: 940px;
                    min-height: 30px;
                    line-height: 30px;
                    font-family: 'Arial';
                    padding-top: 5px;
                    border-top: solid 1px rgba(0,0,0,0.25);
                }
     
                .product-alt{
                    font-size: 16px;
                    display: inline-block;
                    text-align: center;
                    height: auto;
                    vertical-align: middle;
                }
     
                .total-cost{
                    width: 960px;
                    height: auto;
                    line-height: 30px;
                    font-family: 'Arial';
                    padding-top: 20px;
                    padding-bottom: 20px;
                    background-color: white;
                    text-align: right;
                    border-top: solid 1px rgba(0,0,0,0.25);
     
                }
     
                .total-cost-alt{
                    font-size: 16px;
                    margin-right: 20px;
                }

                .shipped-header{
                    font-size: 20px;
                    margin-bottom: 10px;
                }
     
            </style>
            </head>
     
            <body>
                <div class='content'>
     
                <div class='order'>
                    <div class='order-header'>
                        <div class='order-header-container'>
                            <div class='company-info'> 
                                <div class='company-info-alt'>Company Name: <b>Kubkompaniet</b></div> 
                                <div class='company-info-alt'>Address: <b>Gråhallsvägen 23, 432 47, Varberg, Sweden</b></div> 
                                <div class='company-info-alt'>Phone: <b>0739808116</b></div> 
                                <div class='company-info-alt'>Email: <b>daniel.karlsson36@outlook.com</b></div> 
                                <div class='company-info-alt'>Organization Number: <b>123456789</b></div> 
                                <div class='company-info-alt'><b>If you have any questions regarding shipping, contact us using the details above.</b></div> 
                            </div> 

                        </div>       
                        "; 


                        $body .= "
                        <div class='order-header-container' style='text-align: right;'>
                            <div class='company-logo'></div>
                            <div class='date-and-id'>
                                <div class='date-and-id-alt'>Date (CET): <b>". $order->payment_date ."</b></div> 
                                <div class='date-and-id-alt'>Order Number: <b>". $order->id ."</b></div> 
                            </div> 
                        </div>
                    </div>
            
                    <div class='sold-to-container'>
                        <div class='shipped-header'><b>Your order has now been sent.</b><br> If the information below is incorrect, please contact us.</div>
                        <div class='sold-to-header'><b>Shipping To:</b></div>
                        <div class='sold-to-alt'>Full Name: <b>". $order->full_name ."</b></div>
                        <div class='sold-to-alt'>Address: <b>". $order->address .", ". $order->zip .", ". $order->city .", ". $order->country ."</b></div>
                        <div class='sold-to-alt'>Sent via: <b>". $_POST['shippingVia'] ."</b></div>
                        <div class='sold-to-alt'>Tracking ID: <b>". (!empty($_POST['trackingId']) ? $_POST['trackingId'] : "Untrackable") ."</b></div>
                    </div>
                
                <div class='order-products'>
                    <div class='product-header'>
                        <b>Items in order:</b>
                    </div>
                    <div class='product-header'>
                        <div class='product-header-alt' style='width: 100px;'><b>Quantity</b></div> 
                        <div class='product-header-alt' style='width: 100px;'><b>Product #</b></div> 
                        <div class='product-header-alt' style='width: 500px;'><b>Description</b></div> 
                        <div class='product-header-alt' style='width: 100px;'><b>Price (ea)</b></div> 
                        <div class='product-header-alt' style='width: 100px;'><b>Price (total)</b></div> 
                    </div>
                ";

                $cart = json_decode($order->cart);
                $totalAmount = 0;
        
                foreach($cart as $product){
                    $productQuery = DB::getInstance()->findFirst('products', [
                        'conditions' => "id = ?",
                        'bind' => [$product->id]
                    ]);
        
                    if(!$productQuery){
                        
                    }else{
                        $body .= "
                        <div class='product'>
                           <div class='product-alt' style='width: 100px;'><b>" . $product->quantity . "</b></div>
                           <div class='product-alt' style='width: 100px;'><b>" . $productQuery->id . "</b></div>
                           <div class='product-alt' style='width: 500px; text-align: center;'><b>" . $productQuery->title . "</b></div>
                           <div class='product-alt' style='width: 100px;'><b>" . $product->priceDuringOrder . " &euro;</b></div>
                           <div class='product-alt' style='width: 100px;'><b>" . ($product->quantity * $product->priceDuringOrder) . " &euro;</b></div>
                       </div>
                        ";
                        $totalAmount += ($product->quantity * $product->priceDuringOrder);
                    }     
                }
            
            $body .= "

            <div class='total-cost'> 
                        <div class='total-cost-alt'>Shipping: <b>Free</b></div>
                        <div class='total-cost-alt'>Tax (12%): <b>" . round($totalAmount * 0.12, 2) . " &euro;</b></div>
                        <div class='total-cost-alt'>Total Amount Paid: <b>" . round($totalAmount, 2) ." &euro;</b></div>
                </div> 
            </div>
            </div>
        </div>";
                                 

        mail($order->email, "Your order has been sent!", $body, "From: no-reply@kubkompaniet.com\r\n" . "Content-Type: text/html; charset=UTF-8\r\n");
        DB::getInstance()->update('orders', $order->id, array(
            'shipped' => 1
        ));
        header("Location: ../all-orders.php");
        }else{
            header("Location: ../all-orders.php");
        }
    }

  }else{
    header("Location: ../../login");
  }
?>