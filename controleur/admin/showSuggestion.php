<?php
if(isset($_GET["suggesId"])){
    $suggestionId = $_GET["suggesId"];
    if($suggestionId=="all"){
        $suggestions=Sugges::getNotRead($PROJET->getId());
    }else{
        $suggestionId=intval($suggestionId);
        $suggestions=Sugges::getNotRead($PROJET->getId());
    }
}else{
    header("Location:index.php?page=accueil");
    die();
}

?>
