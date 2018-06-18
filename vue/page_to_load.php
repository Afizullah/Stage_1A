<?php
    require_once(PATH_CONTROLEUR."commun.func.php");
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

    $content = PATH_TEMPLATE."404.php";
    if(isset($_GET["page"])){
        $page = secure($_GET["page"]);
    }else{
        $page = DEFAULT_PAGE;
    }

    if(file_exists($section.$page.".php")){
        $content = $section.$page.".php";
        if (file_exists(PATH_CONTROLEUR.$content)) {
            require_once(PATH_CONTROLEUR.$content);
        }
        if (file_exists(PATH_MODEL.$content)) {
            require_once(PATH_MODEL.$content);
        }
    }

?>
