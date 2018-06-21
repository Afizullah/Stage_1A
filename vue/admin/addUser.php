<?php
    $hasError = false;

    if(isset($errors)){
        alertErrors($errors);
        $hasError=true;
    }
    if(isset($success)){
        alertSucces($success);
    }
    
    if($hasError){
        getFormAddUsser("",$typeDeCompte,$date_expiration,$mail,$prenom,$nom);
    }else{
        getFormAddUsser();
    }
?>
