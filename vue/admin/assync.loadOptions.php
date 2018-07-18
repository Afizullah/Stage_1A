<?php

    $infosSuggest = Sugges::getAll($PROJET->getId(),$_GET["attrib"],$_GET["ecId"]);
    // print_r($infosSuggest[0]['suggestion_valeur']);
    // print_r($infosSuggest);

    for ($i=0; $i<count($infosSuggest); $i++) {

?>

<input type="radio" name="suggestId" id="Suggestion<?php print_r($infosSuggest[0]['suggestion_id']); ?>" value="<?php print_r($infosSuggest[0]['suggestion_valeur']); ?>"> <label for="<?php print_r($infosSuggest[0]['suggestion_id']); ?>"> <?php print_r($infosSuggest[0]['suggestion_valeur']); ?> </label>

<?php } ?>
