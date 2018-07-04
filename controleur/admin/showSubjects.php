<?php

    $ecInfos = null;
    $groupId = 0;
    if (isset($_GET['groupId'])){
        $groupId = intval($_GET['groupId']);
        $ecInGroup = Subjects::getSubjectsInGroup($groupId);
        $ecWithoutGroup = Subjects::getSubjectsWithoutGroup($PROJET->getId());
    }

    if (isset($_POST['affecter'],$_POST['groupId'],$_POST['ecId'])) {
        
        $groupId = $_POST['groupId'];
        $ecId = $_POST['ecId'];
        for ($i=0; $i<count($ecId); $i++) {
           
            Subjects::recordGroup(intval($groupId),intval($ecId[$i]));
        }
    }

?>