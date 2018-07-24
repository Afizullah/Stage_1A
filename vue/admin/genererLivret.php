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
<div style="width:100%;min-height:500px;background-color:white;padding:30px;"><?php
    $formations=$PROJET->getFormations();

    $CONTROL = new LMD($PROJET->getId());
    $eligiblesFormations = $CONTROL->getEligibleFormations();
    $notEligiblesFormations = $CONTROL->getNotEligibleFormations();

    if($formations){ ?>
        <form  style="width:80%;margin:auto;" class="" action="index.php?page=livret" method="post">
            <h5 style="text-align:center;">Veuillez selectionner les formations à inclure dans le livret</h5>
            <table class="table">
                <?php
                for ($i=0; $i < count($eligiblesFormations); $i++) {
                    $formationId = $eligiblesFormations[$i]["formationId"];
                    $foramtionName = $eligiblesFormations[$i]["formationName"];
                    ?>
                    <tr style="" class="btn-success">
                        <td><input id="formSelected<?php echo $formationId; ?>" type="checkbox" name="formationsSelected[]" value="<?php echo $formationId; ?>"></td>
                        <td><label style="cursor:pointer" for="formSelected<?php echo $formationId; ?>"><?php echo $foramtionName; ?></label></td>
                    </tr>
                    <?php
                } ?>
            </table>
            <table class="table">
                <?php
                for ($i=0; $i < count($notEligiblesFormations) ; $i++) {
                    $formationId = $notEligiblesFormations[$i]["formationId"];
                    $foramtionName = $notEligiblesFormations[$i]["formationName"];
                    $formationErreur = $notEligiblesFormations[$i]["errors"];
                    $err="";
                    for ($jj=0; $jj < count($formationErreur) ; $jj++){
                        $err.="<div class='error'> $formationErreur[$jj] <a class='label label-success' href='index.php?page=editFormation&formation=".$formationId."'>Corriger</a> </div>";
                    }
                    ?>
                    <tr  class="btn-warning">

                        <td colspan="2">
                            <label style="display:block" for="formSelected<?php echo $formationId; ?>">
                                <?php echo $foramtionName; ?>
                            </label><br />
                            <?php echo $err; ?>
                        </td>
                    </tr>

                    <?php
                }
                 ?>
            </table>
            <div style="text-align: center;">
                <input type="submit" class="btn btn-info" name="selectFormations" value="Valider">
            </div>
        </form><?php
    }else{
        br(3);
        echo center("Aucune formation pour ce projet<br /><a style='color:blue' href='index.php?page=importFormation'>Importer </a> une formation maintenant ?");
    }
    ?>

</div>
