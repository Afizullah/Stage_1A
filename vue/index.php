<?php
    session_start();
    require_once("../_config/config.php");
    require_once("page_to_load.php");
    require_once(PATH_TEMPLATE."head.php");
    require_once($content);
    require_once(PATH_TEMPLATE."foot.php");
?>
