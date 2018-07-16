<div style="background-color:white;min-height:500px" class="col-lg-12">
    <center>
        <h3>Créer un compte</h3><br>
    </center>
    <div style="width:80%;margin:auto;box-shadow: 0px 1px 25px rgba(0, 0, 0, 0.1);" class="">

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
</div>

</div>
