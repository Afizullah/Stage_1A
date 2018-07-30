
<style>
    img:hover {
    border: 3px;
    border-style: solid;    
    border-color: #878787;
}

</style>
<?php
function genere_case($filename){
	global $filelocation;
?>
<td style="width: 20%;">
	<center>
	<table style="text-align: center;">
	    <tr>
	        <td>
	        	<a href=<?php echo $filelocation.$filename.".pdf"?> onclick="window.open(this.href); return false;" >
	            	<img src=<?php echo $filelocation.$filename.".png"?> width="160" height="240" alt="livret"/>
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
?>


<table style="width:100%; text-align: center;">
	<tr>
	<?php
	for ($i=0;$i<count($livrets);$i++){
		if ($i%5==0 && $i!=0){
			?></tr><tr><?php
		}
		genere_case($livrets[$i]);
	}
	for($j=1;$j<=5-$i%5;$j++){
		?><td style="width:20%"></td><?php
	} 
	?>
	</tr>
</table>