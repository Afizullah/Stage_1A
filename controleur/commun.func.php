<?php

    //fonction contre les injections sql
    function secure($val){
        return htmlspecialchars(trim($val));
    }

    function br(){
        echo "<br />";
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

    function getNewToken($defaultSize=50){
        return generateNewString($defaultSize);
    }

    function generateNewString($lenght,$toString=array(),$notInTab=array()){
      if(empty($toString)){
        $toString = "aazertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN1234567890";
      }
        $stringGenerate ="";
        if($lenght>0 && intval(strlen("".$toString.""))>0){
        	do{
        		for($i=	0;$i<intval($lenght);$i++){
        			$stringGenerate.=$toString[mt_rand(0,intval(strlen("".$toString."")-1))];
        		}
        	}while(in_array($stringGenerate,$notInTab));
        	return $stringGenerate;
        }else{
        	return NULL;
        }
    }
?>
