<style>
    .loader {
      border: 7px solid #f3f3f3;
      border-radius: 50%;
      border-top: 7px solid #3498db;
      width: 50px;
      height: 50px;
      -webkit-animation: spin 2s linear infinite; /* Safari */
      animation: spin 2s linear infinite;
    }

    /* Safari */
    @-webkit-keyframes spin {
      0% { -webkit-transform: rotate(0deg); }
      100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
</style>

<?php
if(isset($from)){

}else{
    ?>
    <div style="background-color:white;padding:30px;min-height:400px;" class="col-lg">
        <center>
            <h3 style="color:blue">Veuillez choisir la source des données</h3>
        </center>
        <div style="width:700px;margin:auto;border:1px solid grey;padding:20px;min-height:300px;">
                <input type="hidden" id="importMethod" name="importMethod" value="excel">
                <?php
                if($othersProjets = $PROJET->getAllOtherProjets($PROJET->getId())){
                    ?>
                        <select style="cursor:pointer" class="form-control" onchange="changeImportMethod(this.value)" name="">
                                <option value="excelFile">Fichier excel</option>
                                <?php
                                    for ($i=0; $i < count($othersProjets) ; $i++) { ?>
                                        <option value="<?php echo $othersProjets[$i]['projet_id']; ?>">
                                            <?php echo $othersProjets[$i]['projet_nom']; ?>
                                        </option>
                                        <?php
                                    }
                                ?>

                        </select>
                        <?php
                    }

                ?>
                <br>
                <form id="formContentExcelFile" class="" >
                    <div id="contentExcelFile" style="" class="">
                        <input type="file" accept=".xlsx,.xls" onchange="testFile(this.value)" class="form-control" name="excelFileSource" value="">
                        <div id="contentExcelFileAnalyse">
                        </div>
                    </div>
                </form>

                <div id="contentDbFile" style="display:none" class="">
                    <div class="panel-group">
                        <div class="panel panel-default">
                              <div class="panel-heading">
                                <h4 class="panel-title">
                                  <a style="display:block" data-toggle="collapse" href="#collapseInvariants">
                                    Invariants
                                  </a>
                                </h4>
                              </div>
                              <div id="collapseInvariants" class="panel-collapse collapse">
                                  Liste des invariants
                              </div>
                        </div>
                    </div>
                    <div class="panel-group">
                        <div class="panel panel-default">
                              <div class="panel-heading">
                                <h4 class="panel-title">
                                  <a style="display:block" data-toggle="collapse" href="#collapseFormations">
                                    Formations
                                  </a>
                                </h4>
                              </div>
                              <div id="collapseFormations" class="panel-collapse collapse">
                                  Liste des formations
                              </div>
                        </div>
                    </div>

                </div>

        </div>
    </div>

    <?php
}
?>
<script type="text/javascript">
    function testFile(val){
        document.getElementById("contentExcelFileAnalyse").innerHTML='<center><div class="loader"></div></center>';
        var fd = new FormData(document.getElementById("formContentExcelFile"));
           fd.append("label", "WEBUPLOAD");
           $.ajax({
             url: "index.php?page=assync.loadFile",
             type: "POST",
             data: fd,
             mimeTypes:"multipart/form-data",
             processData: false,  // tell jQuery not to process the data
             contentType: false   // tell jQuery not to set contentType
           }).done(function( data ) {
               document.getElementById("contentExcelFileAnalyse").innerHTML=data;
           });
           return false;
    }
    function hiddElement(elementId){
        document.getElementById(elementId).style="display:none";
    }
    function showElement(elementId){
        document.getElementById(elementId).style="display:block";
    }
    function changeImportMethod(val){
        var importMethodInput = document.getElementById("importMethod");
        if(val=="excelFile"){
            importMethodInput.name="excelFile";
            showElement("contentExcelFile");
            hiddElement("contentDbFile");
        }else{
            importMethodInput.name="dbFile";
            showElement("contentDbFile");
            hiddElement("contentExcelFile");
        }
    }
</script>
