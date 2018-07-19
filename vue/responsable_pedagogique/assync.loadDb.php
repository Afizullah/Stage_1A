<?php
function modalWarning($formationName,$n){
    ?>
    <div class="modal fade" id="infosDbFrom<?php echo $n; ?>" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
                  <div class="lead" style="text-align: center;">
                      La formation <?php echo $formationName; ?> est déja intégrée dans ce projet.<br />
                      vous pouvez le selectionner si vous souhaitez la réinitialiser
                  </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
          </div>
        </div>
      </div>
    </div>
    <?php
}
function getBtnHelp(){

    return "<a href='#headerDbProject' data-toggle='modal'><i  style='position:absolute;margin-left:5px;margin-top:-4px;color:#00ccff69' class='fa fa-2x fa-question-circle'></i></a>";

}
function getBtnWarning($n){
    return "<a style='float:right' href='#infosDbFrom".$n."' data-toggle='modal'><i  style='position:absolute;margin-left:-20px;margin-top:-25px;color:orange' class='fa fa-2x fa-info-circle'></i></a>";
}


function formationIsInCurrentProject($formation,$formsProject){
    for ($i=0; $i <count($formsProject) ; $i++) {
        if(strtolower(trim($formation))==strtolower(trim($formsProject[$i]))){
            return true;
        }
    }
    return false;
}
if (isset($_POST["idProjectToImport"])) {
    $idProjectToImport = intval($_POST["idProjectToImport"]);
    if($formationsProjet = Formation::getFormations($idProjectToImport)){
        if($formationsNames = getFormationsNames($formationsProjet)){
            $formationsNames=inter_formation($formationsNames,$formations);
            if(!$currentFormations = $PROJET->getFormationsNames()){
                $currentFormations = array();
            }
            $options = "<br /><div style=\"text-align: center;\"><i style='color:red' class='fa fa-2x fa-database' aria-hidden='true'></i> Veuillez selection les formations à importer</div><br /><table class='table' celspacing='2'><tr>
            <td style='width:100px'>
             <input type='checkbox' onchange='setAllDbFormation(this);' id='checkAllDbFormation'  /> <label style='cursor:pointer;font-weight:bold' for='checkAllDbFormation'>Tous</label>
            </td>
            <td>

            </td>
            </tr>";
            for ($i=0; $i < count($formationsNames); $i++) {
                $signal = "";
                if(formationIsInCurrentProject($formationsNames[$i],$currentFormations)){
                    modalWarning($formationsNames[$i],$i);
                    $signal =getBtnWarning($i);
                }
                $options.='<tr class="btn-success" style="color:darkblue;background-color:#b59a9a26"><td style="width:50px;" ><input style="display:block" type="checkbox" class="checkedDbFormations" name="formationsSelectedFromDb[]" id="d'.$formationsNames[$i].'" value="'.$formationsNames[$i].'" /></td><td><label style="cursor:pointer;display:block" for="d'.$formationsNames[$i].'">'.$formationsNames[$i].'</label>'.$signal.'</td></tr>';
            }
            echo $options."</table>";
        }else{
            echo center("<span style='color:red'>Aucune donnée trouvé dans ce projet</span>");
        }
    }else{
        echo center("<span style='color:red'>Aucune donnée trouvé dans ce projet</span>");
    }
}else{
    echo "<div style=\"color:red; text-align: center;\">Projet non défini</div>";
}
?>
