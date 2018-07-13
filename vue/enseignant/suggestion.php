<script>
function reset(n){
	for(var i=0;i<n;i++){
		for(var t=1;t<10;t++){
			document.getElementById(i*10+t+0.5).style.display = "none";
			document.getElementById(i*10+t).style.display = "block";
		}
	}
}
function myfunction(i,t,n){
	reset(n);
	document.getElementById(i*10+t+0.5).style.display = "block";
	document.getElementById(i*10+t).style.display = "none";
}

function testFile(val,n){
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
               document.getElementById(0).innerHTML=data;
           });
           window.scrollTo(0,0);
           return false;
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
				<input type="reset" onclick="testFile(<?php echo $i*10+$t+0.5;?>,<?php echo $n?>)" value="suggérer" name=<?php echo $i*10+$t;?>/>
				<div onclick="reset(<?php echo $n?>)"><input type="reset" value="annuler"></div>
				<input  name="cible_id" type="text" value=<?php echo $tab[$i]['ec_id'];?> style="display:none">
			</p>
		</form>		
	</td>
<?php
}

function genere_case_nbre($i,$cible,$tab,$t,$n){
?>
	<td>
		<div id=<?php echo $i*10+$t;?> style="display:block;" onclick="myfunction(<?php echo $i?>,<?php echo $t ?>,<?php echo $n?>)" ><?php echo $tab[$i][$cible]; ?></div>
		<form id=<?php echo $i*10+$t+0.5;?> style="display:none;">
			<input class="form-control" type="number" min="0" max="10000" name=<?php echo $cible ?> value=<?php echo $tab[$i][$cible]; ?>/>
			<p>
				<input type="reset" onclick="testFile(<?php echo $i*10+$t+0.5;?>,<?php echo $n?>)" value="suggérer" name=<?php echo $i*10+$t;?>/>
				<div onclick="reset(<?php echo $n?>)"><input type="reset" value="annuler"></div>
				<input  name="cible_id" type="text" value=<?php echo $tab[$i]['ec_id'];?> style="display:none">
			</p>
		</form>		
	</td>
<?php	
}


$n=count($tab);
if($n==0){
    echo "aucune suggestion possible";
}
else{?>
<div class="col-sm-12">
    <div class="panel panel-default card-view">
        <div class="panel-heading">
            <div class="pull-left">
                <h6 class="panel-title txt-dark">Vos Groupes</h6>
            </div>
            <div class="clearfix"></div>
        </div>
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
<?php } 
/*
<?php genere_case_text($i,'ec_nom',$tab,1,$n,$col=4,$rows=15) ?>*/ ?>