<?php
       require_once("includes/init.php");
       require_once("classes/DB.php");
       require_once("classes/Config.php");
       require_once("classes/Session.php");

       $company = DB::getInstance()->findFirst('company', [
           'conditions' => 'id = 0'
       ]);

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
               padding-top: 25px;
               font-family: 'Arial';
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

       </style>
       </head>

       <body>
           <div class='content'>

           <div class='order'>
               <div class='order-header'>
                   <div class='order-header-container'>
                       <div class='company-info'> 
                           <div class='company-info-alt'>Company Name: <b>". $company->company_name ."</b></div> 
                           <div class='company-info-alt'>Address: <b>". $company->address .", ". $company->zip .", ". $company->city .", ". $company->country ."</b></div> 
                           <div class='company-info-alt'>Email: <b>" . $company->email . "</b></div> 
                           <div class='company-info-alt'>Organization Number: <b>" . $company->organization_num . "</b></div> 
                       </div> 
                   </div>"; 
       
       if(isset($_SESSION['order_id'])){
        $db = DB::getInstance();

        $order = $db->findFirst('orders', [
        'conditions' => "unique_id = ?",
        'bind' => [$_SESSION['order_id']]
        ]);


        if(!$order){
            unset($_SESSION['order_id']);
            header('Location: ./cart');
        }else{

            $body .= "
            <div class='order-header-container' style='text-align: right;'>
                <div class='company-logo'></div>
                <div class='date-and-id'>
                    <div class='date-and-id-alt'>Date (CET): <b>". $order->payment_date ."</b></div> 
                    <div class='date-and-id-alt'>Receipt Number: <b>". $order->id ."</b></div> 
                    <div class='date-and-id-alt'>Transaction ID: <b>". $order->braintree_id ."</b></div> 
                </div> 
            </div>
        </div>

        <div class='sold-to-container'>
            <div class='sold-to-header'><b>Sold to:</b></div>
            <div class='sold-to-alt'>Full Name: <b>". $order->full_name ."</b></div>
            <div class='sold-to-alt'>Email: <b>". $order->email ."</b></div>
            <div class='sold-to-alt'>Shipping Address: <b>". $order->address .", ". $order->zip .", ". $order->city .", ". $order->country ."</b></div>
            <div class='sold-to-alt'>Phone: <b>". $order->phone ."</b></div>
        </div>

        <div class='order-products'>
            <div class='product-header'>
                <div class='product-header-alt' style='width: 100px;'><b>Quantity</b></div> 
                <div class='product-header-alt' style='width: 100px;'><b>Product #</b></div> 
                <div class='product-header-alt' style='width: 500px;'><b>Description</b></div> 
                <div class='product-header-alt' style='width: 100px;'><b>Price (ea)</b></div> 
                <div class='product-header-alt' style='width: 100px;'><b>Price (total)</b></div> 
            </div>";


            $cart = json_decode($order->cart);
            $totalAmount = 0;
    
            foreach($cart as $product){
                $productQuery = $db->findFirst('products', [
                    'conditions' => "id = ?",
                    'bind' => [$product->id]
                ]);
    
                if(!$productQuery){
                    unset($_SESSION['order_id']);
                    header('Location: ./');  
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
        </div>
                <div class='total-cost'> 
                        <div class='total-cost-alt'>Shipping: <b>Free</b></div>
                        <div class='total-cost-alt'>Tax (12%): <b>" . round($totalAmount * 0.12, 2) . " &euro;</b></div>
                        <div class='total-cost-alt'>Total Amount Paid: <b>" . round($totalAmount, 2) ." &euro;</b></div>
                </div> 
            </div>
    
            </div>
            </body>
    
            </html>
        ";
        mail($order->email, "Thank you for your order! - Here's your receipt.", $body, "From: no-reply@kubkompaniet.com\r\n" . "Content-Type: text/html; charset=UTF-8\r\n");
        unset($_SESSION['order_id']);
        }
       }else{
            unset($_SESSION['order_id']);
            header('Location: ./');
       }
?>

<html>
    <head>
        <?php
            include("includes/head.php");
        ?>    
        
    </head>


<body>
    <div class="content">
        <div class="center-content" id="center-content">
                    <div class="products-nav-container">
                        <div class="products-nav-logo" onclick="window.location.href = './';"></div>
                        <div class="products-nav-button-container">
                            <div class="products-nav-button" onclick="window.location.href = 'products';">
                                <div class="button-text">PRODUCTS</div>
                            </div> 
                            
                            <div class="products-nav-button" onclick="window.location.href = 'about';">
                                <div class="button-text">ABOUT</div>
                            </div> 

                            <div class="products-nav-button" onclick="window.location.href = 'contact';">
                                <div class="button-text">CONTACT</div>
                            </div> 
                        </div>

                        <div class="product-shopping-cart" onclick="window.location.href = 'cart';">
                                <?php
                                    if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])):
                                ?>
                                <div class="shopping-cart-notice" style="filter: invert(0%);"></div>
                                <?php
                                    endif;
                                ?>
                        
                        </div>
                    </div>

                    <div class="thankyou-container">
                        <div class="thankyou-text">
                                <div class="thankyou-title">Thank you for your order, a receipt has been sent to your email. <br><br>(Your order number is <?= $order->id; ?>)</div>
                                <div class="thankyou-subtitle">Shipping information will be sent to your email as soon as your package is sent.</div>
                        </div>
                    </div>
    </body>

    </html>