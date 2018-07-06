<div style="width:100%;min-height:500px;background-color:white;padding:30px;"><?php
    $formations=$PROJET->getFormations();
    if($formations){ ?>
        <form  style="width:80%;margin:auto;" class="" action="index.php?page=livret" method="post">
            <h5 style="text-align:center">Veuillez selectionner les formations à inclure dans le livret</h5>
            <table>
                <?php
                for ($i=0; $i < count($formations); $i++) {
                    $formationId = $formations[$i]["formation_id"];
                    $foramtionName = ($formations[$i]["formation_nom_complet"])?$formations[$i]["formation_nom_complet"]:$formations[$i]["formation_nom"];
                    ?>
                    <tr>
                        <td><input id="formSelected<?php echo $formationId; ?>" type="checkbox" name="formationsSelected[]" value="<?php echo $formationId; ?>"></td>
                        <td><label style="cursor:pointer" for="formSelected<?php echo $formationId; ?>"><?php echo $foramtionName; ?></label></td>
                    </tr>

                    <?php
                } ?>
            </table>
            <center>
                <input type="submit" name="selectFormations" value="Valider">
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
