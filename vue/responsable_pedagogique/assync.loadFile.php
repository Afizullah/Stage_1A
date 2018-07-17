
<?php
require_once(PATH_MODEL.'admin/projet.class.php');
function modalInfos($goodHeader){
    ?>
    <div class="modal fade" id="headerFile" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="">Feuille excel correct</h4>
          </div>
          <div class="modal-body">
                  <center class="lead">
                      Une feuille excel est correct lorsque sont entête contient les attributs suivants:<br />
                  </center>
                  <?php
                  for ($i=0; $i < count($goodHeader) ; $i++) {
                      ?>
                      <span style="font-weight:bold" class="label label-success"><?php echo $goodHeader[$i]; ?></span>
                      <?php
                  }
                   ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
          </div>
        </div>
      </div>
    </div>
    <?php
}
function modalWarning($formationName,$n){
    ?>
    <div class="modal fade" id="infosFrom<?php echo $n; ?>" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
                  <center class="lead">
                      La formation <?php echo $formationName; ?> est déja intégrée dans ce projet.<br />
                      vous pouvez le selectionner si vous souhaitez la réinitialiser
                  </center>
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

    return "<a href='#headerFile' data-toggle='modal'><i  style='position:absolute;margin-left:5px;margin-top:-4px;color:#00ccff69' class='fa fa-2x fa-question-circle'></i></a>";

}
function getBtnWarning($n){
    return "<a style='float:right' href='#infosFrom".$n."' data-toggle='modal'><i  style='position:absolute;margin-left:-20px;margin-top:-25px;color:orange' class='fa fa-2x fa-info-circle'></i></a>";
}


function formationIsInCurrentProject($formation,$formsProject){
    for ($i=0; $i <count($formsProject) ; $i++) {
        if(strtolower(trim($formation))==strtolower(trim($formsProject[$i]))){
            return true;
        }
    }
    return false;
}
if (isset($_FILES["excelFileSource"])) {
    if(!empty($_FILES["excelFileSource"])){
        if($fileToLoad = moveExcelInFolder("excelFileSource",PATH_TEMPLATE."dist/xls/")){
            $LoadedFile = new LoadFile($fileToLoad);
            if(!$currentFormations = $PROJET->getFormationsNames()){
                $currentFormations = array();
            }

            modalInfos($LoadedFile->getRequiredHeadLeaft());
            if($formationsNames = $LoadedFile->getFormationsNames()){
                $formationsNames=inter_formation($formationsNames,$formations);
                $options = "<br /><center><i style='color:green' class='fa fa-2x fa-file-excel-o' aria-hidden='true'></i> Veuillez selection les formations à importer ".getBtnHelp()."</center><br /><table class='table' celspacing='2'><tr>
                <td style='width:100px'>
                 <input type='checkbox' onchange='setAllExcelFormation(this);' id='checkAllExcelFormation'  /> <label style='cursor:pointer;font-weight:bold' for='checkAllExcelFormation'>Tous</label>
                </td>
                <td></td>
                </tr>";

                for ($i=0; $i < count($formationsNames); $i++) {
                    $signal = "";
                    if(formationIsInCurrentProject($formationsNames[$i],$currentFormations)){
                        modalWarning($formationsNames[$i],$i);
                        $signal =getBtnWarning($i);
                    }
                    $options.='<tr class="btn-success" style="color:darkblue;background-color:#b59a9a26"><td style="width:50px;" ><input style="display:block" type="checkbox" class="checkedExcelFormations" name="formationsSelectedFromExcel[]" id="f'.$formationsNames[$i].'" value="'.$formationsNames[$i].'" /></td><td><label style="cursor:pointer;display:block" for="f'.$formationsNames[$i].'">'.$formationsNames[$i].'</label>'.$signal.'</td></tr>';
                }
                echo $options."</table>";
            }else{
                echo "<center style='color:red'>Aucune formation detectée dans ce fichier ".getBtnHelp()."</center>";
            }
        }else{
            echo "<center style='color:red'>Echec de la lecture du fichier </center>";
        }
    }else{
        echo center("Veuillez selectionnez un fichier excel");
    }
}else{
    echo "<center style='color:red'>Fichier non défini</center>";
}
?>
