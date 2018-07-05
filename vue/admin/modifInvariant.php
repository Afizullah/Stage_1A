
<style media="screen">
/* Style the tab */
.tab {
float: left;
border: 1px solid #ccc;
background-color: #f1f1f1;
width: 20%;
min-height: 880px;
}

/* Style the buttons that are used to open the tab content */
.tab button {
display: block;
background-color: inherit;
color: black;
padding: 10px 16px;
width: 100%;
border: none;
outline: none;
text-align: left;
cursor: pointer;
transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
background-color: #ddd;
}

/* Create an active/current "tab button" class */
.tab button.active {
background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
float: left;
padding: 0px 12px;
border: 1px solid #ccc;
width: 80%;
border-left: none;
min-height: 780px;
}
</style>

<div style="background-color:white;padding:30px;min-height:980px" class="">
    <div class="tab">
        <?php
        if($contenu = Invariant::getInvariant($PROJET->getId())){
            for($i=0; $i<count($contenu); $i++) {
                $currentInvariantId = $contenu[$i]['invariant_id'];
                $currentInvariantNom = $contenu[$i]['invariant_nom'];
                ?>
                <button class="tablinksInvariant <?php if($i==0) echo ("active"); ?>" onclick="openInvariant(event, 'invariant<?php echo $currentInvariantId; ?>')"><?php echo $currentInvariantNom; ?></button>
                <?php
            }
        }else{
            echo "<center>Aucun invariant dans ce projet</center>";
        }
         ?>
    </div>
    <?php
    if($contenu){
        ?>
        <form action="" method="POST">
            <?php
                for ($i=0; $i < count($contenu) ; $i++) {
                    $currentInvariantId = $contenu[$i]['invariant_id'];
                    $currentInvariantNom = $contenu[$i]['invariant_nom'];
                    $currentInvariantContenu = $contenu[$i]['invariant_contenu'];
                    ?>
                    <div id="invariant<?php echo $currentInvariantId; ?>" <?php if($i!=0){echo 'style="display:none"';} ?> class="tabcontent">
                        <h5 style="text-align:center"><?php echo $currentInvariantNom ?></h5>
                        <input type="hidden" name="invariantId[]" value="<?php echo $currentInvariantId; ?>">
                        <textarea class="form-control" id="editor<?php echo $currentInvariantId; ?>" name="invariantContent[]" placeholder="Enter text ...">
                            <?php echo $currentInvariantContenu; ?>
                        </textarea>
                        <script>
                            CKEDITOR.replace('editor<?php echo $currentInvariantId; ?>', {
                                height: '750px'
                            });
                        </script>
                    </div>
                    <?php
                }
            ?>
            <center>
                <input type="submit" name="modifInvariant" class="btn btn-success" value="Enregistrer">
            </center>
        </form>
        <?php
    }
    ?>


</div>

<script type="text/javascript">
    function openInvariant(evt, invarianId) {
        var i, tabcontent, tablinksInvariant;

        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        // Get all elements with class="tablinksInvariant" and remove the class "active"
        tablinksInvariant = document.getElementsByClassName("tablinksInvariant");
        for (i = 0; i < tablinksInvariant.length; i++) {
            tablinksInvariant[i].className = tablinksInvariant[i].className.replace(" active", "");
        }

        document.getElementById(invarianId).style.display = "block";
        evt.currentTarget.className += " active";
    }
</script>
