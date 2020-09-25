<?php
    include_once("../includes/dashboardhead.php");

    $validation = new Validate();
    if(!empty($_POST)){
        $headerTitle = (isset($_POST['headerTitle'])) ? $_POST['headerTitle'] : ""; 
        $info = (isset($_POST['info'])) ? $_POST['info'] : ""; 

        $validation->check($_POST, array(
            'headerTitle' => array(
                'required' => true
            ),

            'info' => array(
                'required' => true
            )
        ));
    
        if($validation->passed()){
            $currentHeader = DB::getInstance()->findFirst("about",  [
                'conditions' => 'id = ?',
                'bind' => [$headerTitle]
            ]);
    
                $decoded = json_decode($currentHeader->info_block);
                if(count($decoded) > 0){
                    $decoded[] = $info;
                    $updateString = json_encode($decoded);
                }
                else{
                    $updateString = json_encode(array($info));
                }

            DB::getInstance()->update('about', $headerTitle, array(
                'info_block' => $updateString
            ));
    
            $_POST = array();
            header("Location: about-page-edit.php");
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
            Add about page paragraph
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
     
        <form action="add-about-page-paragraph.php" method="POST" id="add-paragraph-form">
            <div class="headerAboveInput">Header For Paragraph</div>
           

                        <select name="headerTitle" id="headerTitleSelect">
                        <?php
                                 $db = DB::getInstance();
                                 $headerTitles = $db->find('about');
                                 foreach($headerTitles as $headerTitle):
                                if(empty($headerTitle->image)):
                        ?>
                        <option value="<?= $headerTitle->id; ?>"><?= $headerTitle->title; ?></option>
                        <?php
                            endif;
                            endforeach;
                        ?>
                        </select>
   

            <div class="headerAboveInput">Paragraph Content</div>
            <textarea spellcheck="false" name="info" id="terms" cols="30" rows="10" placeholder="Type Your Information:"><?= (isset($_POST['info'])) ? trim($_POST['info']) : ""; ?></textarea>

            
        </form>
        

        <div class="add-terms-and-conditions-submit-btn" onclick="document.getElementById('add-paragraph-form').submit();">
        <div class="submit-text-center">ADD PARAGRAPH</div>
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
