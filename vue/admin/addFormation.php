<style media="screen">
    .modal-dialog {
        width: 95%;
        height: 98%;
        margin: auto;
        padding: 0;
    }

    .modal-content {
        height: auto;
        min-height: 15%;
        border-radius: 0;
    }
    .tabs-left, .tabs-right {
        border-bottom: none;
        padding-top: 2px;
    }
    .tabs-left {
        border-right: 1px solid #ddd;
    }
    .tabs-right {
        border-left: 1px solid #ddd;
    }
    .tabs-left>li, .tabs-right>li {
        float: none;
        margin-bottom: 2px;
    }
    .tabs-left>li {
        margin-right: -1px;
    }
    .tabs-right>li {
        margin-left: -1px;
    }
    .tabs-left>li.active>a,
    .tabs-left>li.active>a:hover,
    .tabs-left>li.active>a:focus {
        border-bottom-color: #ddd;
        border-right-color: transparent;
    }

    .tabs-right>li.active>a,
    .tabs-right>li.active>a:hover,
    .tabs-right>li.active>a:focus {
        border-bottom: 1px solid #ddd;
        border-left-color: transparent;
    }
    .tabs-left>li>a {
        border-radius: 4px 0 0 4px;
        margin-right: 0;
        display:block;
    }
    .tabs-right>li>a {
        border-radius: 0 4px 4px 0;
        margin-right: 0;
    }
    .vertical-text {
        margin-top:50px;
        border: none;
        position: relative;
    }
    .vertical-text>li {
        height: 20px;
        width: 120px;
        margin-bottom: 100px;
    }
    .vertical-text>li>a {
        border-bottom: 1px solid #ddd;
        border-right-color: transparent;
        text-align: center;
        border-radius: 4px 4px 0px 0px;
    }
    .vertical-text>li.active>a,
    .vertical-text>li.active>a:hover,
    .vertical-text>li.active>a:focus {
        border-bottom-color: transparent;
        border-right-color: #ddd;
        border-left-color: #ddd;
    }
    .vertical-text.tabs-left {
        left: -50px;
    }
    .vertical-text.tabs-right {
        right: -50px;
    }
    .vertical-text.tabs-right>li {
        -webkit-transform: rotate(90deg);
        -moz-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
        -o-transform: rotate(90deg);
        transform: rotate(90deg);
    }
    .vertical-text.tabs-left>li {
        -webkit-transform: rotate(-90deg);
        -moz-transform: rotate(-90deg);
        -ms-transform: rotate(-90deg);
        -o-transform: rotate(-90deg);
        transform: rotate(-90deg);
    }
</style>
<div class="modal fade" id="checkFileInit" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 style="float:left" class="modal-title" id="">SELECTIONNER UN FICHIER</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">FERMER</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="addFormationModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog modal-bg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id=""></h4>
      </div>
      <div class="modal-body">
          <form class="" action="" method="post">
              <table>
                  <tr>
                      <td></td>
                      <td></td>
                  </tr>
              </table>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">FERMER</button>
      </div>
    </div>
  </div>
</div>
<form class="" action="" method="post">

<div class="col-md-12">
	<div class="panel panel-default card-view pa-0">
		<div class="panel-wrapper collapse in">
			<div class="panel-body pa-0">
				<div class="">

					<div class="col-lg-3 col-md-4 file-directory pa-0">
						<div class="ibox float-e-margins">
							<div class="ibox-content">
								<div class="file-manager">
									<div class="mt-20 mb-20 ml-15 mr-15">
										<div class="fileupload btn btn-success btn-anim btn-block"><i class="fa fa-upload"></i><span class="btn-text">Upload files</span>
											<input type="file" class="upload">
										</div>
									</div>

									<h6 class="mb-10 pl-15">Formations</h6>
									<ul class="folder-list mb-30">
                                        <?php

                                            $init = new InitFormation();
                                            $dataInit = $init->getData();
                                            $cmpt=0;
                                            $formations = $dataInit->getFormations();
                                            foreach ($formations as $formation => $value) { ?>
                                                <li  <?php if($cmpt==0){echo 'class="active"'; } ?>><a href="#"><i class="fa fa-book"></i> <?php echo $formation; ?></a></li>
                                                <?php $cmpt++;
                                            }
                                         ?>
										<li class="active">

                                                <a href="#addFormationModal" data-toggle="modal" ><center><i class="fa fa-plus-circle"></i> Ajouter</center></a>
                                        </li>


									</ul>

									<div class="clearfix"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-9 col-md-8 file-sec pt-20">
						<div class="row">
							<div class="col-lg-12">


                                    <input type="hidden" name="formAddFormation" >
								<div class="row">
                                    <?php
                                        getHiddenInput("projetId",$PROJET->getId());
                                        $cmpt=0;
                                        $classe = array();
                                        foreach ($formations as $formation => $value) {
                                            $semestres = $dataInit->getSemestresForm($formation);
                                            $formation_nom = "formations_noms[".$cmpt."]";
                                            $formation_code = "formations_code[".$cmpt."]";
                                            $formation_semestre = "formations_semestre[".$cmpt."]";
                                            $formation_nbr_semestre = count($semestres);
                                            getHiddenInput($formation_nom,$formation);
                                            getHiddenInput($formation_code,$formation);
                                            getHiddenInput($formation_semestre,$formation_nbr_semestre);
                                            for ($i=0; $i < count($semestres) ; $i++) {
                                                 ?>
            									<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12  file-box <?php if($cmpt!=0){ echo ""; } ?>">
            										<div class="file">
        												<div class="icon">
                                                            <?php
                                                            $ues = $dataInit->getUe($formation,$semestres[$i]);
                                                            for ($k=0; $k < count($ues["CodeUe"]); $k++) {
                                                                $thisClass = $ues["thisUeDetailles"][$k]["classe"];
                                                                if(!in_array($thisClass,$classe)){
                                                                    $_class_nom = "class_".$cmpt."[]";
                                                                    getHiddenInput($_class_nom,$thisClass);
                                                                    $classe[]=$thisClass;
                                                                }

                                                                $idTmpUe = $cmpt.$i.$k;
                                                                $codeCurrentUe = $ues["CodeUe"][$k];
                                                                $detaillesUe = $ues["thisUeDetailles"][$k];
                                                                $ecUe = $dataInit->getEc($formation,$semestres[$i],$ues["CodeUe"][$k]);

                                                                getFormEditUe($cmpt,$i,$k,$codeCurrentUe,$detaillesUe,$ecUe);
                                                                ?>
                                                                <ul class⁼"folder-list mb-30">
                                                                    <li><a data-toggle="modal" title="<?php echo $detaillesUe["CodeUeIntitule"]; ?>" href="#<?php echo "infosUe".$idTmpUe; ?>"><?php echo $ues["CodeUe"][$k]; ?></a></li>
                                                                </ul>
                                                                <?php
                                                            }
                                                            ?>
        												</div>
        												<div class="file-name">
                                                            <?php
                                                                echo "SEMESTRE ".$semestres[$i]." <i style='color:blue'>(".count($ues["CodeUe"])." UE)</i>";
                                                             ?>
        													<br>
        													<span></span>
        												</div>
            										</div>
            									</div>
                                            <?php
                                            }

                                        $cmpt++;
                                    } ?>

								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
    <input type="submit" name="addFormations" value="ENREGISTRER"/>
</form>
