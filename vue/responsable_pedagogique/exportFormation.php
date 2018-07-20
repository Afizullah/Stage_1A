<?php
?>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap.min.css" />

<?php
function genere_entete(){
	$nom_colonne=getleafColsRequired();
	for($i=0;$i<count($nom_colonne);$i++){
		?>
		<th><?php echo $nom_colonne[$i];?></th>
		<?php
	}	
}

function genere_ec($i,$tab){
    $champs=getchamps();
    ?><tr><?php
    for($k=0;$k<count($champs);$k++){?>
        <td><?php echo $tab[$i][$champs[$k]];?></td>
    <?php
    }
    ?></tr><?php
}

function genere_ue($i,$tab){
    ?>
    <tr>
        <td><?php echo $tab[$i]['formation_code']?></td>
        <td><?php echo $tab[$i]['ue_code']?></td>
        <td></td>
        <td><?php echo $tab[$i]['ue_semestr']?></td>
        <td><?php echo $tab[$i]['classe_nom']?></td>
        <td><?php echo $tab[$i]['ec_nom']?></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <?php
    $ue=$tab[$i]['ue_id'];
    while($ue==$tab[$i]['ue_id']){
        genere_ec($i,$tab);
        $i++;
        if ($i==count($tab)){
            return -1;
        }
    }
    return $i;
}

function genere_semestre($i,$tab){
    ?>
    <tr>
        <td><?php echo $tab[$i]['formation_code']?></td>
        <td></td>
        <td></td>
        <td></td>
        <td><?php echo "SEMESTRE".$tab[$i]['ue_semestr']?></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <?php
    $semestre=$tab[$i]['ue_semestr'];
    while($semestre==$tab[$i]['ue_semestr']){
        $i=genere_ue($i,$tab);
        if ($i==-1){
            return -1;
        }
    }
    return $i;
}
function genere_formation($tab){
    $i=0;
    while($i!=-1){
        $i=genere_semestre($i,$tab);
    }
}

?>
<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <?php genere_entete();?>
        </tr>
    </thead>
    <tbody>
        <?php genere_formation(getTab());?>
    </tbody>
</table>




<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript">


function dump(obj) {
    var out = '';
    for (var i in obj) {
        out += i + ": " + obj[i] + "\n";
    }

    alert(out);

    // or, if you wanted to avoid alerts...

    var pre = document.createElement('pre');
    pre.innerHTML = out;
    document.body.appendChild(pre)
}

$(document).ready(function() {
    var table = $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [{
            extend: 'excelHtml5',
            title: null,
            filename: 'test',
            customize: function( xlsx ) {
                xlsx.xl.worksheets['sheet1.xml']['title']="voila"
                dump(xlsx.xl.worksheets['sheet1.xml']);
 
                // jQuery selector to add a border
            }
        }]
    });
 
    table.buttons().container()
        .appendTo( '#example_wrapper .col-sm-6:eq(0)' );
} );
</script>
