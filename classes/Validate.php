<?php
class Validate{
        private $_passed = false,
                $_errors = array(),
                $_db = null;

        public function __construct(){
            $this->_db = DB::getInstance();
        }

        public function check($source, $items = array()){
            foreach($items as $item => $rules){
                foreach($rules as $rule => $rule_value){
                    if(!is_array($source[$item])){
                        $value = trim($source[$item]);
                    }
                    else{
                        $value = $source[$item];
                    }
                    $item = sanitize($item);
                
                    if($rule === 'required' && empty($value)){
                        $this->addError("{$item} is required.");
                    }else if(!empty($value)){
                        switch($rule){
                            case 'min':
                                if(strlen($value) < $rule_value){
                                    $this->addError("{$item} must be a minimum of {$rule_value} characters.");
                                }
                            break;

                            case 'max':
                            if(strlen($value) > $rule_value){
                                $this->addError("{$item} must be a maximum of {$rule_value} characters.");
                            }
                            break;

                            case 'matches':
                                if($value != $source[$rule_value]){
                                    $this->addError("{$rule_value} must match {$item}.");
                                }
                            break;

                            case 'unique':
                                $check = $this->_db->findFirst($rule_value, array(
                                    'conditions' => $item . ' = ?',
                                    'bind' => [$value]
                                ));
                                if($check){
                                    $this->addError("{$item} already exists.");
                                }
                            break;

                            case 'notOne':
                            if($value == 1 && $rule_value){
                                $this->addError("Select list error.");
                            }
                            break;

                            case 'msg':
                                $this->addError($rule_value);
                            break;

                            case 'imgCheck':
                                if($rule_value == true && $_FILES[$item]['name'][0] !== ""){
                                  $nameList = isset($_FILES[$item]['name']) ? $_FILES[$item]['name'] : array();
                                  $numberOfFilesUploaded = count($nameList);
                             

                                  for($i = 0; $i < $numberOfFilesUploaded; $i++){
                                    $info = getimagesize($_FILES[$item]['tmp_name'][$i]);
                                    if ($info === FALSE) {
                                    $this->addError("Unable to determine image type of uploaded file");
                                    }

                                    if (($info[2] !== IMAGETYPE_GIF) && ($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG)) {
                                        $this->addError($_FILES[$item]['name'][$i] . " Not a gif/jpeg/png");
                                    }
                                  }
                                }
                            break;

                            case 'imgRequired':
                            if($rule_value == true){
                                foreach ($_FILES[$item] as $key => $value) {
                                    if ($value[0] == "") {
                                        unset($_FILES[$item][$key]);
                                     }
                                 }

                                if(!isset($_FILES[$item]['name'])){
                                    $this->addError("No images selected.");
                                }
                            }           
                            break;

                        }
                    }
                }
            }

            if(empty($this->_errors)){
                $this->_passed = true;
            }
            return $this;
        }




        private function addError($error){
            $this->_errors[] = $error;
        }

        public function errors(){
            return $this->_errors;
        }

        public function passed(){
            return $this->_passed;
        }
    }

?>