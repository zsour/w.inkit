<?php
    include_once("../includes/dashboardhead.php");
    include_once("../generateGateway.php");

    if(isset($_POST['orderId'])){
        $order = DB::getInstance()->findFirst('orders', array(
            'conditions' => 'id = ?',
            'bind' => [$_POST['orderId']]
        ));

        if($order){
            $fullname = !empty($order->full_name) ? $order->full_name : "";
            $email = !empty($order->email) ? $order->email : "";
            $phone = !empty($order->phone) ? $order->phone : "";
            $country = !empty($order->country) ? $order->country : "";
            $city = !empty($order->city) ? $order->city : "";
            $zip = !empty($order->zip) ? $order->zip : "";
            $address = !empty($order->address) ? $order->address : "";
        }else{
            if(isset($_POST['fromHeader']) && $_POST['fromHeader']){
                header('Location: ./archived-orders.php');
            }else{
                header('Location: ./all-orders.php');
            }   
        }
    }else{
        if(isset($_POST['fromHeader']) && $_POST['fromHeader']){
            header('Location: ./archived-orders.php');
        }else{
            header('Location: ./all-orders.php');
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
                Edit Customer Information
            </div>
            <div id="errorContainer">
        
            </div>
                <form action="./functionality/functionality.edit-customer-info.php" class="edit-customer-form" id="edit-customer-form" method="post">
                    <input type="hidden" name="orderId" value="<?= $order->id; ?>">
                    <input type="hidden" name="fromHeader" value="<?= $_POST['fromHeader']; ?>">
                    <div class="edit-customer-info-header">Full Name:</div>
                    <input type="text" name="fullName" id="fullName" class="edit-customer-input-field" value="<?= $fullname; ?>">
                    <div class="edit-customer-info-header">Email:</div> 
                    <input type="text" name="email" id="email" class="edit-customer-input-field" value="<?= $email; ?>">
                    <div class="edit-customer-info-header">Phone:</div>
                    <input type="text" name="phone" id="phone" class="edit-customer-input-field" value="<?= $phone; ?>">
                    <div class="edit-customer-info-header">Country:</div>
                    <input type="text" name="country" id="country" class="edit-customer-input-field" value="<?= $country; ?>">
                    <div class="edit-customer-info-header">City:</div>
                    <input type="text" name="city" id="city" class="edit-customer-input-field" value="<?= $city; ?>">
                    <div class="edit-customer-info-header">Zip:</div>
                    <input type="text" name="zip" id="zip" class="edit-customer-input-field" value="<?= $zip; ?>">
                    <div class="edit-customer-info-header">Address:</div>
                    <input type="text" name="address" id="address" class="edit-customer-input-field" value="<?= $address; ?>">
                </form>

     
                <div class="save-changes-btn" id="save-changes">
                    <div class="save-changes-text">SAVE CHANGES</div>
                </div>
            </div>
        
        </div>
    
    </div>

    <div class="modal-background" id="modalBG">
        <div class="modal-content" id="modalContent">
            
        </div>
    </div>
    
    </div>
    
</div>


<script src="../public/js/jquery.js"></script>
<script src="../public/js/dashboard-nav.js"></script>
<script src="../public/js/modal.js"></script>
<script src="../public/js/edit-customer-info.js"></script>