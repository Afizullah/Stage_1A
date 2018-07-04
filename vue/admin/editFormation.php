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
    .titre{
        color:blue;
        margin-top: 20px;

    }
</style>
<script type="text/javascript">
    function regChange(elementId,value,notifIn) {
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById(notifIn).style="opacity:1;float:right;margin-top:-20px;color:red";
                $("#"+notifIn).fadeTo(3000,2).slideUp(500, function(){

                });
                document.getElementById(notifIn).innerHTML = this.responseText;
            }
        };

        xmlhttp.open("GET", "index.php?page=regChange&q=" + elementId + "&val=" + value, true);
        xmlhttp.send();

    }
    function regChangeEc(elementId,value,notifIn) {
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById(notifIn).style="background-color:white;z-index:1000;opacity:1;position:absolute;color:red;width:96%;text-align:center;margin:auto";
                $("#"+notifIn).fadeTo(3000,2).slideUp(500, function(){

                });
                document.getElementById(notifIn).innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "index.php?page=regChange&q=" + elementId + "&val=" + value, true);
        xmlhttp.send();

    }
</script>
</script>
<!--<div class="alert alert-success" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Success!</strong> You have been signed in successfully!
</div>-->
<script>
</script>
<div class="col-md-12">
	<div class="panel panel-default card-view pa-0">
		<div class="panel-wrapper collapse in">
			<div class="panel-body pa-0">
				<div class="">
                    <br />
                    <?php
                        $hasError = false;
                        if(isset($errors)){
                            alertErrors($errors);
                            $hasError=true;
                        }
                        if(isset($success)){
                            alertSucces($success);
                        }
                        if(isset($warning)){
                            alertWarning($warning);
                        }
                    ?>
                    <br />
					<div class="col-lg-3 col-md-4 file-directory pa-0">
						<div class="ibox float-e-margins">
							<div class="ibox-content">
								<div class="file-manager">

									<h6 class="mb-10 pl-15">Formations</h6>
									<ul class="folder-list mb-30">
                                        <?php
                                            $cmpt = 0;
                                            if($formations = Formation::getFormations($PROJET->getId())){
                                                foreach ($formations as $formation => $value) { ?>
                                                    <li  <?php if($cmpt==0){echo 'class="active"'; } ?>><a href="#"><i class="fa fa-book"></i> <?php echo $value["formation_nom"]; ?></a></li>
                                                    <?php $cmpt++;
                                                }
                                            }
                                         ?>
										<li class="active">
                                                <a href="index.php?page=addFormation" data-toggle="modal" ><center><i class="fa fa-plus-circle"></i> Ajouter</center></a>
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
								<div style="overflow:scroller;padding:30px;" class="row">


                                    <?php
                                        $f_cmpt = 0;
                                        if($formations){
                                        foreach ($formations as $formation => $value) {
                                            if($classes = Formation::getClasses($value["formation_id"])){
                                                $c_cmpt=0; ?>
                                                <ul class="nav nav-tabs"><?php
                                                    foreach ($classes as $classe => $value) { ?>
                                                        <li class="<?php if($c_cmpt==0){ echo 'active'; } ?>">
                                                            <a data-toggle="tab" href="#classe<?php echo $value["classe_id"]; ?>"><?php echo $value["classe_nom"] ?></a>
                                                        </li> <?php $c_cmpt++;
                                                    } ?>
                                                </ul>
                                                <div class="tab-content">
                                                    <?php
                                                    $c_cmpt=0;
                                                    foreach ($classes as $classe => $value) {
                                                        ?>
                                                        <div id="classe<?php echo $value["classe_id"]; ?>" class="tab-pane fade in <?php if($c_cmpt==0){ echo 'active'; } ?>">
                                                          <div>
                                                              <center>
                                                                  <h4 class="titre">Informations relatives à la <?php echo $value["classe_nom"]; ?></h4>
                                                              </center>
                                                              <table class="table">
                                                                  <tr>
                                                                      <td>
                                                                          <div class="input-group">
                                                                            <span class="input-group-addon">Nom classe</span>
                                                                            <input type="text"  onchange="regChange(this.id,this.value,'notifChanged');" id="<?php _hashName("classe_nom","_".$value["classe_id"])  ?>" value="<?php echo $value["classe_nom"]; ?>" class="form-control" placeholder="Nom classe">
                                                                          </div>
                                                                      </td>
                                                                  </tr>
                                                              </table>
                                                              <?php
                                                              if ($ues = Formation::getUes($value["classe_id"])) { ?>
                                                                  <div class="panel-group" id="accordion<?php echo $value["classe_id"]; ?>">
                                                                      <div class="panel panel-default">
                                                                          <?php
                                                                          foreach ($ues as $ue => $ue_field) { ?>
                                                                                <div class="panel-heading">
                                                                                  <h4 title="<?php echo $value["classe_nom"]; ?>" class="panel-title">
                                                                                    <a data-toggle="collapse" style="display:block" data-parent="#accordion<?php echo $value["classe_id"]; ?>" href="#collapse<?php echo $ue_field["ue_id"]; ?>">
                                                                                    <?php echo "Semestre ".$ue_field["ue_semestr"]." <i class='fa fa-angle-double-right'></i> ".$ue_field["ue_nom"]; ?></a><a class="" style="float:right;margin-top:-25px" href="#"><i style="padding:2px 3px;border-radius:20px 20px 20px 20px;" class="btn-danger fa fa-trash-o"></i></a>
                                                                                  </h4>
                                                                                </div>
                                                                                <div id="collapse<?php echo $ue_field["ue_id"]; ?>" class="panel-collapse collapse fade">
                                                                                  <div class="panel-body">
                                                                                      <table class="table">
                                                                                          <tr>
                                                                                              <td>
                                                                                                  <div class="input-group">
                                                                                                        <span class="input-group-addon">Code UE</span>
                                                                                                        <input type="text" onchange="regChange(this.id,this.value,'notifChanged');" id="<?php _hashName("ue_code","_".$ue_field["ue_id"]);  ?>" class="form-control" value="<?php echo $ue_field["ue_code"]; ?>" placeholder="Code UE">
                                                                                                  </div>
                                                                                              </td>
                                                                                              <td>
                                                                                                  <div class="input-group">
                                                                                                        <span class="input-group-addon">Nom UE</span>
                                                                                                        <input type="text"  onchange="regChange(this.id,this.value,'notifChanged');" id="<?php _hashName("ue_nom","_".$ue_field["ue_id"]);  ?>" class="form-control" value="<?php echo $ue_field["ue_nom"]; ?>" placeholder="Nom UE">
                                                                                                  </div>
                                                                                              </td>
                                                                                          </tr>

                                                                                          <tr>
                                                                                              <td>
                                                                                                  <div class="input-group">
                                                                                                        <span class="input-group-addon">Semestre</span>
                                                                                                        <input type="text"  onchange="regChange(this.id,this.value,'notifChanged');" id="<?php _hashName("ue_semestr","_".$ue_field["ue_id"]);  ?>" class="form-control" value="<?php echo $ue_field["ue_semestr"]; ?>" placeholder="Nbr Semestre">
                                                                                                  </div>
                                                                                              </td>
                                                                                              <td>
                                                                                                  <div class="input-group">
                                                                                                        <span class="input-group-addon">Nbr Credit</span>
                                                                                                        <input type="text" id="" class="form-control" value="" placeholder="Nbr credit">
                                                                                                  </div>
                                                                                              </td>
                                                                                          </tr>
                                                                                      </table>
                                                                                  </div>
                                                                                  <center>
                                                                                      <button class="btn btn-primary" data-toggle="modal" data-target="#modalEcUe<?php echo $ue_field["ue_id"]; ?>">Détails EC</button>
                                                                                  </center>
                                                                              </div><br /><?php
                                                                              getFormEditEc($value["classe_nom"],$ue_field["ue_nom"],$ue_field["ue_id"]);
                                                                          } ?>
                                                                      </div>
                                                                </div><?php
                                                            } ?>
                                                          </div>
                                                        </div>
                                                        <?php
                                                        $c_cmpt++;
                                                    } ?>
                                                </div>
                                                <br />
                                                <br />
                                                <br />

                                                <?php
                                            }
                                        }
                                    }
                                     ?>

								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
