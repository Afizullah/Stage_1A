
<script type="text/javascript">

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
	return false;
}
function cache_moins(val){
	document.getElementById("plus"+val).style.display="block";
	document.getElementById("moins"+val).style.display="none";
	return false;
}

function deleteTOshow(val){
	document.getElementById(val+"annuler").style.display="none";
	document.getElementById(val+"valider").style.display="none";
	var checkboxs=document.getElementsByTagName("input");
	for (var i = 0; i < checkboxs.length; i ++){
		if (checkboxs[i].id==val+"checkbox"){
			checkboxs[i].style.display="none";
		}
	}
	document.getElementById(val+"checkbox").style.display="none";
	document.getElementById(val+"delete").style.display="block";
	return false;
}
function showTOdelete(val){
	document.getElementById(val+"annuler").style.display="block";
	document.getElementById(val+"valider").style.display="block";
	var checkboxs=document.getElementsByTagName("input");
	for (var i = 0; i < checkboxs.length; i ++){
		if (checkboxs[i].id==val+"checkbox"){
			checkboxs[i].style.display="block";
		}
	}
	document.getElementById(val+"delete").style.display="none";
	return false;
}

</script>

<style>
    img:hover {
    border: 3px;
    border-style: solid;    
    border-color: #878787;
}

</style>
<?php
function genere_case($filename,$projet_id){
	global $filelocation_gen;
	$filelocation=$filelocation_gen.$projet_id."/";
	?>
	<td style="width: 20%;">
		<div style="text-align: center;">
			<table style="text-align: center;">
				<tr>
					<td>
						<a href=<?php echo $filelocation.$filename.".pdf"?> onclick="window.open(this.href); return false;" >
							<img src=<?php echo $filelocation.$filename.".png"?> width="160" height="240" alt="livret"/>
						</a>
					</td>
				</tr>
				<tr>
					<td>
						<table>
							<tr>
								<td>
									<input type="checkbox" id=<?php echo $projet_id."checkbox" ?> name=<?php echo $filename.'X'.$projet_id ?> style="display:none" />
								</td>
								<td>
									<?php echo $filename.'.pdf';?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>
	</td>
	<?php
}



function genere_livrets_projet($projet_id){

	if(($livrets=showLivrets::getLivrets($projet_id)) && ($projet_name=showLivrets::getName($projet_id)[0]['projet_nom'])){
		?>
		<button class="w3-button w3-block w3-left-align">
			<table style="width:100%">
				<tr><td style="width:2%"></td>
					<td id =<?php echo "plus".$projet_id ?> style="width:3%; text-align:center; display:block" onclick="developper_reduire('<?php echo "formation".$projet_id ?>');cache_plus('<?php echo $projet_id ?>')"><i class="zmdi zmdi-plus"></i></td>
					<td id =<?php echo "moins".$projet_id;?> style="width:3%; text-align:center; display:none;" onclick="developper_reduire('<?php echo "formation".$projet_id ?>');cache_moins('<?php echo $projet_id ?>')"><i class="zmdi zmdi-minus"></i></td>
					<td style="width:95%; text-align: left;"><?php echo $projet_name ?></td>
				</tr>
			</table>
		</button>
		<form name=<?php echo "form".$projet_id ?> action="#" method="post" >
		<div id=<?php echo "formation".$projet_id ?> class="w3-container w3-hide">
			<table style="width:100%; text-align: center;">
				<tr>
				<?php
				for ($i=0;$i<count($livrets);$i++){
					if ($i%5==0 && $i!=0){
						?></tr><tr><?php
					}
					genere_case($livrets[$i]['livret_nom'],$projet_id);
				}
				for($j=1;$j<=5-$i%5;$j++){
					?><td style="width:20%"></td><?php
				} 
				?>
				</tr>
			</table>
			<center>
				<button type="button" class="btn btn-danger" id=<?php echo $projet_id."delete"?>  onclick="showTOdelete('<?php echo $projet_id?>')" style="display:block">
					Supprimer des livrets
				</button>
				<table style="width:30%">
					<tr>

						<td><center>
					<input class="btn btn-success" type="submit" id=<?php echo $projet_id."valider"?> name=<?php echo $projet_id?> style="display:none">
						</center></td>
						<td><center>
					<button type="reset" class="btn btn-danger" id=<?php echo $projet_id."annuler"?>  onclick="deleteTOshow
	('<?php echo $projet_id?>')" style="display:none">
					Annuler
					</button>
						</center></td>
					</tr>
				</table>
			</center>
			</form>	
		</div>
		<?php
	}else{
		alertWarning(["Aucun livret n'est encore généré"]);
		echo center("Aucun livret n'est encore généré.<br/><a style='color:blue' href='index.php?page=genererLivret'>Générer un livret maintenant?</a><br/><br/><br/><br/>");
	}
}
?>

<!--main-->
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div class="col-sm-12">
    <div class="panel panel-default card-view">
        <div class="panel-heading">
            <div class="clearfix"></div>
        </div>
<?php
echo $html;
$projets=get_projet_id($filelocation_gen);
if(!$projets){
	echo "<p style='text-align:center'> aucun livret n'a été généré </p>";
}
for ($i=0;$i<count($projets);$i++){
	genere_livrets_projet($projets[$i]);
}
?>
	</div>
</div>

<?php 
if (isset($_GET["projet"])){
	$projetId=$_GET["projet"];
	?>
	<script type="text/javascript">
		if (document.getElementById('<?php echo "formation".$projetId ?>')!=null){
			developper_reduire('<?php echo "formation".$projetId ?>');
			cache_plus('<?php echo $projetId ?>');
		}
	</script>
<?php 
}
?>

<!-- /main-->

