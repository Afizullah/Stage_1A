<script>
function reset(n){
	document.getElementById(-0.5).style.display = "none";
	document.getElementById(-1).style.display = "block";
	for(var i=0;i<n;i++){
		for(var t=0;t<10;t++){
			if (document.getElementById(i*10+t) != null){
				document.getElementById(i*10+t+0.5).style.display = "none";
				document.getElementById(i*10+t).style.display = "block";
			}
		}
	}
}

function myfunction(i,t,n){
	reset(n);
	document.getElementById(i*10+t+0.5).style.display = "block";
	document.getElementById(i*10+t).style.display = "none";
}

function testfile(val,n){
        //document.getElementById("contentExcelFileAnalyse").innerHTML='<center><div class="loader"></div></center>';
        reset(n);
        var fd = new FormData(document.getElementById(val));
           fd.append("label", val);
           $.ajax({
             url: "index.php?page=assync_suggestion",
             type: "POST",
             data: fd,
             //mimeTypes:"multipart/form-data",
             processData: false,  // tell jQuery not to process the data
             contentType: false   // tell jQuery not to set contentType
           }).done(function( data ) {
               document.getElementById(-2).innerHTML=data;
           });
           window.scrollTo(0,0);
           return false;
}
function developper_reduire(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}
function cache_plus(val){
	document.getElementById("plus"+val).style.display="none";
	document.getElementById("moins"+val).style.display="block";
}
function cache_moins(val){
	document.getElementById("plus"+val).style.display="block";
	document.getElementById("moins"+val).style.display="none";
}

</script>

<?php 
function genere_case_text($i,$cible,$tab,$t,$n,$col=4,$rows=15){
?>
	<td>
		<div id=<?php echo $i*10+$t;?> style="display:block;" onclick="myfunction(<?php echo $i?>,<?php echo $t ?>,<?php echo $n?>)" ><?php echo $tab[$i][$cible]; ?></div>
		<form id=<?php echo $i*10+$t+0.5;?> style="display:none;">
			<textarea rows=<?php echo $col ?> cols=<?php echo $rows?> name=<?php echo $cible?>><?php echo $tab[$i][$cible]; ?></textarea>
			<p>
				<input type="reset" onclick="testfile(<?php echo $i*10+$t+0.5;?>,<?php echo $n?>)" value="suggérer" name=<?php echo $i*10+$t;?>/>
				<div onclick="reset(<?php echo $n?>)"><input type="reset" value="annuler"></div>
				<input  name="cible_id" type="text" value=<?php echo $tab[$i]['ec_id'];?> style="display:none">
				<input name="projet_id" type="text" value=<?php echo $projet_id; ?> style="display:none">
			</p>
		</form>		
	</td>
<?php
}

function genere_case_nbre($i,$cible,$tab,$t,$n){
?>
	<td>
		<div id=<?php echo $i*10+$t;?> style="display:block;" onclick="myfunction(<?php echo $i?>,<?php echo $t ?>,<?php echo $n?>)" ><?php echo ($tab[$i][$cible]); ?></div>
		<form id=<?php echo $i*10+$t+0.5;?> style="display:none;">
			<input class="form-control" type="number" min="0" max="10000" name=<?php echo $cible ?> value=<?php echo intval($tab[$i][$cible]); ?> />
			<p>
				<input type="reset" onclick="testfile(<?php echo $i*10+$t+0.5;?>,<?php echo $n?>)" value="suggérer" name=<?php echo $i*10+$t;?> />
				<div onclick="reset(<?php echo $n?>)"><input type="reset" value="annuler"></div>
				<input  name="cible_id" type="text" value=<?php echo $tab[$i]['ec_id'];?> style="display:none">
				<input name="projet_id" type="text" value=<?php echo $projet_id; ?> style="display:none">
			</p>
		</form>		
	</td>
<?php	
}


function genere_entete($ue,$tab,$i){
	?>
	<button class="w3-button w3-block w3-left-align">
		<table style="width:50%">
			<tr>
				<td id =<?php echo "plus".$ue ?> style="width:5%; text-align:center; display:block" onclick="developper_reduire('<?php echo "contenu".$ue ?>');cache_plus('<?php echo $ue?>')"><i class="zmdi zmdi-plus"></i></td>
				<td id =<?php echo "moins".$ue ?> style="width:5%; text-align:center; display:none;" onclick="developper_reduire('<?php echo "contenu".$ue?>');cache_moins('<?php echo $ue?>')"><i class="zmdi zmdi-minus"></i></td>
				<td style="width:95%; text-align: left;">
					<div id=<?php echo $i*10;?> style="display:block;" onclick="myfunction(<?php echo $i?>,0,<?php echo count($tab)?>)" ><?php echo $tab[$i]['ue_nom']; ?></div>
					<form id=<?php echo $i*10+0.5;?> style="display:none;">
						<textarea rows=1 cols=30 name='ue_nom'><?php echo $tab[$i]['ue_nom']; ?></textarea>
						<table>
							<tr>
								<td><input type="reset" onclick="testfile(<?php echo $i*10+0.5;?>,<?php echo count($tab)?>)" value="suggérer" name=<?php echo $i*10;?>/></td>
								<td onclick="reset(<?php echo count($tab)?>)"><input type="reset" onclick="reset(<?php echo count($tab)?>)" value="annuler"></td>
							</tr>
						</table>
						<input  name="cible_id" type="text" value=<?php echo $tab[$i]['ue_id'];?> style="display:none">
						<input name="projet_id" type="text" value=<?php echo $projet_id; ?> style="display:none">
					</form>		
				</td>
			</tr>
		</table>
	</button>
	<div id=<?php echo "contenu".$ue?> class="w3-container w3-hide">
        <div class="panel-wrapper collapse in">
            <div class="panel-body">
                <div class="table-wrap mt-40">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                              	<tr>
                                	<th style="width:15%">Nom de l'EC</th>
                                	<th style="width:25%">Compétences</th>
                                	<th style="width:15%">Prérequis</th>
                                	<th style="width:25%">Contenu</th>
                                	<th style="width:4%">Coef</th>
                                	<th style="width:4%">HCM</th>
                                	<th style="width:4%">HTD</th>
                                	<th style="width:4%">HTP</th>
                                	<th style="width:4%">HTPE</th>
                              	</tr>
                            </thead>
                            <tbody>
                        	
<?php 
}

function genere_ec($tab,$i){?>
<tr>
	<?php
	$n=count($tab); 
	genere_case_text($i,'ec_nom',$tab,1,$n); 
	genere_case_text($i,'ec_competence',$tab,2,$n,10,20);
	genere_case_text($i,'ec_prerequis',$tab,3,$n);
	genere_case_text($i,'ec_contenu',$tab,4,$n,10,20);
	genere_case_nbre($i,'ec_coef',$tab,5,$n);
	genere_case_nbre($i,'ec_nbre_heure_cm',$tab,6,$n);
	genere_case_nbre($i,'ec_nbre_heure_td',$tab,7,$n);
	genere_case_nbre($i,'ec_nbre_heure_tp',$tab,8,$n);
	genere_case_nbre($i,'ec_nbre_heure_tpe',$tab,9,$n);
	?>	
</tr>
<?php
}




function genere_fin(){
?>
                            	</tbody>
                        	</table>
                    	</div>
                	</div>
            	</div>
        	</div>
    	</div>
<?php
}


function genere_ue($i,$tab){
	genere_entete($tab[$i]['ue_id'],$tab,$i);
	$ue=$tab[$i]['ue_id'];
	while($tab[$i]['ue_id']==$ue){
		genere_ec($tab,$i);
		$i++;
		if ($i==count($tab)){
			genere_fin();
			return -1;
		}
	}
	genere_fin();
	return $i;
}

function genere_entete_sem($semestre){
?>
	<button class="w3-button w3-block w3-left-align">
		<table>
			<tr>
				<td id =<?php echo "plus_sem".$semestre ?> style="width:20%; text-align:center; display:block" onclick="developper_reduire('<?php echo "contenu_sem".$semestre ?>');cache_plus('<?php echo "_sem".$semestre?>')"><i class="zmdi zmdi-plus"></i></td>
				<td id =<?php echo "moins_sem".$semestre ?> style="width:20%; text-align:center; display:none;" onclick="developper_reduire('<?php echo "contenu_sem".$semestre?>');cache_moins('<?php echo "_sem".$semestre?>')"><i class="zmdi zmdi-minus"></i></td>
				<td style="width:80%; text-align: center;"><?php echo "Semestre ".$semestre?></td>
			</tr>
		</table>
	</button>
	<div id=<?php echo "contenu_sem".$semestre?> class="w3-container w3-hide">
<?php 
}

function genere_fin_sem(){
?>
</div>
<?php
}

function genere_sem($i,$tab){
	$semestre=$tab[$i]['ue_semestr'];
	genere_entete_sem($semestre);
    while($semestre==$tab[$i]['ue_semestr']){
    	$i=genere_ue($i,$tab);
    	if ($i==-1){
    		return -1;
    	}
    }
    genere_fin_sem();
    return $i;
}

function genere_form($i,$tab){
	$formation=$tab[$i]['formation_id'];
	genere_entete_form($tab[$i]['formation_id'],$tab[$i]['formation_nom']);
    while($formation==$tab[$i]['formation_id']){
    	$i=genere_sem($i,$tab);
    	if ($i==-1){
    		return -1;
    	}
    }
    genere_fin_form();
    return $i;
}

function genere_entete_form($formation_id,$formation_nom){
?>
	<button class="w3-button w3-block w3-left-align">
		<table>
			<tr>
				<td id =<?php echo "plus_form".$formation_id ?> style="width:20%; text-align:center; display:block" onclick="developper_reduire('<?php echo "contenu_form".$formation_id ?>');cache_plus('<?php echo "_form".$formation_id?>')"><i class="zmdi zmdi-plus"></i></td>
				<td id =<?php echo "moins_form".$formation_id ?> style="width:20%; text-align:center; display:none;" onclick="developper_reduire('<?php echo "contenu_form".$formation_id?>');cache_moins('<?php echo "_form".$formation_id?>')"><i class="zmdi zmdi-minus"></i></td>
				<td style="width:80%; text-align: center;"><?php echo $formation_nom ?></td>
			</tr>
		</table>
	</button>
	<div id=<?php echo "contenu_form".$formation_id?> class="w3-container w3-hide">
<?php 
}

function genere_fin_form(){
?>
</div>
<?php
}



$n=count($tab);
if($n==0){
    echo "aucune suggestion possible";
}
else{?>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div class="col-sm-12">
    <div class="panel panel-default card-view">
        <div class="panel-heading">
            <div class="pull-left">
                <h6 class="panel-title txt-dark">F<div style="text-transform:lowercase;display:inline">ormations sur lesquelles vous pouvez faire des suggestions</div></h6>
            </div>
            <div class="clearfix"></div>
        </div>
        <p><div id=-2></div></p>
        <div id=-1 style="display:block;" class="btn btn-success  btn-sm" onclick="myfunction(0,-1,<?php echo $n?>)" >Faire une suggestion générale</div>
		<form id=-0.5 style="display:none;">
			<textarea rows=4 cols=40 name=general></textarea>
			<p>
				<input type="reset" onclick="testfile(-0.5,<?php echo $n?>)" value="suggérer" name=-1/>
				<div onclick="reset(<?php echo $n?>)"><input type="reset" value="annuler"></div>
				<input  name="cible_id" type="text" value=0 style="display:none">
				<input name="projet_id" type="text" value=<?php echo $id_projet; ?> style="display:none">
			</p>
		</form>
		<br/>
        <?php
        $i=0;
        while($i!=-1){
        	$i=genere_form($i,$tab);	
        }
        ?>
	</div>
</div>
<?php } ?>


<?php /* genere_case_text($i,'ec_nom',$tab,1,$n,$col=4,$rows=15) ?>
<button class="w3-button w3-block w3-left-align">
			<table>
				<tr>
					<td id ="plus" style="width:20%; text-align:center; display:block" onclick="developper_reduire('test');cache_plus()"><i class="zmdi zmdi-plus"></i></td>
					<td id ="moins" style="width:20%; text-align:center; display:none" onclick="developper_reduire('test');cache_moins()"><i class="zmdi zmdi-minus"></i></td>
					<td style="width:80%; text-align: center;">nom de l'UE</td>
				</tr>
			</table>
		</button>
		<div id="test" class="w3-container w3-hide">
        <p><div id=0></div></p>
        <div class="panel-wrapper collapse in">
            <div class="panel-body">
                <div class="table-wrap mt-40">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                              	<tr>
                                	<th style="width:15%">Nom de l'EC</th>
                                	<th style="width:25%">Compétences</th>
                                	<th style="width:15%">Prérequis</th>
                                	<th style="width:25%">Contenu</th>
                                	<th style="width:4%">Coef</th>
                                	<th style="width:4%">HCM</th>
                                	<th style="width:4%">HTD</th>
                                	<th style="width:4%">HTP</th>
                                	<th style="width:4%">HTPE</th>
                              	</tr>
                            </thead>
                            <tbody>
    <?php
	for ($i=0;$i<count($tab);$i++){?>
<tr>
	<?php 
	genere_case_text($i,'ec_nom',$tab,1,$n); 
	genere_case_text($i,'ec_competence',$tab,2,$n,10,20);
	genere_case_text($i,'ec_prerequis',$tab,3,$n);
	genere_case_text($i,'ec_contenu',$tab,4,$n,10,20);
	genere_case_nbre($i,'ec_coef',$tab,5,$n);
	genere_case_nbre($i,'ec_nbre_heure_cm',$tab,6,$n);
	genere_case_nbre($i,'ec_nbre_heure_td',$tab,7,$n);
	genere_case_nbre($i,'ec_nbre_heure_tp',$tab,8,$n);
	genere_case_nbre($i,'ec_nbre_heure_tpe',$tab,9,$n);
?>	
</tr>
    	<?php
    }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

function genere_entete($ue){
	?>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<button class="w3-button w3-block w3-left-align">
		<table>
			<tr>
				<td id =<?php echo "plus".$ue ?> style="width:20%; text-align:center; display:block" onclick="developper_reduire(<?php echo "contenu".$ue ?>);cache_plus(<?php echo $ue?>)"><i class="zmdi zmdi-plus"></i></td>
				<td id =<?php echo "moins".$ue ?> style="width:20%; text-align:center; display:none;" onclick="developper_reduire(<?php echo "contenu".$ue?>);cache_moins(<?php echo $ue?>)"><i class="zmdi zmdi-minus"></i></td>
				<td style="width:80%; text-align: center;">nom de l'UE</td>
			</tr>
		</table>
	</button>
	<div id=<?php echo "contenu".$ue?> class="w3-container w3-hide">
        <p><div id=0></div></p>
        <div class="panel-wrapper collapse in">
            <div class="panel-body">
                <div class="table-wrap mt-40">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                              	<tr>
                                	<th style="width:15%">Nom de l'EC</th>
                                	<th style="width:25%">Compétences</th>
                                	<th style="width:15%">Prérequis</th>
                                	<th style="width:25%">Contenu</th>
                                	<th style="width:4%">Coef</th>
                                	<th style="width:4%">HCM</th>
                                	<th style="width:4%">HTD</th>
                                	<th style="width:4%">HTP</th>
                                	<th style="width:4%">HTPE</th>
                              	</tr>
                            </thead>
                            <tbody>
                        	</tbody>
                    	</table>
                	</div>
            	</div>
        	</div>
    	</div>
	</div>
<?php 
}

*/ ?>