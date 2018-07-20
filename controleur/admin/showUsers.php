<?php

if (isset($_POST["editGroupeListe"])) {
    if (isset($_POST['link'])) {
        $groupes = $PROJET->getGroupes();
        foreach ($groupes as $groupe => $v) {
            $grId = $v["groupe_id"];
            ShowUsers::deleteGroup($grId);
        }
        for ($i = 0; $i < count($_POST["link"]); $i++) {
            $id = explode(";", ($_POST["link"][$i]));
            if (count($id) == 2) {
                $userId = (int)$id[0];
                $groupId = (int)$id[1];

                ShowUsers::registerGroup($userId, $groupId);
            }
        }
    }
}

?>
