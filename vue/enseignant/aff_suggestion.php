<div class="col-sm-12">
    <div class="panel panel-default card-view">
        <div class="panel-heading">
            <div class="pull-left">
                <h6 class="panel-title txt-dark">Vos Suggestions</h6>
            </div>
            <div class="clearfix"></div>
        </div>
        <?php
        if (count($resu) == 0){
            echo "<p>Vous n'avez fait aucune suggestion</p>";
        }
        else{
        ?>
        <div class="panel-wrapper collapse in">
            <div class="panel-body">
                <div class="table-wrap mt-40">
                    <div class="table-responsive">
                        <table class="table mb-0" style="width:100%;">
                            <thead>
                            <tr>
                                <th style="width:15%;">Cible</th>
                                <th style="width:15%;">Nom du projet</th>
                                <th style="width:10%;">Type de suggestion</th>
                                <th style="width:40%;">Suggestion</th>
                                <th style="width:10%;">Etat</th>
                                <th style="width:10%;">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (isset($html)) {
                                echo $html;
                            }

                            for ($i = 0; $i < count($resu); $i++) {
                                ?>
                                <tr>
                                    <td>
                                        <?php
                                        if (isset($resu[$i]['suggestion_cible'])) {
                                            echo $resu[$i]['suggestion_cible'];
                                        } ?>
                                    </td>
                                    <td><?php echo $resu[$i]['projet_nom'] ?></td>
                                    <td><?php echo $resu[$i]['type'] ?></td>
                                    <td><?php echo $resu[$i]['suggestion_valeur'] ?></td>
                                    <td><?php echo $resu[$i]['suggestion_etat'] ?></td>
                                    <td>
                                        <a href=<?php echo 'index.php?page=aff_suggestion&id=' . $resu[$i]['suggestion_id']; ?> class="btn
                                           btn-success btn-sm" style="background-color: red" >Supprimer</a></td>
                                </tr>
                                <?php
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }