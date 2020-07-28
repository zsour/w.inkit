<?php
    function sanitize($str){
        return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
    }

    function decode_json_data($array){
        $returnArray = array();
        foreach ($array as $string) {
          $returnArray[] = json_decode($string[0]);
        }
  
        return $returnArray;
      }

?>