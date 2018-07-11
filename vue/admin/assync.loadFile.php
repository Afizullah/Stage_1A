<?php
if (isset($_FILES["excelFileSource"])) {
    if(!empty($_FILES["excelFileSource"])){
        if($fileToLoad = moveExcelInFolder("excelFileSource",PATH_TEMPLATE."dist/xls/")){
            $LoadedFile = new LoadFile($fileToLoad);
            if($formationsNames = $LoadedFile->getFormationsNames()){
                $options = "<center>Veuillez selection la liste des formations</center><br />";
                for ($i=0; $i < count($formationsNames); $i++) {
                    $options.='<input type="checkbox" name="formationsSelected[]" id="f'.$formationsNames[$i].'" value="'.$formationsNames[$i].'" /><label style="cursor:pointer" for="f'.$formationsNames[$i].'">'.$formationsNames[$i].'</label><br />';
                }
                echo $options;
            }else{
                echo "<center style='color:red'>Aucune formation detecté dans ce fichier<small>Test</small></center>";
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
