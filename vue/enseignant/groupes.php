<?php
if(count($groupes)==0){
    echo "aucun projet";
}
else{?>
<div class="col-sm-12">
    <div class="panel panel-default card-view">
        <div class="panel-heading">
            <div class="pull-left">
                <h6 class="panel-title txt-dark">Vos Groupes</h6>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-wrapper collapse in">
            <div class="panel-body">
                <div class="table-wrap mt-40">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                              <tr>
                                <th>N°</th>
                                <th>Nom du projet</th>
                                <th>Etat du projet</th>
                                <th>Spécialité du groupe</th>
                                <th>OPTION</th>
                              </tr>
                            </thead>
                            <tbody>
    <?php
	for ($i=0;$i<count($groupes);$i++){?>
                                        <tr>
                                              <td><?php echo $i+1; ?></td>
                                              <td><?php echo $groupes[$i]['projet_nom']; ?></td>
                                              <td><?php echo $groupes[$i]['projet_etat']; ?></td>
                                              <td><?php echo $groupes[$i]['groupe_specialite']; ?></td>
                                              <td>
                                                  <table>
                                                        <tr>
                                                            <td style="width:30px">
                                                                <a class="btn btn-success  btn-sm" href="index.php?page=suggestion&id=<?php echo $groupes[$i]["groupe_id"]; ?>">Faire une suggestion</a>
                                                            </td>
                                                        </tr>
                                                  </table>
                                              </td>

                                        </tr>
    	<?php
    }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>