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

    $infosSuggest = Sugges::getAll($PROJET->getId(),$_GET["attrib"],$_GET["ecId"]);
    // print_r($infosSuggest[0]['suggestion_valeur']);
    // print_r($infosSuggest);

    for ($i=0; $i<count($infosSuggest); $i++) {

?>

<input type="radio" name="suggestId" id="Suggestion<?php print_r($infosSuggest[0]['suggestion_id']); ?>" value="<?php print_r($infosSuggest[0]['suggestion_valeur']); ?>"> <label for="<?php print_r($infosSuggest[0]['suggestion_id']); ?>"> <?php print_r($infosSuggest[0]['suggestion_valeur']); ?> </label>

<?php } ?>
