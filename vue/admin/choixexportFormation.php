<?php
//Control sur le droit d'accès à cette & sur l'accès à travers un lien direct
if (defined("SESS_ADMIN_CONTROLER")) {
    if (file_exists(SESS_ADMIN_CONTROLER)) {
        require_once(SESS_ADMIN_CONTROLER);
    } else {
        header("Location:../");
        die("<div style=\"text-align: center;\"><b>ERROR</b>::Accès non autorisé</div>");
    }
} else {
    header("Location:../");
    die("<div style=\"text-align: center;\"><b>ERROR</b>::Accès non autorisé</div>");
}
?>
<?php
/**
 * Created by PhpStorm.
 * User: Afiz
 * Date: 23/07/2018
 * Time: 15:56
 */

?>
<script>
    function isOneChecked() {
        var x = document.getElementsByClassName("formation_form");
        for (var i = 0; i < x.length; i++) {
            // If you have more than one radio group, also check the name attribute
            // for the one you want as in && chx[i].name == 'choose'
            // Return true from the function on first match of a checked item
            if (x[i].type === 'radio' && x[i].checked) {
                alert(i);
                return true;
            }
        }
        // End of the loop, return false
        alert("Veuillez selectionner une formation !");
        return false;
    }
</script>

<div style="width:100%;min-height:500px;background-color:white;padding:30px;"><?php
    if ($formations) { ?>
        <form style="width:80%;margin:auto;" class="" action="index.php?page=exportFormation" method="post"
              onsubmit="return isOneChecked()">
        <h5 style="text-align:center;">Veuillez sélectionnez la formation à export au format excel</h5>
        <table class="table">
            <?php
            for ($i = 0; $i < count($formations); $i++) {
                $formationId = $formations[$i]["formation_id"];
                $formationName = $formations[$i]["formation_nom"];
                ?>
                <tr style="" class="btn-success">
                    <td><input class="formation_form" id="formSelected<?php echo $formationId; ?>" type="radio" name="formationsSelected"
                               value="<?php echo $formationId; ?>"></td>
                    <td><label style="cursor:pointer"
                               for="formSelected<?php echo $formationId; ?>"><?php echo $formationName; ?></label></td>
                </tr>
                <?php
            } ?>
        </table>

        <div style="text-align: center;">
            <input type="submit" class="btn btn-info" name="selectFormations" value="Valider">
        </div>
        </form><?php
    } else {
        br(3);
        echo center("Aucune formation pour ce projet<br /><a style='color:blue' href='index.php?page=choixexportFormation'>Exporter </a> une formation maintenant ?");
    }
    ?>

</div>
