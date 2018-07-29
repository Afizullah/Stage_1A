<?php
//Control sur le droit d'accès à cette & sur l'accès à travers un lien direct
if (defined("SESS_ADMIN_CONTROLER")) {
    if (file_exists(SESS_ADMIN_CONTROLER)) {
        require_once(SESS_ADMIN_CONTROLER);
    } else {
        header("Location:../");
        die("<div style=\"text-align: center;\"><b>ERROR</b>::Accès non autorisé</div>");
    }
} else {
    header("Location:../");
    die("<div style=\"text-align: center;\"><b>ERROR</b>::Accès non autorisé</div>");
}
?>

<h3 style="color: #5e9ca0;"><span style="color: #000000;">Bienvenue sur la plateforme d'accr&eacute;ditation de formation de l'ESP !</span>
</h3>
<p>&nbsp;</p>
<p><span style="color: #000000;">Celle-ci a pour but de faciliter la collaboration entre les responsables p&eacute;dagogiques et les enseignants dans l'&eacute;laboration d'un livret de formation fid&egrave;le au contenu des enseignements.</span>
</p>
<p>&nbsp;</p>
<h3 style="color: #2e6c80;"><span style="color: #000000;">Ce que vous pouvez faire en tant qu'<span
                style=""><span style="color: #ff0000;">administrateur </span>:</span></span>
</h3>
<p>&nbsp;</p>
<p>Dans le menu d&eacute;filant &agrave; gauche, l'onglet :</p>
<p>&nbsp;</p>
<p>
    <span style="background-color: #2b2301; color: #fff; display: inline-block; padding: 3px 10px; font-weight: bold; border-radius: 9px;">G&eacute;rer les comptes</span>
    &nbsp; permet d'ajouter/supprimer/consulter la liste des utilisateurs.</p>
<p>&nbsp;</p>
<p>
    <span style="background-color: #2b2301; color: #fff; display: inline-block; padding: 3px 10px; font-weight: bold; border-radius: 5px;">Projets</span>
    &nbsp; permet d'ajouter/supprimer/consulter la liste des projets.</p>
<p>&nbsp;</p>
<p>
    <span style="background-color: #2b2301; color: #fff; display: inline-block; padding: 3px 10px; font-weight: bold; border-radius: 5px;">Formation</span>
    &nbsp; permet de importer/exporter une formation au format excel dans une nomenclature sp&eacute;cifique et modifier
    les informations relatives au contenu de la formation.</p>
<p>&nbsp;</p>
<p>
    <span style="background-color: #2b2301; color: #fff; display: inline-block; padding: 3px 10px; font-weight: bold; border-radius: 5px;">Groupe</span>&nbsp;
    donne acc&egrave;s au diff&eacute;rentes UE des th&eacute;matiques d'enseignant o&ugrave; vous &ecirc;tes assign&eacute;.
</p>
<p>&nbsp;</p>
<p>
    <span style="background-color: #2b2301; color: #fff; display: inline-block; padding: 3px 10px; font-weight: bold; border-radius: 5px;">Livret</span>&nbsp;
    donne acc&egrave;s aux diff&eacute;rents invariants d'une formation.</p>
<p>&nbsp;</p>
<p>Enfin, une fois les formations et le contenu des invariants arr&ecirc;t&eacute;s&nbsp; <span
            style="background-color: #2b2301; color: #fff; display: inline-block; padding: 3px 10px; font-weight: bold; border-radius: 5px;">G&eacute;n&eacute;rer un Livret<br/></span>&nbsp;
    permet de g&eacute;n&eacute;rer le livret au format PDF.</p>
<p>&nbsp;</p>
<p><strong>&nbsp;</strong></p>

<!--<div class="modal fade" id="createProjet" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 style="float:left" class="modal-title" id="">Créer un nouveau projet</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
          <?php
getFromCreateProjet("", "index.php?page=createProjet");
?>
      </div>
    </div>
  </div>
</div>
<?php
if (!$projet = $PROJET->getId()) {
    ?>
        <div style="text-align: center;">
            <a href="#createProjet" data-toggle="modal" >
                <button class="btn btn-primary" type="button" name="button">CREER UN NOUVEAU PROJET</button>
            </a>
        </div>
        <?php
} else {

    var_dump(count($PROJET->getFormations()));

    var_dump(count($PROJET->getGroupes()));

}
//-->
center("Bienvenue sur la plate-forme d'accréditation de l'ESP")

?>
