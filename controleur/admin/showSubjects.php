<?php

    $ecInfos = null;
    if (isset($_GET['groupId'])){
        $groupId = intval($_GET['groupId']);
        $ecInfos = Subjects::getSubjectsGroup($groupId);
    }

?>