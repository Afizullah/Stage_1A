
<style>
    img:hover {
    border: 3px;
    border-style: solid;    
    border-color: #878787;
}

</style>
<?php
function genere_case($filename,$projet_id){
	global $filelocation;
	$filelocation_locale=$filelocation.$projet_id."/";
?>
<td style="width: 20%;">
	<center>
	<table style="text-align: center;">
	    <tr>
	        <td>
	        	<a href=<?php echo $filelocation_locale.$filename.".pdf"?> onclick="window.open(this.href); return false;" >
	            	<img src=<?php echo $filelocation_locale.$filename.".png"?> width="160" height="240" alt="livret"/>
	            </a>
	        </td>
	    </tr>
	    <tr>
	        <td><?php echo $filename.'.pdf';?></td>
	    </tr>
	</table>
</center>
</td>
<?php
}


function genere_livrets_projet($projet_id){
	$livrets=showLivrets::getLivrets($projet_id);
	$projet_name=showLivrets::getName($projet_id)[0]['projet_nom'];
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
	</div>
<?php
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

$projets=get_projet_id($filelocation);
for ($i=0;$i<count($projets);$i++){
	genere_livrets_projet($projets[$i]);
}
?>
	</div>
</div>
<!--/main-->


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
}
function cache_moins(val){
	document.getElementById("plus"+val).style.display="block";
	document.getElementById("moins"+val).style.display="none";
}

</script>