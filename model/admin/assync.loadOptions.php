<?php

    require_once(PATH_MODEL."admin/assync.loadSuggest.php");
    if (isset($_POST['suggestId'])) {
        var_dump($_POST['suggestId']);
        die();
        // Sugges::apply(intval($_POST['suggestId']));
        // header("Location: index.php?page=showSubjects&groupId=".$groupId);
    }

?>