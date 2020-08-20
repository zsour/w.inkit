<?php
    include_once("../includes/dashboardhead.php");

    $currentCompany = DB::getInstance()->findFirst('company', [
        'conditions' => 'id = 0'
    ]);

    $fullName = (isset($_POST['fullName'])) ? $_POST['fullName'] : (!empty($currentCompany->full_name) ? $currentCompany->full_name : ""); 
    $email = (isset($_POST['email'])) ? $_POST['email'] : (!empty($currentCompany->email) ? $currentCompany->email : ""); 
    $country = (isset($_POST['country'])) ? $_POST['country'] : (!empty($currentCompany->country) ? $currentCompany->country : ""); 
    $city = (isset($_POST['city'])) ? $_POST['city'] : (!empty($currentCompany->city) ? $currentCompany->city : ""); 
    $zip = (isset($_POST['zip'])) ? $_POST['zip'] : (!empty($currentCompany->zip) ? $currentCompany->zip : ""); 
    $address = (isset($_POST['address'])) ? $_POST['address'] : (!empty($currentCompany->address) ? $currentCompany->address : ""); 
    $organizationNum = (isset($_POST['organizationNum'])) ? $_POST['organizationNum'] : (!empty($currentCompany->organization_num) ? $currentCompany->organization_num : ""); 
    $companyName = (isset($_POST['companyName'])) ? $_POST['companyName'] : (!empty($currentCompany->company_name) ? $currentCompany->company_name : ""); 
    $instagramLink = (isset($_POST['instagramLink'])) ? $_POST['instagramLink'] : (!empty($currentCompany->instagram_link) ? $currentCompany->instagram_link : ""); 
    $twitterLink = (isset($_POST['twitterLink'])) ? $_POST['twitterLink'] : (!empty($currentCompany->twitter_link) ? $currentCompany->twitter_link : ""); 

    $validation = new Validate();

    if(!empty($_POST) && isset($_POST['fullName'])){

        $validation->check($_POST, array(
            'fullName' => array(
                'required' => true
            ),

            'email' => array(
                'required' => true
            ),

            'address' => array(
                'required' => true
            ),

            'organizationNum' => array(
                'required' => true
            ),

            'country' => array(
                'required' => true
            ),

            'city' => array(
                'required' => true
            ),

            'zip' => array(
                'required' => true
            ),

            'companyName' => array(
                'required' => true
            )

        ));
    
        if($validation->passed()){
             DB::getInstance()->update('company', 0, [
                'company_name' => $companyName,
                'full_name' => $fullName,
                'address' => $address,
                'email' => $email,
                'organization_num' => $organizationNum,
                'country' => $country,
                'city' => $city,
                'zip' => $zip,
                'instagram_link' => $instagramLink,
                'twitter_link' => $twitterLink
            ]); 
                        
            $_POST = array();
            header('Location: add-company-information.php');
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
            Update company information
        </div>

        
        <?php
                        if(!empty($validation->errors())){
                                    foreach($validation->errors() as $error){
                                        $errorOutput = "<div class='error'>
                                                            <div id='error-text-center'>{$error}</div>
                                                        </div>";
                                        echo($errorOutput);
                                    }
                        }         
        ?>

        <form action="add-company-information.php" id="add-company-information-form" method="POST">
            <div class="headerAboveInput">Company Name:</div>
            <input type="text" spellcheck="false" class="company-information-input-field" name="companyName" placeholder="Type Your Company Name" value="<?= $companyName; ?>">
            <div class="headerAboveInput">Full Name:</div>
            <input type="text" spellcheck="false" class="company-information-input-field" name="fullName" placeholder="Type Your Full Name" value="<?= $fullName; ?>">
            <div class="headerAboveInput">Email:</div>
            <input type="text" spellcheck="false" class="company-information-input-field" name="email" placeholder="Type Your Email" value="<?= $email; ?>">
            <div class="headerAboveInput">Country:</div>
            <input type="text" spellcheck="false" class="company-information-input-field" name="country" placeholder="Type Your Country" value="<?= $country; ?>">
            <div class="headerAboveInput">City:</div>
            <input type="text" spellcheck="false" class="company-information-input-field" name="city" placeholder="Type Your City" value="<?= $city; ?>">
            <div class="headerAboveInput">Zip:</div>
            <input type="text" spellcheck="false" class="company-information-input-field" name="zip" placeholder="Type Your Zip" value="<?= $zip; ?>">
            <div class="headerAboveInput">Address:</div>
            <input type="text" spellcheck="false" class="company-information-input-field" name="address" placeholder="Type Your Company Address" value="<?= $address; ?>">
            <div class="headerAboveInput">Organization Number:</div>
            <input type="text" spellcheck="false" class="company-information-input-field" name="organizationNum" placeholder="Type Your Company Organization Number" value="<?= $organizationNum; ?>">
            <div class="headerAboveInput">Instagram Link:</div>
            <input type="text" spellcheck="false" class="company-information-input-field" name="instagramLink" placeholder="Type Instagram Profile Link" value="<?= $instagramLink; ?>">
            <div class="headerAboveInput">Twitter Link:</div>
            <input type="text" spellcheck="false" class="company-information-input-field" name="twitterLink" placeholder="Type Twitter Profile Link" value="<?= $twitterLink; ?>">
        </form>

        <div class="add-terms-and-conditions-submit-btn" onclick="document.getElementById('add-company-information-form').submit();">
        <div class="submit-text-center">UPDATE COMPANY INFORMATINO</div>
        </div>


        <div class="modal-background" id="modalBG" onclick="Modal.closeModal();">
            <div class="modal-content" id="modalContent">
                
            </div>
        </div>
    
    
    </div>
    </div>
    
    </div>
    
</div>


<script src="../public/js/jquery.js"></script>
<script src="../public/js/dashboard-nav.js"></script>
<script src="../public/js/modal.js"></script>
