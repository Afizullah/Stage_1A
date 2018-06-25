<?php

    if (isset($_POST["addGroup"],$_POST["groupe_nom"])){
        $projet_nom = secure($_POST["groupe_nom"]);
        if(empty($groupe_nom)){
            $errors[]="Le nom du groupe ne doit pas être vide !!!";
        }else{
            if(DB::getLine("groupe","*",[["groupe_specialite",$groupe_nom]])){
                $errors[]="Un groupe du même nom existe déja !!!";
            }
        }
        if(!isset($errors)){
            if(!Group::createGroup($groupe_nom)){
                $errors[]="Echec de l'enregistrement du groupe";
            }else{
                header("Location:index.php?page=".DEFAULT_PAGE);
                die();
            }
        }
    }

?>
