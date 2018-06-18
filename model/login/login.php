<?php

    session_start();

    $mail = $_POST['mail'];
    $password = $_POST['password'];

    if (!empty($mail) && !empty($password)) {

        require('../../_config/conf_db.php');

        $request = $db->prepare('SELECT * FROM utilisateurs WHERE user_mail = ? AND user_mdpasse = ?');
        $query = $request->execute(array($mail, $password));

        while($data = $query->fetch()) {
            if (($mail == $data['user_mail']) && ($password == $data['user_mdpasse'])) {
                $success = true;
            } else {
                $success = false;
            }
        }

    } else {
        $success = false;
    }

?>