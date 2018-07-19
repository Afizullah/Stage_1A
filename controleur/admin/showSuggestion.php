<?php
if(isset($_GET["suggesId"])){
    $suggestionId = $_GET["suggesId"];
    if($suggestionId=="all"){
        $suggestions=Sugges::getNotRead($PROJET->getId());
        $term = (count($suggestions)>1)?"s":"";
        $titleSuggestion = "<h5 style='padding:10px;color:red'>Suggestion".$term." sur ".$PROJET->getName()." </h5>";
    }else{
        $suggestionId=intval($suggestionId);
        $suggestions=Sugges::getSugges($suggestionId);
        $titleSuggestion = "<h5>Suggestion de ".$suggestions[0]['user_prenom']." ".$suggestions[0]['user_nom']." </h5>";
    }
}else{
    header("Location:index.php?page=accueil");
    die();
}

?>
