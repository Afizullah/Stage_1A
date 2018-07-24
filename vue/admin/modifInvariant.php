<?php
    //Control sur le droit d'accès à cette & sur l'accès à travers un lien direct
    if(defined("SESS_ADMIN_CONTROLER")){
        if(file_exists(SESS_ADMIN_CONTROLER)){
            require_once(SESS_ADMIN_CONTROLER);
        }else{
            header("Location:../");
            die("<center><b>ERROR</b>::Accès non autorisé</center>");
        }
    }else{
        header("Location:../");
        die("<center><b>ERROR</b>::Accès non autorisé</center>");
    }
?>
<style media="screen">

.tab {
    float: left;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
    width: 20%;
    min-height: 880px;
}

.tab button {
    display: block;
    background-color: inherit;
    color: black;
    padding: 10px 16px;
    width: 100%;
    border: none;
    outline: none;
    text-align: left;
    cursor: pointer;
    transition: 0.3s;
}


.tab button:hover {
    background-color: #ddd;
}

.tab button.active {
    background-color: #ccc;
}

.tabcontent {
    float: left;
    padding: 0px 12px;
    border: 1px solid #ccc;
    width: 80%;
    border-left: none;
    min-height: 780px;
}
</style>
<?php

 if($_listeInvariant){
?>
<div class="modal fade" id="choixSuggestionProj" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h6 class="modal-title" id="">Importation invariants</h6>
      </div>
      <div class="modal-body">
          <form method="post"><?php
            $thisParentPanelId ="cordelisteInvProj";
            openPanel($thisParentPanelId);
              foreach ($_listeInvariant as $key => $_invariantField) {
                  $thisTitle = $_invariantField["invariant_nom"];
                  $thisContent="";
                  $thisPanelId = $thisParentPanelId.$key;
                  $canImport = false;
                  if($thisInvariantsProjet = Invariant::getProjectWithInvariant($thisTitle,$PROJET->getId())){
                      foreach ($thisInvariantsProjet as $thisInvKey => $thisInvariantsProjetFields) {
                          $label = $thisInvariantsProjetFields["projet_nom"];
                          $thisId = $thisPanelId.$thisInvKey;
                          $thisInvId = $thisInvariantsProjetFields["invariant_id"];
                          $contenu = $thisInvariantsProjetFields["invariant_contenu"];
                          if(!empty($contenu)){
                              $thisContent .= <<<CONTENT
                              <input value="$thisInvId" type="radio" name="invariant_$key" id="inv_$thisId" />
                              <label style="cursor:pointer" for="inv_$thisId" >$label</label><br />
CONTENT;
                                $canImport=true;
                          }
                      }
                      $thisContent.=<<<CONTENT
                            <input checked type="radio" name="invariant_$key" id="inv_0_$key" />
                            <label style="cursor:pointer" for="inv_0_$key" >Aucun</label><br />
CONTENT;
                        if($canImport){

                            insertPanel($thisParentPanelId,$thisPanelId,$thisTitle,$thisContent);
                        }
                  }
              }
              closePanel();
              ?>
      </div>
          <div class="modal-footer">
              <input type="submit" name="importInvariantForm" class="btn btn-success" value="Importer">
          </div>
        </form>
    </div>
  </div>
</div>
<?php
}
 if($_formations){
 ?>
<div class="modal fade" id="choixSuggestionForm" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h6 class="modal-title" id="">Importation invariants</h6>
      </div>
      <div class="modal-body">
          <?php var_dump($_formations); ?>
          <button type="button" name="button"></button>
      </div>
      <div class="modal-footer">
        <button type="button" name="button"><i class="fa fa-download"></i> Importer </button>
      </div>
    </div>
  </div>
</div>
<?php
}
 ?>
<div style="background-color:white;padding:30px;min-height:980px" class="">
    <?php
    $hasError = false;

    if(isset($errors)){
        alertErrors($errors);
        $hasError=true;
    }
    if(isset($success)){
        alertSucces($success);
    }

     ?>
    <div class="tab">
        <?php
        $currentInvariantId=0;
        if($contenu = Invariant::getInvariant($PROJET->getId())){
            for($i=0; $i<count($contenu); $i++) {
                $currentInvariantId = $contenu[$i]['invariant_id'];
                $currentInvariantNom = $contenu[$i]['invariant_nom'];
                ?>
                <button class="tablinksInvariant <?php if($i==0) echo ("active"); ?>" onclick="openInvariant(event, 'invariant<?php echo $currentInvariantId; ?>')"><?php echo $currentInvariantNom; ?></button>
                <?php
            }
        }
         ?>
         <button style="text-align:center" class="tablinksInvariant <?php if($currentInvariantId==0) echo ("active"); ?> " onclick="openInvariant(event, 'invariant<?php echo $currentInvariantId+1; ?>')">Invariants liés aux formations</button>
         <br />
         <?php
         if($_listeInvariant){
             ?>
             <button style="text-align:center;background-color:#d6d6f5;" data-toggle="modal" data-target="#choixSuggestionProj" type="button" name="import"><i class="fa fa-download"></i>Importer Inv. projet</button><br />
             <?php
         }
         if($_formations){
             ?>
             <button style="text-align:center;background-color:#d6d6f5;" data-toggle="modal" data-target="#choixSuggestionForm" type="button" name="import"><i class="fa fa-download"></i>Importer Inv. formation</button>
             <?php
         }
          ?>
    </div>
    <?php

        getFormInvariants();

    ?>
</div>

<script type="text/javascript">
    function openInvariant(evt, invarianId) {
        var i, tabcontent, tablinksInvariant;

        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        tablinksInvariant = document.getElementsByClassName("tablinksInvariant");
        for (i = 0; i < tablinksInvariant.length; i++) {
            tablinksInvariant[i].className = tablinksInvariant[i].className.replace(" active", "");
        }

        document.getElementById(invarianId).style.display = "block";
        evt.currentTarget.className += " active";
    }
</script>
