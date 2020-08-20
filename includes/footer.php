<link rel="stylesheet" href="public/style/footer.css">
<?php
    $company = DB::getInstance()->findFirst('company', array(
        'conditions' => 'id = 0'
    ));
?>
<div class="footer-container">
    <div class="contact-information">
        <div class="contact-information-alt">Business owner:  <?= $company->full_name; ?></div>
        <div class="contact-information-alt">Organization number:  <?= $company->organization_num; ?></div>
        <div class="contact-information-alt">Contact email:  <?= $company->email; ?></div>
        <div class="contact-information-alt">Company address:  <?= $company->country; ?>, <?= $company->city; ?>,  <?= $company->zip; ?>, <?= $company->address; ?></div>
    </div>

    <div class="other-footer-contianer">
        <a href="terms-and-conditions.php" class="terms-and-conditions">Terms & Conditions</a>
        <div class="social-media-container">
            <?php
                if(!empty($company->instagram_link)):
            ?>
            <div class="social-media-alt-container" onclick="window.location.href = '<?= $company->instagram_link; ?>'">
                <div class="social-media-alt instagram"></div>
                <div class="social-media-text">Instagram</div>
            </div>
            <?php
                endif;
                if(!empty($company->twitter_link)):
            ?>
            <div class="social-media-alt-container" onclick="window.location.href = '<?= $company->twitter_link; ?>'">
                <div class="social-media-alt twitter"></div>
                <div class="social-media-text">Twitter</div>
            </div>
            <?php
                endif;
            ?>
            
            
        </div>
    </div>

</div>