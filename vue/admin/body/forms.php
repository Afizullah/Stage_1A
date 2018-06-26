<?php
function getFormAddUsser($action="",$type_compte="",$date_expiration="",$email="",$prenom="",$nom=""){
    if($date_expiration){
        $_SESSION["dext"]=$date_expiration;
    } ?>
    <form style="width:500px;margin:auto;background-color:white;padding:30px;" action="<?php echo $action; ?>" method="POST">
        <div class="input-group">
            <span class="input-group-addon">Type de compte : </span>
            <select required class="form-control" name="accountType">
                <option value="">----Séléctionner----</option>
                <option <?php echo ($type_compte=="administrateur")?"selected":""; ?> value="administrateur">Administrateur</option>
                <option <?php echo ($type_compte=="responsable_pedagogique")?"selected":""; ?>  value="responsable_pedagogique">Responsable Pédagogique</option>
                <option <?php echo ($type_compte=="enseignant")?"selected":""; ?>  value="enseignant">Enseignant</option>
            </select>
        </div><br />
        <div class="input-group">
            <span class="input-group-addon">Date d'expiration : </span>
            <input required type="date" class="form-control" value="<?php if(isset($_SESSION["dext"])){echo $_SESSION["dext"]; } ?>" name="date_expiration" placeholder="">
        </div><br />
        <div class="input-group">
            <span class="input-group-addon">Email : </span>
            <input required type="text" value="<?php echo $email; ?>" class="form-control" name="mail" placeholder="">
        </div><br />
        <div class="input-group">
            <span class="input-group-addon">Prénom : </span>
            <input required type="text" value="<?php echo $prenom; ?>" class="form-control" name="prenom" placeholder="">
        </div><br />
        <div class="input-group">
              <span class="input-group-addon">Nom : </span>
              <input required type="text" value="<?php echo $nom; ?>" class="form-control" name="nom" placeholder="">
        </div><br />
        <center>
              <input type="submit" class="btn btn-success" class="form-control" name="addUser" value="Créer un compte">
        </center>
    </form>
    <?php
}
function getFromCreateProjet($nomProjet="",$action=""){
    ?>
    <form style="width:500px;margin:auto;background-color:white;padding:30px;" action="<?php echo $action; ?>" method="POST">
        <div class="input-group">
              <span class="input-group-addon">Nom du projet : </span>
              <input required type="text" class="form-control" name="projet_nom" value="<?php echo $nomProjet; ?>" placeholder="Ex: Projet Livrets 2000">
        </div> <br />
        <center>
              <input type="submit" class="btn btn-success" class="form-control" name="addPojet" value="Créer un projet">
        </center>
    </form>

    <?php
}


function getFromCreateGroup($nomGroup="",$action=""){
    ?>
    <form style="width:500px;margin:auto;background-color:white;padding:30px;" action="<?php echo $action; ?>" method="POST">
        <div class="input-group">
              <span class="input-group-addon">Nom du groupe : </span>
              <input required type="text" class="form-control" name="groupe_nom" value="<?php echo $nomGroup; ?>" placeholder="Ex: Informatique">
        </div><br />
        <center>
              <input type="submit" class="btn btn-success" class="form-control" name="addGroup" value="Créer un groupe">
        </center>
    </form>

    <?php
}
function getFormEditUe($id,$codeUe,$detaillesUe,$ecUe){
    ?>
    <div class="modal fade" id="<?php echo "infosUe".$id; ?>" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
              <h5 style="float:left" class="modal-title" id="">Informations de l'UE <?php echo $codeUe."<span style='color:blue'> (".$detaillesUe['CodeUeIntitule'].")</span>"; ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
              <center>

              <table>
                  <caption style="text-align:center;font-weight:bold;font-size:15px;color:red;text-decoration:underline">Informations relatives à l'UE</caption>
                  <tr>
                      <td>
                          <div class="input-group">
                            <span class="input-group-addon">Code UE</span>
                            <input type="text" class="form-control" name="codeUe[<?php echo $id; ?>]" value="<?php echo $codeUe; ?>" placeholder="Code UE">
                          </div>
                      </td>
                      <td>
                          <div class="input-group">
                            <span class="input-group-addon">Intitulé UE</span>
                            <input type="text" class="form-control" name="intituleUe[<?php echo $id; ?>]" value="<?php echo $detaillesUe["CodeUeIntitule"]; ?>" placeholder="Intitulé de  l'UE">
                          </div>
                      </td>
                      <td>
                          <div class="input-group">
                            <span class="input-group-addon">Nombre de credits UE</span>
                            <input type="text" class="form-control" name="nbrCreditsUe[<?php echo $id; ?>]" value="<?php echo $detaillesUe["credit"]; ?>" placeholder="Le nombre de credits de l'UE">
                          </div>
                      </td>
                  </tr>
              </table>
              <table border="1">
                  <caption>Les EC de l'UE <?php echo $detaillesUe['CodeUeIntitule']; ?></caption>
                  <tr>
                      <th>Code EC</th>
                      <th>Type de compétences</th>
                      <th>competence</th>
                      <th>matiere</th>
                      <th>prerequis</th>
                      <th>contenu</th>
                      <th>Coef</th>
                      <th>Nbr Heures CM</th>
                      <th>Nbr Heures TD</th>
                      <th>Nbr Heures TP</th>
                      <th>Nbr Heures TPE</th>
                  </tr>
                  <?php
                  for ($i=0; $i < count($ecUe["CodeEC"]); $i++) {
                      $codeEc = $ecUe["CodeEC"][$i];
                      $TypeCompetence = $ecUe["TypeCompetence"][$i];
                      $competence = $ecUe["competence"][$i];
                      $matiere = $ecUe["matiere"][$i];
                      $prerequis = $ecUe["prerequis"][$i];
                      $contenu = $ecUe["contenu"][$i];
                      $coef = $ecUe["coef"][$i];
                      $nbrHeurCM = $ecUe["nbrHeurCM"][$i];
                      $nbrHeurTD = $ecUe["nbrHeurTD"][$i];
                      $nbrHeurTP = $ecUe["nbrHeurTP"][$i];
                      $nbrHeurTPE = $ecUe["nbrHeurTPE"][$i];
                     ?>
                     <tr>
                         <td><input type="text" class="form-control" name="" value="<?php echo $codeEc; ?>" placeholder=""></td>
                         <td><input type="text" class="form-control" name="" value="<?php echo $TypeCompetence; ?>" placeholder=""></td>
                         <td><input type="text" class="form-control" name="" value="<?php echo $competence; ?>" placeholder=""></td>
                         <td><input type="text" class="form-control" name="" value="<?php var_dump($matiere); ?>" placeholder=""></td>
                         <td><input type="text" class="form-control" name="" value="<?php echo $prerequis; ?>" placeholder=""></td>
                         <td><input type="text" class="form-control" name="" value="<?php echo $contenu; ?>" placeholder=""></td>
                         <td><input type="text" class="form-control" name="" value="<?php echo $coef; ?>" placeholder=""></td>
                         <td><input type="text" class="form-control" name="" value="<?php echo $nbrHeurCM; ?>" placeholder=""></td>
                         <td><input type="text" class="form-control" name="" value="<?php echo $nbrHeurTD; ?>" placeholder=""></td>
                         <td><input type="text" class="form-control" name="" value="<?php echo $nbrHeurTP; ?>" placeholder=""></td>
                         <td><input type="text" class="form-control" name="" value="<?php echo $nbrHeurTPE; ?>" placeholder=""></td>
                     </tr>
                     <?php
                  }

                  ?>

              </table>
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
 ?>
