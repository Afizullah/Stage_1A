<?php
    session_start();
    require_once("../_config/config.php");
    require_once("page_to_load.php");
    require_once(PATH_TEMPLATE."head.php");

    //on charge le template (header) correspondant à la section
    if(file_exists($section."body/_body.php")){

        require_once($section."body/_body.php");
    }

    //on charge la page
    require_once($content);

    //on charge le template (footer) correspondant à la section
    if(file_exists($section."body/_footer.php")){
        require_once($section."body/_footer.php");
    }
    require_once(PATH_TEMPLATE."foot.php");
?>
