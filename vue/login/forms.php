<?php
function getFormLogin(){
    ?>
    <form method="post" action="#">
        <div class="form-group">
            <label class="control-label mb-10" for="exampleInputEmail_2">Adresse email</label>
            <input type="email" class="form-control" name="mail" required="" id="exampleInputEmail_2" placeholder="Mèl">
        </div>
        <div class="form-group">
            <label class="pull-left control-label mb-10" for="exampleInputpwd_2">Mot de passe</label>
            <div class="clearfix"></div>
            <input type="password" class="form-control" name="password" required="" id="exampleInputpwd_2" placeholder="Mot de passe">
        </div>

        <div class="form-group text-center">
            <input type="submit" name="login" class="btn btn-primary  btn-rounded" value="Se connecter" />
        </div>
        <center>

            <a class="capitalize-font txt-primary block mb-10 font-12" href="index.php?page=forgot-password">Mot de passe oublié ?</a>
        </center>
    </form>
    <?php
}
function getFormActiveAccount($token){
    ?>
    <form method="post" action="">
        <input type="hidden" name="token" value="<?php echo $token;  ?>">
        <div class="form-group">
            <label class="control-label mb-10" >Mot de passe</label>
            <input required type="password" class="form-control" name="password" placeholder="********">
        </div>
        <div class="form-group">
            <label class="pull-left control-label mb-10" >Confirmer mot de passe</label>
            <div class="clearfix"></div>
            <input required type="password" class="form-control" name="cnfpassword" placeholder="********">
        </div>

        <div class="form-group text-center">
            <input type="submit" name="activeCompte" class="btn btn-primary  btn-rounded" value="Valider" />
        </div>

    </form>
    <?php
}

?>
