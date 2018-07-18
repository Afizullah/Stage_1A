<style media="screen">
fieldset {
    display: block;
    margin-left: 2px;
    margin-right: 2px;
    padding-top: 0.35em;
    padding-bottom: 0.625em;
    padding-left: 0.75em;
    padding-right: 0.75em;
    border: 1px solid grey;
}
</style>
<div style="max-width:600px;margin:auto;padding:30px;background-color:white;" class="">

    <center>
        <h5>Créer un nouveau projet</h5>
    </center>
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
    <fieldset >
        <?php
            if($hasError && isset($_POST["projet_nom"])){
                getFromCreateProjet($_POST["projet_nom"]);
            }else{
                getFromCreateProjet();
            }
        ?>
    </fieldset>
</div>
