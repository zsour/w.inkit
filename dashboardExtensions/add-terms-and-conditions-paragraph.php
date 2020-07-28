<?php
    include_once("../includes/dashboardhead.php");

    $validation = new Validate();
    if(!empty($_POST)){
        $headerTitle = (isset($_POST['headerTitle'])) ? $_POST['headerTitle'] : ""; 
        $terms = (isset($_POST['terms'])) ? $_POST['terms'] : ""; 

        $validation->check($_POST, array(
            'headerTitle' => array(
                'required' => true
            ),

            'terms' => array(
                'required' => true
            )
        ));
    
        if($validation->passed()){
            $currentHeader = DB::getInstance()->findFirst("terms_and_conditions",  [
                'conditions' => 'id = ?',
                'bind' => [$headerTitle]
            ]);
    
                $decoded = json_decode($currentHeader->terms_conditions);
                if(count($decoded) > 0){
                    $decoded[] = $terms;
                    $updateString = json_encode($decoded);
                }
                else{
                    $updateString = json_encode(array($terms));
                }

            DB::getInstance()->update('terms_and_conditions', $headerTitle, array(
                'terms_conditions' => $updateString
            ));
    
            $_POST = array();
            header("Location: create-terms-and-conditions.php");
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
            Add terms and conditions paragraph
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
     
        <form action="add-terms-and-conditions-paragraph.php" method="POST" id="add-paragraph-form">
            <div class="headerAboveInput">Header For Paragraph</div>
           

                        <select name="headerTitle" id="headerTitleSelect">
                        <?php
                                 $db = DB::getInstance();
                                 $headerTitles = $db->find('terms_and_conditions');
                                 foreach($headerTitles as $headerTitle):
                        ?>
                        <option value="<?= $headerTitle->id; ?>"><?= $headerTitle->title; ?></option>
                        <?php
                            endforeach;
                        ?>
                        </select>
   

            <div class="headerAboveInput">Paragraph Content</div>
            <textarea name="terms" id="terms" cols="30" rows="10" placeholder="Type Your Terms And Conditions"><?= (isset($_POST['terms'])) ? trim($_POST['terms']) : ""; ?></textarea>

            
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
