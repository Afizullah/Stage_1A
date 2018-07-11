<?php
    // echo "Bonjour";
    $idProject = $PROJET->getId();
    if (isset($_POST["addGroup"],$_POST["groupe_nom"])){
        $groupe_nom = secure($_POST["groupe_nom"]);
        // var_dump($_POST);
        // die();
        if(empty($groupe_nom)){
            $errors[]="Veuillez préciser le nom du groupe !!!";
        }else{
            if(DB::getLine("groupe","*",[["groupe_specialite",$groupe_nom]])){
                $errors[]="Un groupe du même nom existe déja !!!";
            }
        }
        if(!isset($errors)){
            if(!Group::createGroup($groupe_nom,$idProject)){
                $errors[]="Echec de l'enregistrement du groupe";
            }else{

                header("Location:index.php?page=".DEFAULT_PAGE);
                die();
            }
        }
    }

?>
