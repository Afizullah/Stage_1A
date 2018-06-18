<?php
 if(isset($_POST["login"],$_POST["mail"],$_POST["password"])){
    $mail = $_POST['mail'];
    $password = $_POST['password'];

    if (!empty($mail) && !empty($password)) {

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
}
?>
