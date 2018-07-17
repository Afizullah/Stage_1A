<?php
if (session_id() == "") {
    session_start();
}
if (isset($_REQUEST["confirmChoix"], $_REQUEST["choosedAccount"])) {

    foreach ($_SESSION["livretSession"] as $sess) {
        if ($sess["compte_typeCompte"] == $_REQUEST["choosedAccount"]) {

            $aliou = $_SESSION["livretSession"];
            foreach ($_SESSION as $session => $valeur) {
                unset($_SESSION[$session]);
            }
            $_SESSION["livretSession"] = $aliou;
            $_SESSION[$_REQUEST["choosedAccount"]] = $sess;
            $_SESSION["type_compte"] = $sess["compte_typeCompte"];
            header("Location:index.php?page=accueil");
            die();
        }
    }
}
?>
