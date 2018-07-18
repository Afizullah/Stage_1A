<style>
    .loader {
      border: 7px solid #f3f3f3;
      border-radius: 50%;
      border-top: 7px solid #3498db;
      width: 50px;
      height: 50px;
      -webkit-animation: spin 2s linear infinite; 
      animation: spin 2s linear infinite;
    }

    @-webkit-keyframes spin {
      0% { -webkit-transform: rotate(0deg); }
      100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
</style>
<script type="text/javascript">

        function setAllExcelFormation(element){
            tabListChedFile = document.getElementsByClassName("checkedExcelFormations");
            console.log(tabListChedFile);
            if(element.checked){
                for (var i = 0; i < tabListChedFile.length; i++) {
                    tabListChedFile[i].checked=true;
                }
            }else{
                for (var i = 0; i < tabListChedFile.length; i++) {
                    tabListChedFile[i].checked=false;
                }
            }
        }
        function setAllDbFormation(element){
            tabListChedFile = document.getElementsByClassName("checkedDbFormations");
            console.log(tabListChedFile);
            if(element.checked){
                for (var i = 0; i < tabListChedFile.length; i++) {
                    tabListChedFile[i].checked=true;
                }
            }else{
                for (var i = 0; i < tabListChedFile.length; i++) {
                    tabListChedFile[i].checked=false;
                }
            }
        }
</script>
<div style="background-color:white;padding:30px;min-height:400px;" class="col-lg">
    <?php
    $hasError = false;
    if(isset($errors)){
        alertErrors($errors);
        $hasError=true;
    }
    if(isset($success)){
        alertSucces($success);
    }
    if(isset($from)){

    }else{ ?>
        <center>
            <h3 style="color:blue">Veuillez choisir la source des données</h3>
        </center>
        <div style="width:700px;margin:auto;border:1px solid grey;padding:20px;min-height:300px;">
            <form id="formContentExcelFile" method="post" class="" >
                <input type="hidden" id="importMethod" name="importMethod" value="excelFile"><?php
                if($othersProjets = $PROJET->getAllOtherProjets($PROJET->getId())){ ?>
                    <select style="cursor:pointer" class="form-control" onchange="changeImportMethod(this.value)" name="">
                        <option value="excelFile">Fichier excel</option><?php
                        for ($i=0; $i < count($othersProjets) ; $i++) {
                            $thisOtherProjectId = $othersProjets[$i]['projet_id'];
                            if(hasFormations($thisOtherProjectId)){ ?>
                                <option value="<?php echo $thisOtherProjectId; ?>">
                                    <?php echo $othersProjets[$i]['projet_nom']; ?>
                                </option> <?php
                            }
                        } ?>
                    </select><?php
                } ?>
                <br>
                <div id="contentExcelFile" style="" class="">
                    <input type="file" accept=".xlsx,.xls" onchange="testFile(this.value)" class="form-control" name="excelFileSource" value="">
                    <div id="contentExcelFileAnalyse"></div>
                </div>

                <div id="contentDbFile" style="display:none" class="">
                    <input type="hidden" id="idProjectToImport" name="idProjectToImport" value="0">
                    <div id="contentLoadedFromDb"></div>
                </div>
                <center>
                    <input type="submit" name="importData" class="btn btn-success" value="IMPORTER">
                </center>
            </form>
        </div> <?php
    } ?>
</div>
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
             processData: false,
             contentType: false
           }).done(function( data ) {
               document.getElementById("contentExcelFileAnalyse").innerHTML=data;
           });
           return false;
    }
    function loadSelectedProject(){
        document.getElementById("contentLoadedFromDb").innerHTML='<center><div class="loader"></div></center>';

        var fd = new FormData(document.getElementById("formContentExcelFile"));
           fd.append("label", "WEBUPLOAD");
           $.ajax({
             url: "index.php?page=assync.loadDb",
             type: "POST",
             data: fd,
             processData: false,
             contentType: false
           }).done(function( data ) {
               document.getElementById("contentLoadedFromDb").innerHTML=data;
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
            importMethodInput.value="excelFile";
            showElement("contentExcelFile");
            hiddElement("contentDbFile");
        }else{
            importMethodInput.value="dbFile";
            var idProjectToImport = document.getElementById("idProjectToImport");
            idProjectToImport.value=val;
            showElement("contentDbFile");
            hiddElement("contentExcelFile");
            loadSelectedProject();
        }
    }
</script>
