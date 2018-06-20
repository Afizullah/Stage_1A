<?php
    $hasError = false;
    if(isset($errors)){
        foreach ($errors as $error) {
            ?>
            <center>
                <span class="error"><?php echo $error; ?></span><br />
            </center>
            <?php
        }
        $hasError=true;
    }
    if(isset($success)){
        ?>
        <center>
            <span class="success"><?php echo $success; ?></span>
        </center>
        <?php
    }
    if($hasError){
        getFormAddUsser("",$typeDeCompte,$date_expiration,$mail,$prenom,$nom);
    }else{
        getFormAddUsser();
    }
?>
