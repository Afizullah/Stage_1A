<?php
require_once(PATH_MODEL . "admin/projet.class.php");
if (isset($_REQUEST["id"])) {
    $idProjetToLoad = secure($_REQUEST["id"]);
    Projet::setLoadedProjet($idProjetToLoad);
}
header("Location:index.php?page=accueil");
die();
?>
