<?php

$participantsInGroup = null;
$groupId = 0;
if (isset($_GET['groupId'])) {
    $groupId = intval($_GET['groupId']);
    $participantsInGroup = Participants::getParticipantsInGroup($groupId);
    $participantsWithoutGroup = Participants::getParticipantsWithoutGroup($PROJET->getId());
}

if (isset($_POST['affecter'], $_POST['groupId'], $_POST['userId'])) {

    $groupId = $_POST['groupId'];
    $userId = $_POST['userId'];
    for ($i = 0; $i < count($userId); $i++) {
        Participants::recordGroup(intval($groupId), intval($userId[$i]));
    }
    header("Location:index.php?page=showParticipants&groupId=" . $groupId);
}


?>