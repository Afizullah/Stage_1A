
<br />
<form style="width:500px;margin:auto;background-color:white;padding:30px;" action="" method="POST">
    <div class="input-group">
      <span class="input-group-addon">Nom : </span>
      <input type="text" class="form-control" placeholder="">

    </div>
    <label for="nom">Nom : </label>
    <input type="text" id="nom" name="nom"> </br></br>
    <label for="prenom">Prénom : </label>
    <input type="text" id="prenom" name="prenom" > </br></br>
    <label for="mail">Email : </label>
    <input type="text" id="mail" name="mail"> </br></br>
    <label for="password">Mot de passe : </label>
    <input type="password" id="password" name="password"> </br></br>
    <label for="passwordConf">Mot de passe de confirmation : </label>
    <input type="password" id="passwordConf" name="passwordConf"> </br></br>
    <label for="">Séléctionner le type de compte : </label>
    <select>
        <option value="administrateur">Administrateur</option>
        <option value="responsable_pedagogique">Responsable Pédagogique</option>
        <option value="enseignant">Enseignant</option>
    </select>
</form>
