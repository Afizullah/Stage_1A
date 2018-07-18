<?php

    $ecInGroup = null;
    $groupId = 0;
    if (isset($_GET['groupId'])){
        $groupId = intval($_GET['groupId']);
        $ecInGroup = Subjects::getSubjectsInGroup($groupId);
        $ecWithoutGroup = Subjects::getSubjectsWithoutGroup($PROJET->getId());
    }

    if (!empty($_POST['affecter']) && !empty($_POST['groupId']) && !empty($_POST['ecId'])) {
        $groupId = $_POST['groupId'];
        $ecId = $_POST['ecId'];
        for ($i=0; $i<count($ecId); $i++) {
            Subjects::recordGroup(intval($groupId),intval($ecId[$i]));
            header("Location:index.php?page=showSubjects&groupId=".$groupId);
        }
    }

    if (isset($_POST['appliquerNom'])) {
        // var_dump($_POST['suggestId']);
        // die();
        Sugges::apply(intval($_POST['suggestId']));
        header("Location: index.php?page=showSubjects&groupId=".$groupId);
    }

    $suggestions = Subjects::getSuggestion();

?>