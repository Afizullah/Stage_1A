<?php
    //Control sur le droit d'accès à cette & sur l'accès à travers un lien direct
    if(defined("SESS_ADMIN_CONTROLER")){
        if(file_exists(SESS_ADMIN_CONTROLER)){
            require_once(SESS_ADMIN_CONTROLER);
        }else{
            header("Location:../");
            die("<div style=\"text-align: center;\"><b>ERROR</b>::Accès non autorisé</div>");
        }
    }else{
        header("Location:../");
        die("<div style=\"text-align: center;\"><b>ERROR</b>::Accès non autorisé</div>");
    }
?>
<!--
<div style="background-color:white;min-height:500px" class="col-lg-12">
    <div style="text-align: center;">
        <h3>Modifier information du compte</h3><br>
    </div>
    <div style="width:80%;margin:auto;box-shadow: 0px 1px 25px rgba(0, 0, 0, 0.1);" class="">-->
    
<div style="background-color:white;min-height:500px" class="col-lg-12">
    <div style="text-align: center;">
        <h3>Modifier vos informations</h3><br>
    </div>
    <div style="width:80%;margin:auto;box-shadow: 0px 1px 25px rgba(0, 0, 0, 0.1);" class="">
		<div class="input-group">
            <span class="input-group-addon">Email : </span>
            <span class="form-control form-control-static"><?php echo $email?></span>
            <button type="button" data-toggle="modal" data-target="#myModal1">Modifier</button>
        </div><br />
        <div class="input-group">
            <span class="input-group-addon">Mot de passe : </span>
            <span class="form-control form-control-static">*******</span>
            <button type="button" data-toggle="modal" data-target="#myModal2">Modifier</button>
        </div><br />
    </div>
</div>

<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modifier mot de passe</h4>
        </div>
        <div id=resu1></div>
        <div class="modal-body">
          	<form id=1 name="f1" style="width:500px;margin:auto;background-color:white;padding:30px;" method="POST">
        		<div class="input-group">
            		<input required style="width:190%;" type="password" class="form-control" name="mdp" placeholder="Votre mot de passe">
        		</div><br/>
        		<div class="input-group">
            		<input required style="width:190%;" type="password" class="form-control" name="mdp2" placeholder="Votre nouveau mot de passe">
        		</div><br/>
        		<div class="input-group">
            		<input required style="width:190%;" type="password" class="form-control" name="mdp3" placeholder="Confirmer votre mot de passe">
        		</div><br/>
		        <div style="text-align: center;">
		              <input type="button" onclick="testfile(1)"class="btn btn-success" class="form-control" name="addUser" value="Valider">
		        </div>
		    </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" onclick="form_clear()" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modifier votre adresse email</h4>
        </div>
        <div id="resu2"></div>
        <div class="modal-body">
        	<div id="m1" style="display: block;">
	          	<form id=2 name="f2" style="width:500px;margin:auto;background-color:white;padding:30px;" method="POST">
	        		<div class="input-group">
	            		<input required style="width:190%;" type="password" class="form-control" name="mdp" placeholder="Votre mot de passe">
	        		</div><br/>
	        		<div class="input-group">
	            		<input required style="width:190%" type="email" class="form-control" name="mail1" placeholder="Nouvelle adresse email">
	        		</div><br/>
	        		<div class="input-group">
	            		<input required style="width:190%" type="email" class="form-control" name="mail2" placeholder="Confirmer votre adresse email">
	        		</div><br/>
			        <div style="text-align: center;">
			              <input type="button" onclick="testfile(2)" class="btn btn-success" class="form-control" name="addUser" value="Valider">
			        </div>
			    </form>
			</div>
			<div id="m2" style="display: none;">
	          	<form id=3 name="f3" style="width:500px;margin:auto;background-color:white;padding:30px;" method="POST">
	        		<div class="input-group">
	            		<input required style="width:190%;" type="text" class="form-control" name="token" placeholder="Code de confirmation">
	        		</div><br/>
			        <div style="text-align: center;">
			              <input type="button" onclick="testfile(3)" class="btn btn-success" class="form-control" name="addUser" value="Valider">
			        </div>
			    </form>
			</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" onclick="form_clear()" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>

<script type="text/javascript">
	function testfile(val){
        //document.getElementById("contentExcelFileAnalyse").innerHTML='<center><div class="loader"></div></center>';
        var fd = new FormData(document.getElementById(val));
        if(val==3){
        	val=2;
        }
           fd.append("label", val);
           $.ajax({
             url: "index.php?page=assync_editUser",
             type: "POST",
             data: fd,
             //mimeTypes:"multipart/form-data",
             processData: false,  // tell jQuery not to process the data
             contentType: false   // tell jQuery not to set contentType
           }).done(function( data ) {
           		var tab=data.split("//");
           		var tab1=tab[1].split(":");
           		if (tab1[0]==3){
           			document.getElementById("m1").style.display="none";
           			document.getElementById("m2").style.display="inline";
           		}
           		else{
           			reset(tab1);
           		}
               	document.getElementById("resu"+val).innerHTML=tab[0];
           });
           return false;
	}

	function reset(tab){
		if (tab[0]==1){
			if (tab[1]=="TRUE"){
				document.forms["f1"]["mdp"].value="";
			}
			if (tab[2]=="TRUE"){
				document.forms["f1"]["mdp2"].value="";
			}
			if (tab[3]=="TRUE"){
				document.forms["f1"]["mdp3"].value="";
			}
		}
		else if(tab[0]==2){
			if (tab[1]=="TRUE"){
				document.forms["f2"]["mdp"].value="";
			}
			if (tab[2]=="TRUE"){
				document.forms["f2"]["mail1"].value="";
			}
			if (tab[3]=="TRUE"){
				document.forms["f2"]["mail2"].value="";
			}
		}
		else{
			document.forms["f2"]["mdp"].value="";
			document.forms["f2"]["mail1"].value="";
			document.forms["f2"]["mail2"].value="";
			document.forms["f3"]["token"].value="";
			document.getElementById("m1").style.display="inline";
           	document.getElementById("m2").style.display="none";
		}

	}

	function form_clear(ok){
		document.forms["f1"]["mdp"].value="";
		document.forms["f1"]["mdp2"].value="";
		document.forms["f1"]["mdp3"].value="";
		document.forms["f2"]["mdp"].value="";
		document.forms["f2"]["mail1"].value="";
		document.forms["f2"]["mail2"].value="";
		document.forms["f3"]["token"].value="";
		document.getElementById("m1").style.display="inline";
       	document.getElementById("m2").style.display="none";
	}

</script>
