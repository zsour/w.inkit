<?php
    
    require_once("includes/init.php");
    require_once("classes/DB.php");
    require_once("classes/Config.php");
    require_once("classes/CartEvent.php");
    require_once("classes/Session.php");
    require_once("vendor/autoload.php");
    require_once("generateGateway.php");
    

    $clientToken = $gateway->clientToken()->generate();

    $db = DB::getInstance();
    $order = $db->findFirst('orders', [
        'conditions' => "unique_id = ?",
        'bind' => [$_SESSION['order_id']]
    ]);

    if(!$order){
      unset($_SESSION['order_id']);
      header('Location: cart.php');  
    }
?>
    <html>
    <head>
        <link rel="stylesheet" href="public/style/payment.css">
        <?php
            include("includes/head.php");
        ?>    
        <script src="https://js.braintreegateway.com/web/dropin/1.22.1/js/dropin.min.js"></script>
        <script src="https://js.braintreegateway.com/web/3.62.1/js/client.min.js"></script>
        <script src="https://js.braintreegateway.com/web/3.62.1/js/data-collector.min.js"></script>
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
                        <div class="shopping-cart-notice" style="filter: invert(0%);"></div>
                        </div>
                    </div>

                    <?php
                        if(isset($_GET['error']) && $_GET['error'] == 1):
                    ?>
                    <div class="error-contianer">
                        <div class="error-text">An error occurred while processing the payment, please try again.</div>
                    </div>
                    <?php
                        endif;
                    ?>

                    <div id="paypal-container"></div>
                    <div id="dropin-container"></div>
                    <div class="btn-container">
                        <div id="submit-button"><span class="submit-button-icon"></span><div class="submit-btn-text">PAY</div></div>
                    </div>
            
            <form action="submitPayment.php" method="post" id="submitPayment">
                <input type="hidden" name="nonce" id="nonceField">
                <input type="hidden" name="deviceData" id="deviceDataField">
                <input type="hidden" name="order_id" value="<?= $_SESSION['order_id']; ?>">
            </form>

            <script>
                braintree.client.create({
                    authorization: '<?= $clientToken; ?>'
                    }, function (err, clientInstance) {
                        braintree.dataCollector.create({
                            client: clientInstance,
                            paypal: true
                        }, function (err, dataCollectorInstance) {
                            if (err) {
                                window.location.header = "cart.php";
                            return;
                            }
                            
                            var deviceData = dataCollectorInstance.deviceData;
                            document.getElementById('deviceDataField').value = deviceData;
                    });
                });

                var button = document.querySelector('#submit-button');

                braintree.dropin.create({
                authorization: '<?= $clientToken; ?>',
                container: '#dropin-container'
                }, function (createErr, instance) {
                    if(instance){
                    button.addEventListener('click', function () {
                    instance.requestPaymentMethod(function (err, payload) {
                        document.getElementById('nonceField').value = payload.nonce;
                        document.getElementById('submitPayment').submit();
                    });
                    });
                    }
                });

                braintree.dropin.create({
                    authorization: '<?= $clientToken; ?>',
                    container: '#dropin-container',
                    paypal: {
                        flow: 'vault'
                    }
                }, function(createErr, instance){
                    if(instance){
                    button.addEventListener('click', function () {
                    instance.requestPaymentMethod(function (err, payload) {
                        document.getElementById('nonceField').value = payload.nonce;
                        document.getElementById('submitPayment').submit();
                    });
                    });
                    }
                });


                
             </script>


        </div>
    </div>
</body>
</html>