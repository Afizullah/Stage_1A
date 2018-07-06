
<style media="screen">

.tab {
    float: left;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
    width: 20%;
    min-height: 880px;
}

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


.tab button:hover {
    background-color: #ddd;
}

.tab button.active {
    background-color: #ccc;
}

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
    <div class="tab">
        <?php
        $currentInvariantId=0;
        if($contenu = Invariant::getInvariant($PROJET->getId())){
            for($i=0; $i<count($contenu); $i++) {
                $currentInvariantId = $contenu[$i]['invariant_id'];
                $currentInvariantNom = $contenu[$i]['invariant_nom'];
                ?>
                <button class="tablinksInvariant <?php if($i==0) echo ("active"); ?>" onclick="openInvariant(event, 'invariant<?php echo $currentInvariantId; ?>')"><?php echo $currentInvariantNom; ?></button>
                <?php
            }
        }
         ?>
         <button class="tablinksInvariant " onclick="openInvariant(event, 'invariant<?php echo $currentInvariantId+1; ?>')">Invariants liés aux formations</button>
    </div>
    <?php
    if($contenu){
        getFormInvariants();
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

        tablinksInvariant = document.getElementsByClassName("tablinksInvariant");
        for (i = 0; i < tablinksInvariant.length; i++) {
            tablinksInvariant[i].className = tablinksInvariant[i].className.replace(" active", "");
        }

        document.getElementById(invarianId).style.display = "block";
        evt.currentTarget.className += " active";
    }
</script>
