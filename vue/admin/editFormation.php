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
    .classNotifError,.classNotifSucces{
        float:left;
        width:100%;
        height:2px;
        margin-left:0px;
        margin-bottom:-100px
    }
    .classNotifError{
        background-color:red;
    }
    .classNotifSucces{
        background-color:green;
    }
    #deleteDialog .modal-dialog {
  position:absolute;
  top:50% !important;
  transform: translate(0, -50%) !important;
  -ms-transform: translate(0, -50%) !important;
  -webkit-transform: translate(0, -50%) !important;
  margin:auto 5%;
  width:90%;
  height:300px;
}
#deleteDialog .modal-content {
  min-height:100%;
  position:absolute;
  top:0;
  bottom:0;
  left:0;
  right:0;
}
#deleteDialog .modal-body {
  position:absolute;
  top:45px; /** height of header **/
  bottom:45px;  /** height of footer **/
  left:0;
  right:0;
  overflow-y:auto;
}
#deleteDialog .modal-footer {
  position:absolute;
  bottom:0;
  left:0;
  right:0;
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
    function changeCrediUe(ueId){
        tabHoursUe = document.getElementsByClassName("inUe"+ueId);
        var creditsUe = 0;
        for (var i = 0; i < tabHoursUe.length; i++) {
            creditsUe +=parseInt(tabHoursUe[i].value);
        }
        return creditsUe/20;
    }
    function changeShowUeInfos(classId,ueId,className,reload){
        tabUeInfos = document.getElementsByClassName(className);
        for (var i = 0; i < tabUeInfos.length; i++) {
            tabUeInfos[i].innerHTML = changeCrediUe(ueId)+" Credits";
        }
        if(reload==true){
            reloadClasseStatus(classId);
        }
    }
    function reloadClasseStatus(classId){
        tabCreditsClass = document.getElementsByClassName("ueClasse"+classId);
        var totalClasseCredit = 0;
        for (var i = 0; i < tabCreditsClass.length; i++) {
            totalClasseCredit += parseInt(tabCreditsClass[i].innerHTML.replace(" Credits",""));
        }
        if(parseInt(totalClasseCredit)==60){
            document.getElementById("showClassStatus"+classId).className="classNotifSucces";
        }else{
            document.getElementById("showClassStatus"+classId).className="classNotifError";
        }
    }
    function changeInfosCoefEc(ecId,newValue){
        if(newValue=="" || parseInt(newValue)<=0){
            document.getElementById("infosCoef"+ecId).className = document.getElementById("infosCoef"+ecId).className.replace(" label-success"," label-danger");
            newValue = 0;
        }else{
            document.getElementById("infosCoef"+ecId).className = document.getElementById("infosCoef"+ecId).className.replace(" label-danger"," label-success");
        }
        document.getElementById("valInfoCoef"+ecId).innerHTML=parseInt(newValue);
    }
</script>

<div class="col-md-12">
    <div id="deleteDialog">
        <div style="width:500px;margin:auto" class="modal fade" id="deleteElement" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" onclick="document.getElementById('passwdToDelete').value='';" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h6 style="color:red" class="modal-title" id="deleteElementTitle"></h6>
              </div>
                  <div id="container" class="modal-body">
                      <div style="text-align:center" id="deleteElementDialog">

                      </div><br />
                      <form class="" action="" method="post">
                          <input type="hidden" id="tockenDeleteForm" name="tknDel" value="">
                          <input type="hidden" id="tockenDeleteFormId" name="tkDelId" value="">
                           <div id="deleteElementContent">
                               <div class="col-lg-12 input-group">
                                 <input type="password" required id="passwdToDelete" name="password" class="form-control" placeholder="Veuillez saisir votre mot de passe">

                               </div>
                           </div>
                           <div class="text-center"><br />
                               <input class="btn btn-danger" type="submit" name="supprimerElement" value="Supprimer" />
                               <button class="btn btn-success" onclick="document.getElementById('passwdToDelete').value='';" data-dismiss="modal" type="button" name="button">Annuler</button>
                           </div>
                       </form>
                  </div>

            </div>
          </div>
        </div>
    </div>
	<div class="panel panel-default card-view pa-0">
		<div class="panel-wrapper collapse in">
			<div class="panel-body pa-0">
				<div class=""><br /><?php
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
                    } ?> <br />
					<div class="col-lg-2 col-md-4 file-directory pa-0">
						<div class="ibox float-e-margins">
							<div class="ibox-content">
								<div class="file-manager">
									<h6 class="mb-10 pl-15">Formations</h6>
									<ul class="folder-list mb-30"><?php
                                        $cmpt = 0;
                                        if($formations = Formation::getFormations($PROJET->getId())){
                                            foreach ($formations as $formation => $value) {
                                                if(isset($_GET["formation"])){
                                                    if(intval($_GET["formation"])==$value["formation_id"]){
                                                        $active = 'active';
                                                    }else{
                                                        $active = "";
                                                    }
                                                }else{
                                                    if($cmpt==0){
                                                        $active = 'active';
                                                    }else{
                                                        $active = "";
                                                    }
                                                } ?>
                                                <li  onclick="openFormation(event,'tabFormation<?php echo $value["formation_id"]; ?>')"  class="tablinksFormations <?php echo $active; ?>">
                                                    <a   href="#"><i class="fa fa-book"></i> <?php echo $value["formation_nom"]; ?></a>
                                                    <a href="#deleteElement" data-toggle="modal" onclick="openFormDropElement('formation','<?php echo $value["formation_id"]; ?>','<?php echo $value["formation_nom"]; ?>','<?php echo _hashName('formation'); ?>');" title="Supprimer la formation" style="float:right;margin-top:-30px;margin-right:10px;cursor:pointer;z-index:10000;color:white;padding:2px;border-radius:10px;width: 17px;text-align: center;">
                                                        <i style="color:white;padding:2px;border-radius:10px;width: 17px;text-align: center;" class="btn-danger fa fa-remove"></i>
                                                    </a>
                                                </li><?php
                                                $cmpt++;
                                            }
                                        } ?>
										<li class="active">
                                            <a href="index.php?page=importFormation" data-toggle="modal"
                                               style="text-align: center;"><i class="fa fa-plus-circle"></i> Ajouter</a>
                                        </li>
									</ul>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-10 col-md-8 file-sec pt-20">
						<div class="row">
							<div class="col-lg-12">
                                <input type="hidden" name="formAddFormation" >
								<div style="overflow:scroller;padding:30px;" class="row"> <?php
                                    $f_cmpt = 0;
                                    if($formations){
                                        foreach ($formations as $formation => $value) {
                                            if($classes = Formation::getClasses($value["formation_id"])){
                                                $c_cmpt=0;
                                                if(isset($_GET["formation"])){
                                                    if(intval($_GET["formation"])==$value["formation_id"]){
                                                        $active = 'active';
                                                    }else{
                                                        $active = "";
                                                    }
                                                }else{
                                                    if($f_cmpt==0){
                                                        $active = 'active';
                                                    }else{
                                                        $active = "";
                                                    }
                                                }

                                                ?>
                                                <div class="tabcontentFormation" <?php if(!$active){echo "style='display:none'"; } ?> id="tabFormation<?php echo $value["formation_id"]; ?>">
                                                    <ul class="nav nav-tabs"><?php
                                                        foreach ($classes as $classe => $value) { ?>
                                                            <li class="<?php if($c_cmpt==0){ echo 'active'; } ?>">
                                                                <a data-toggle="tab" href="#classe<?php echo $value["classe_id"]; ?>">
                                                                    <?php echo $value["classe_nom"] ?>
                                                                    <span id="showClassStatus<?php echo $value["classe_id"]; ?>" class="" ></span>
                                                                </a>
                                                            </li> <?php $c_cmpt++;
                                                        } ?>
                                                    </ul>
                                                    <div class="tab-content"><?php
                                                        $c_cmpt=0;
                                                        foreach ($classes as $classe => $value) { ?>
                                                            <div id="classe<?php echo $value["classe_id"]; ?>" class="tab-pane fade in <?php if($c_cmpt==0){ echo 'active'; } ?>">
                                                              <div>
                                                                  <div style="text-align: center;">
                                                                      <h4 class="titre">Informations relatives à la <?php echo $value["classe_nom"]; ?></h4>
                                                                  </div>
                                                                  <table class="table">
                                                                      <tr>
                                                                          <td>
                                                                              <div class="input-group">
                                                                                <span class="input-group-addon">Nom classe</span>
                                                                                <input type="text"  onchange="regChange(this.id,this.value,'notifChanged');" id="<?php _hashName("classe_nom","_".$value["classe_id"])  ?>" value="<?php echo $value["classe_nom"]; ?>" class="form-control" placeholder="Nom classe">
                                                                              </div>
                                                                          </td>
                                                                      </tr>
                                                                  </table> <?php
                                                                  if ($ues = Formation::getUes($value["classe_id"])) { ?>
                                                                      <div class="panel-group" id="accordion<?php echo $value["classe_id"]; ?>">
                                                                          <div class="panel panel-default"> <?php
                                                                              foreach ($ues as $ue => $ue_field) { ?>
                                                                                    <div class="panel-heading">
                                                                                      <h4 title="<?php echo $value["classe_nom"]; ?>" class="panel-title">
                                                                                          <table style="width:100%">
                                                                                              <tr>
                                                                                                  <td style="width:80%">
                                                                                                      <a data-toggle="collapse" style="display:block" data-parent="#accordion<?php echo $value["classe_id"]; ?>" href="#collapse<?php echo $ue_field["ue_id"]; ?>">
                                                                                                          <?php echo "Semestre ".$ue_field["ue_semestr"]." <i class='fa fa-angle-double-right'></i> ".$ue_field["ue_nom"]; ?>
                                                                                                      </a>
                                                                                                  </td>
                                                                                                  <td  style="width:17%">
                                                                                                      <span class="ueClasse<?php echo $value["classe_id"]; ?> showInfosCreditUe<?php echo $ue_field["ue_id"]; ?> label label-success"></span>
                                                                                                  </td>
                                                                                                  <td>
                                                                                                      <a  href="#deleteElement" data-toggle="modal" onclick="openFormDropElement('ue','<?php echo $ue_field["ue_id"]; ?>','<?php echo $ue_field["ue_nom"]; ?>','<?php echo _hashName('ue'); ?>');" title="Supprimer l'ue">
                                                                                                          <i style="padding:2px 3px;border-radius:20px 20px 20px 20px;" class="btn-danger fa fa-trash-o"></i>
                                                                                                      </a>
                                                                                                  </td>
                                                                                              </tr>
                                                                                          </table>
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
                                                                                          </table>
                                                                                          <table class="table">
                                                                                              <tr>
                                                                                                  <td>
                                                                                                      <div class="input-group">
                                                                                                            <span class="input-group-addon">Semestre</span>
                                                                                                            <input type="number" min=1 max=6  onchange="regChange(this.id,this.value,'notifChanged');" id="<?php _hashName("ue_semestr","_".$ue_field["ue_id"]);  ?>" class="form-control" value="<?php echo $ue_field["ue_semestr"]; ?>" placeholder="Nbr Semestre">
                                                                                                      </div>
                                                                                                  </td>
                                                                                              </tr>
                                                                                          </table>
                                                                                      </div>
                                                                                      <div style="text-align: center;">
                                                                                          <button class="btn btn-primary" data-toggle="modal" data-target="#modalEcUe<?php echo $ue_field["ue_id"]; ?>">Détails EC</button>
                                                                                      </div>
                                                                                  </div><br /><?php
                                                                                  getFormEditEc($value["classe_id"],$value["classe_nom"],$ue_field["ue_nom"],$ue_field["ue_id"]);
                                                                              } ?>
                                                                          </div>
                                                                    </div><?php
                                                                } ?>
                                                              </div>
                                                              <script>
                                                                reloadClasseStatus(<?php echo $value["classe_id"]; ?>);
                                                              </script>
                                                            </div>

                                                            <?php
                                                            $c_cmpt++;
                                                            $f_cmpt++;
                                                        } ?>
                                                    </div>
                                                </div><?php
                                            }
                                        }
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
<script type="text/javascript">
    function openFormDropElement(cible,id,name,tocken){
        document.getElementById("deleteElementTitle").innerHTML="<i class='fa fa-trash'></i> Suppresion de "+name;
        document.getElementById("deleteElementDialog").innerHTML="Vous êtes sur le point de supprimmer<br /> '"+cible+" ("+name+")'";
        document.getElementById("tockenDeleteForm").value=tocken;
        document.getElementById("tockenDeleteFormId").value=id;
    }
    function openFormation(evt, formationId) {
        var i, tabcontent, tablinksFormations;

        tabcontent = document.getElementsByClassName("tabcontentFormation");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        tablinksFormations = document.getElementsByClassName("tablinksFormations");
        for (i = 0; i < tablinksFormations.length; i++) {
            tablinksFormations[i].className = tablinksFormations[i].className.replace(" active", "");
        }

        document.getElementById(formationId).style.display = "block";
        evt.currentTarget.className += " active";
    }
    
    function asyncSugges(opt,suggesId){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200){
                try {
                    var result = JSON.parse(this.responseText);
                    if(result.status==200){
                        var dataSugges = result.data;
                        var dataSource = document.getElementById("sug_cont_"+dataSugges.sugId);
                        document.getElementById(dataSugges.destId).value=dataSugges.sugValue;
                        dataSource.style.display="none";
                        $.notify("Suggestion appliquée","info");
                    }
                } catch (error) {
                    console.log("Vérifiez la syntax json file");
                    console.log(error);
                }
               
            }
        };
        xmlhttp.open("GET", "index.php?page=assync.changeSuggesStatus&opt="+opt+"&suggestId="+suggesId, true);
        xmlhttp.send();
    }
    function applySuggestion(suggesId){
        asyncSugges("apply",suggesId);
    }
    function ignoreSuggestion(suggesId){
        alert("ignore",suggesId);
    }
</script>
