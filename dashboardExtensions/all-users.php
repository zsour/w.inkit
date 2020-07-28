<?php
    include_once("../includes/dashboardhead.php");
    if(isset($_POST['userId'])){
        $userToRemove = DB::getInstance()->findFirst('users', array(
            'conditions' => ["id = ?", "groups = ?"],
            'bind' => [$_POST['userId'], 0]
        ));

        if($userToRemove){
            DB::getInstance()->delete('users', $userToRemove->id);
        }
    }
?>

<link rel="stylesheet" href="../public/style/register-user.css">
<div class="background">
    <div class="dashboard-content" id="content">

    <?php 
        include_once("dashboard-sidebar.php");

    ?>

    <div class="center-components-background">
        <div class="center-components" id="center-components"> 
                    <div class="dashboardExtensionHeader">
                    All Users
                </div>

                <div class="form-container">
                    <?php 
                        $db = DB::getInstance();
                        $result = $db->find('users');

                        foreach($result as $userInDb):
                    ?>
                    <div class="user">
                        <div class="user-header">
                            <div class="user-header-field">Full Name</div>
                            <div class="user-header-field">Username</div>
                            <div class="user-header-field">Joined</div>
                            <div class="user-header-field">Actions</div>
                        </div>
                            <div class="user-field"><?= $userInDb->name; ?></div>
                            <div class="user-field"><?= $userInDb->username; ?></div>
                            <div class="user-field"><?= $userInDb->joined; ?></div>
                            <?php
                                if($user->data()->groups == 1 && $userInDb->groups == 0):
                            ?>
                                <div class="remove-user-btn" onclick="document.getElementById('removeUser<?= $userInDb->id; ?>').submit();">
                                    <div class="remove-user-btn-text">Remove</div>
                                </div>
                                <form action="all-users.php" method="post" id="removeUser<?= $userInDb->id; ?>">
                                    <input type="hidden" name="userId" value="<?= $userInDb->id; ?>">
                                </form>
                            <?php
                                endif;
                            ?>
                    </div>

                    <?php
                        endforeach;
                    ?>
                </div>

        </div>  
    </div>

    <div class="modal-background" id="modalBG" onclick="Modal.closeModal();">
        <div class="modal-content" id="modalContent">
            
        </div>
    </div>
    
    </div>
    
</div>


<script src="../public/js/jquery.js"></script>
<script src="../public/js/dashboard-nav.js"></script>
<script src="../public/js/modal.js"></script>



