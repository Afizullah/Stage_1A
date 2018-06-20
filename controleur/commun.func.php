<?php

    //fonction contre les injection sql
    function secure($val){
        return htmlspecialchars(trim($val));
    }

    function br(){
        echo "<br />";
    }
    //
    function isEmail($val){
        if(preg_match("#^[a-z0-9._-]{2,50}[@][a-z0-9._-]{2,30}[.][a-z]{2,6}$#",$val)){
            return $val;
        }else{
            return false;
        }
    }

    function _hash($string){
        return hash("sha256",$string);
    }
    function today($format="fr"){
        switch ($format) {
            case 'fr':
                return date("Y-m-d");
        }
    }

    function getNewToken($defaultSize=50){
        return generateNewString($defaultSize);
    }

    function sendMail($mail,$email,$prenom,$nom,$token){
        try {
    	    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    	    $mail->isSMTP();                                      // Set mailer to use SMTP
    	    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    	    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    	    $mail->Username = MAIL;                 // SMTP username
    	    $mail->Password = PSW;                           // SMTP password
    	    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    	    $mail->Port = 587;                                    // TCP port to connect to

    	    //Recipients
    	    $mail->setFrom(MAIL, 'LIVRET');
    	    // $mail->addAddress('aliouibnibrahim@yahoo.fr', 'Aliou Sall');     // Add a recipient
    	    $mail->addAddress($email);               // Name is optional
    	    $mail->addReplyTo(MAIL, 'Information');
    	    // $mail->addCC('cc@example.com');
    	    // $mail->addBCC('bcc@example.com');

    	    //Attachments
    	    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    	    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    	    //Content
    	    $mail->isHTML(true);
            $link = APP_URL."index.php?page=activeAccount&token=".$token;                                // Set email format to HTML
    	    $mail->Subject = 'Activation compte livret';
    	    $mail->Body    = 'Bonjour '.$prenom.' '.$nom.' cliquez sur ce lien pour activer votre compte<br />'.$link;
    	    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    	    $mail->send();
    	    //echo 'Message has been sent';
            return true;
    	} catch (Exception $e) {
    	    //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            return false;
    	}

    }
    function getDateExpirationAccount($nbrHeures){
        $dateExpire = new DateTime("NOW +".$nbrHeures." hours");
        return $dateExpire->format("Y-m-d H:i:s");
    }
    function generateNewString($lenght,$toString=array(),$notInTab=array()){
      if(empty($toString)){
        $toString = "aazertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN1234567890";
      }
        $stringGenerate ="";
        if($lenght>0 && intval(strlen("".$toString.""))>0){
        	do{
        		for($i=	0;$i<intval($lenght);$i++){
        			$stringGenerate.=$toString[mt_rand(0,intval(strlen("".$toString."")-1))];
        		}
        	}while(in_array($stringGenerate,$notInTab));
        	return $stringGenerate;
        }else{
        	return NULL;
        }
    }
?>
