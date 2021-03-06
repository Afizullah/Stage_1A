<div class="col-sm-12">
    <div class="panel panel-default card-view">
        <div class="panel-heading">
            <div class="pull-left">
                <h6 class="panel-title txt-dark">Nos projets</h6>
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
                                <th>Projet</th>
                                <th>Etape</th>
                                <th>Date de création</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php
                                if(!isset($projs)){
                                    $projs = Projet::getAll();
                                }
                                if($projs){
                                    $num=1;
                                    foreach ($projs as $proj => $value) {
                                        ?>
                                        <tr>
                                              <td><?php echo $num; ?></td>
                                              <td><?php echo $value["projet_nom"]; ?></td>
                                              <td><?php echo $value["projet_step"]; ?></td>
                                              <td><?php echo $value["projet_date_creation"]; ?></td>

                                        </tr>
                                        <?php
                                        $num++;
                                    }

                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
