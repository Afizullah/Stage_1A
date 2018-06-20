<div class="modal fade" id="createProjet" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="">Créer un nouveau projet</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
          <?php
          getFromCreateProjet();
           ?>
      </div>
    </div>
  </div>
</div>
<?php
    if(!$projet = Projet::getCurrentProjet()){
        ?>
        <center>
            <a href="#createProjet" data-toggle="modal" >
                <button class="btn btn-primary" type="button" name="button">CREER UN NOUVEAU PROJET</button>
            </a>
        </center>
        <?php
    }

 ?>
