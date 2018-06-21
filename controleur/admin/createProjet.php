<?php
if (isset($_POST["addPojet"],$_POST["projet_nom"])){
    $projet_nom = secure($_POST["projet_nom"]);
    if(empty($projet_nom)){
        $errors[]="Le nom du projet ne doit pas être vide !!!";
    }else{
        if(DB::getLine("projet","*",[["projet_nom",$projet_nom]])){
            $errors[]="Un projet du même nom est déja en cours !!!";
        }
    }
    if(!isset($errors)){
        if(!Projet::createProject($projet_nom)){
            $errors[]="Echec de l'enregistrement du projet";
        }else{
            $success = "Création réussit";
        }
    }

}
?>
