<?php
function getFormAddUsser($action="",$type_compte="",$date_expiration="",$email="",$prenom="",$nom=""){

        if($date_expiration){
            $_SESSION["dext"]=$date_expiration;
        }
    ?>
    <form style="width:500px;margin:auto;background-color:white;padding:30px;" action="<?php echo $action; ?>" method="POST">
        <div class="input-group">
            <span class="input-group-addon">Type de compte : </span>
            <select class="form-control" name="accountType">
                <option value="">----Séléctionner----</option>
                <option <?php echo ($type_compte=="administrateur")?"selected":""; ?> value="administrateur">Administrateur</option>
                <option <?php echo ($type_compte=="responsable_pedagogique")?"selected":""; ?>  value="responsable_pedagogique">Responsable Pédagogique</option>
                <option <?php echo ($type_compte=="enseignant")?"selected":""; ?>  value="enseignant">Enseignant</option>
            </select>
        </div><br />
        <div class="input-group">
            <span class="input-group-addon">Date d'expiration : </span>
            <input type="date" class="form-control" value="<?php if(isset($_SESSION["dext"])){echo $_SESSION["dext"]; } ?>" name="date_expiration" placeholder="">
        </div><br />
        <div class="input-group">
            <span class="input-group-addon">Email : </span>
            <input type="text" value="<?php echo $email; ?>" class="form-control" name="mail" placeholder="">
        </div><br />
        <div class="input-group">
            <span class="input-group-addon">Prénom : </span>
            <input type="text" value="<?php echo $prenom; ?>" class="form-control" name="prenom" placeholder="">
        </div><br />
        <div class="input-group">
              <span class="input-group-addon">Nom : </span>
              <input type="text" value="<?php echo $nom; ?>"class="form-control" name="nom" placeholder="">
        </div><br />
        <center>
              <input type="submit" class="btn btn-success" class="form-control" name="addUser" value="Créer un compte">
        </center>
    </form>
    <?php
}
 ?>
