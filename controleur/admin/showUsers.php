<?php

    if(isset($_POST["editGroupeListe"])){
        if (isset($_POST['link'])) {
            for($i=0; $i<count($_POST["link"]); $i++) {
                $id = explode(";",($_POST["link"][$i]));
                if (count($id) == 2) {
                    $userId = (int)$id[0];
                    $groupId = (int)$id[1];
                    ShowUsers::deleteGroup($userId,$groupId);
                    ShowUsers::registerGroup($userId,$groupId);
                } else {
                    echo("Veuillez sélectionner un groupe");
                }
            }
        }  
    }

?>
