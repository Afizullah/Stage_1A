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
                        <td><input style="cursor:pointer" id="formSelected<?php echo $formationId; ?>" type="checkbox" name="formationsSelected[]" value="<?php echo $formationId; ?>"></td>
                        <td>
                            <label style="cursor:pointer;display:block" for="formSelected<?php echo $formationId; ?>">
                                <?php echo $foramtionName; ?>
                            </label><br />
                            <?php echo $err; ?>
                        </td>
                    </tr>

                    <?php
                }
                 ?>
            </table>
            <center>
                <input type="submit" class="btn btn-info" name="selectFormations" value="Valider">
            </center>
        </form><?php
    }else{
        ?>
        <center>
            Aucune formation enregistré
        </center>
        <?php
    }
    ?>

</div>
