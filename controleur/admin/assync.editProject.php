<?php
    //Control sur le droit d'accès à cette & sur l'accès à travers un lien direct
    if(defined("SESS_ADMIN_CONTROLER")){
        if(file_exists(SESS_ADMIN_CONTROLER)){
            require_once(SESS_ADMIN_CONTROLER);
        }else{
            header("Location:../");
            die("<center><b>ERROR</b>::Accès non autorisé</center>");
        }
    }else{
        header("Location:../");
        die("<center><b>ERROR</b>::Accès non autorisé</center>");
    }
?>
<?php
if (isset($_POST["projectId"], $_POST["newProjectName"])) {
    if (!empty(secure($_POST["newProjectName"]))) {
        if ($PROJET->setName(secure($_POST["newProjectName"]))) {
            echo "Changement ...";
        } else {
            echo "<span style='color:red'>Echec modification</span>";
        }
    }
} else {
    die("Access denied");
}
?>
