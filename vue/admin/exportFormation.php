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
<?php
/**
 * Created by PhpStorm.
 * User: Afiz
 * Date: 23/07/2018
 * Time: 11:58
 */
if (!isset($_POST["formationsSelected"], $_POST["selectFormations"])) {
    echo center("Aucune formation selectionnée pour ce projet<br /><a style='color:blue' href='index.php?page=choixexportFormation'>Exporter </a> une formation maintenant ?");
} else {
    $formation_id = $_POST["formationsSelected"];
    ?>
    <link rel="stylesheet" type="text/css"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap.min.css"/>
    <?php
    /*if (isset($_POST["selectFormations"], $_POST["formationsSelected"]) == false) {
        header("Location:index.php?page=choixexportFormation");
        echo "WTFF";
        die("");
    }*/

    function genere_entete()
    {
        $nom_colonne = getleafColsRequired();
        for ($i = 0; $i < count($nom_colonne); $i++) {
            ?>
            <th><?php echo $nom_colonne[$i]; ?></th>
            <?php
        }
    }

    function genere_ec($i, $tab)
    {
        $champs = getchamps();
        ?>
        <tr><?php
        for ($k = 0; $k < count($champs); $k++) {
            ?>
            <td><?php echo $tab[$i][$champs[$k]]; ?></td>
            <?php
        }
        ?></tr><?php
    }

    function genere_ue($i, $tab)
    {
        ?>
        <tr>
            <td><?php echo $tab[$i]['formation_code'] ?></td>
            <td><?php echo $tab[$i]['ue_code'] ?></td>
            <td></td>
            <td><?php echo $tab[$i]['ue_semestr'] ?></td>
            <td><?php echo $tab[$i]['classe_nom'] ?></td>
            <td><?php echo $tab[$i]['ec_nom'] ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <?php
        $ue = $tab[$i]['ue_id'];
        while ($ue == $tab[$i]['ue_id']) {
            genere_ec($i, $tab);
            $i++;
            if ($i == count($tab)) {
                return -1;
            }
        }
        return $i;
    }

    function genere_semestre($i, $tab)
    {
        ?>
        <tr>
            <td><?php echo $tab[$i]['formation_code'] ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td><?php echo "SEMESTRE" . $tab[$i]['ue_semestr'] ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <?php
        $semestre = $tab[$i]['ue_semestr'];
        while ($semestre == $tab[$i]['ue_semestr']) {
            $i = genere_ue($i, $tab);
            if ($i == -1) {
                return -1;
            }
        }
        return $i;
    }

    function genere_formation($tab)
    {
        $i = 0;
        while ($i != -1) {
            $i = genere_semestre($i, $tab);
        }
    }

    ?>
    <div style="overflow-x:auto;">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <?php genere_entete(); ?>
            </tr>
            </thead>
            <tbody>
            <?php
            $tableau_formation = exportForm::getFormation_form($formation_id);

            genere_formation($tableau_formation); ?>
            </tbody>
        </table>
    </div>


    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript">


        $(document).ready(function () {
            var table = $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excelHtml5',
                    title: null,
                    filename: 'test',
                }]
            });

            table.buttons().container()
                .appendTo('#example_wrapper .col-sm-6:eq(0)');
        });
    </script>

    <?php
}
?>
