<?php
if(isset($_POST["projectId"],$_POST["newProjectName"])){
    if(!empty(secure($_POST["newProjectName"]))){
        if($PROJET->setName(secure($_POST["newProjectName"]))){
            echo "Changement ...";
        }else{
            echo "<span style='color:red'>Echec modification</span>";
        }
    }
}else{
    die("Access denied");
}
 ?>
