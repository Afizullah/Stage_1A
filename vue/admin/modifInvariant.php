<div class="container mt-3">

    <?php $contenu = Invariant::getInvariant();  ?>

    <h2>Liste des invariants</h2>
    
    
    <ul class="nav nav-tabs">
    <?php for($i=0; $i<count($contenu); $i++) {?>
    <li class="nav-item">
        <a class="nav-link <?php if($i==0) echo ("active"); ?>" href="#invariant<?php echo ($contenu[$i]['invariant_id']); ?>"><?php print_r($contenu[$i]['invariant_nom']); ?></a>
    </li>
    <?php } ?>
    </ul>

</div> </br> </br>

<div class="row">
    <form action="" method="POST">
        <?php for($i=0; $i<count($contenu); $i++) { ?>
            <div id="invariant<?php echo ($contenu[$i]['invariant_id']); ?>" class="container tab-pane <?php if($i==0) echo ("active"); ?>">
            <input type="hidden" name="invariantId[]" value="<?php echo ($contenu[$i]['invariant_id']); ?>">
                    <textarea class="form-control" rows="15" id="editor<?php echo ($contenu[$i]['invariant_id']); ?>" name="invariantContent[]" placeholder="Enter text ...">
                        <?php print_r($contenu[$i]['invariant_contenu']); ?>
                    </textarea>
                                
                    <script>
                        CKEDITOR.replace('editor<?php echo ($contenu[$i]['invariant_id']) ?>');
                    </script>
            </div>
        <?php } ?>

        <center>
                <input type="submit" class="btn btn-success" class="form-control" name="modifInvariant" value="Enregistrer les modifications">
        </center>
    </form>
</div>
<script>
$(document).ready(function(){
    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });
    $('.nav-tabs a').on('shown.bs.tab', function(event){
        var x = $(event.target).text();         // active tab
        var y = $(event.relatedTarget).text();  // previous tab
        $(".act span").text(x);
        $(".prev span").text(y);
    });
});
</script>
