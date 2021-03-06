<?php
    //Control sur le droit d'accès à cette & sur l'accès à travers un lien direct
    if(defined("SESS_ADMIN_CONTROLER")){
        if(file_exists(SESS_ADMIN_CONTROLER)){
            require_once(SESS_ADMIN_CONTROLER);
        }else{
            header("Location:../");
            die("<center><b>ERROR</b>::Accès non autorisé</center>");
        }
    }else{
        header("Location:../");
        die("<center><b>ERROR</b>::Accès non autorisé</center>");
    }
?>
<?php

if (isset($_POST["addPojet"],$_POST["projet_nom"],$_POST["projet_annee_Academique"])){
    $projet_nom = secure($_POST["projet_nom"]);
    $projet_annee_Academique = secure($_POST["projet_annee_Academique"]);
    if(empty($projet_nom)){
        $errors[]="Le nom du projet ne doit pas être vide !!!";
    }else{
        if(!isAcademic($projet_annee_Academique)){
            $errors[]="L'année académique doit être au format 2XXX-2XXX";
        }else{
            if(DB::getLine("projet","*",[["projet_nom",$projet_nom]])){
                $errors[]="Un projet du même nom est déja en cours !!!";
            }
        }
    }
    if(!isset($errors)){
        if(!Projet::createProject($projet_nom,$projet_annee_Academique)){
            $errors[]="Echec de l'enregistrement du projet";
        }else{
            header("Location:index.php?page=".DEFAULT_PAGE);
            die();
        }
    }

}

?>
