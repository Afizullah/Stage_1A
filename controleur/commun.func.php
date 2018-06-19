<?php

    //fonction contre les injection sql
    function secure($val){
        return htmlspecialchars(trim($val));
    }

    //
    function isEmail($val){
        if(preg_match("#^[a-z0-9._-]{2,50}[@][a-z0-9._-]{2,30}[.][a-z]{2,6}$#",$val)){
            return $val;
        }else{
            return false;
        }
    }

    function _hash($string){
        return hash("sha256",$string);
    }
    function today($format="fr"){
        switch ($format) {
            case 'fr':
                return date("Y-m-d");
        }
    }
?>
