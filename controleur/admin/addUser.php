<?php

    if(isset($_POST['addUser'])){
        if(isset($_POST['prenom'],$_POST['nom'],$_POST['mail'],$_POST['date_expiration'],$_POST['accountType'])){
            $mail = secure($_POST['mail']);
            if(!isEmail($mail)) {
                echo 'Veuillez vérifier l\'adresse mail saisie';
            }
        }
    }

?>