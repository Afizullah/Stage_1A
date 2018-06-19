<?php
    require_once(PATH_CONTROLEUR."commun.func.php");

    //detection de la section
    if(isset($_SESSION["administrateur"])){
        $section = PATH_ADMIN;
    }else if(isset($_SESSION["enseignant"])){
        $section = PATH_ENSEIGNANT;
    }else if(isset($_SESSION["enseignant"])) {
        $section = PATH_RP;
    }else{
        $section = PATH_LOGIN;
        if(!isset($_GET["page"])){
            header("Location:index.php?page=login");
        }
    }

    //recupération de la page demandée par l'utilisateur
    if(isset($_GET["page"])){
        $page = secure($_GET["page"]);
    }else{
        $page = DEFAULT_PAGE;
    }


    //Définition du chemin de la page à charger
    $content = PATH_TEMPLATE."404.php";
    if(file_exists($section.$page.".php")){

        $content = $section.$page.".php";

        //On charge le fichier commun au traitement des données
        require_once(PATH_MODEL."commun/DB.class.php");

        //On charge le model correspondant
        if (file_exists(PATH_MODEL.$content)) {
            require_once(PATH_MODEL.$content);
        }
        
        //On charge le controleur correspondant
        if (file_exists(PATH_CONTROLEUR.$content)) {
            require_once(PATH_CONTROLEUR.$content);
        }

    }

?>
