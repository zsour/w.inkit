<?php

class Hash{
    public static function make($string, $salt = ''){
        return hash('sha256', $string . $salt);
    }

    public static function salt($length){
        return bin2hex(openssl_random_pseudo_bytes($length / 2));
    }

    public static function unique(){
        return self::make(uniqid());
    }
}

?>