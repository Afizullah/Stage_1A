<?php
    //Control sur le droit d'accès à cette & sur l'accès à travers un lien direct
    if(defined("SESS_ADMIN_CONTROLER")){
        if(file_exists(SESS_ADMIN_CONTROLER)){
            require_once(SESS_ADMIN_CONTROLER);
        }else{
            header("Location:../");
            die("<div style=\"text-align: center;\"><b>ERROR</b>::Accès non autorisé</div>");
        }
    }else{
        header("Location:../");
        die("<div style=\"text-align: center;\"><b>ERROR</b>::Accès non autorisé</div>");
    }
?>
<style media="screen">
fieldset {
    display: block;
    margin-left: 2px;
    margin-right: 2px;
    padding-top: 0.35em;
    padding-bottom: 0.625em;
    padding-left: 0.75em;
    padding-right: 0.75em;
    border: 1px solid grey;
}
</style>
<div style="max-width:600px;margin:auto;padding:30px;background-color:white;" class="">

    <div style="text-align: center;">
        <h5>Créer un nouveau projet</h5>
    </div>
    <?php
        $hasError = false;
        if(isset($errors)){
            alertErrors($errors);
            $hasError=true;
        }
        if(isset($success)){
            alertSucces($success);
        }
    ?>
    <fieldset >
        <?php
            if($hasError && isset($_POST["projet_nom"],$_POST["projet_annee_Academique"])){
                getFromCreateProjet($_POST["projet_nom"],"",$_POST["projet_annee_Academique"]);
            }else{
                getFromCreateProjet();
            }
        ?>
    </fieldset>
</div>
