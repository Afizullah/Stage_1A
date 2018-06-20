<?php

	//session_start();
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	
	function sendMail() {
	
		require './PHPMailer/src/Exception.php';
		require './PHPMailer/src/PHPMailer.php';
		require './PHPMailer/src/SMTP.php';
	
		$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
		try {
			//Server settings
			$mail->SMTPDebug = 2;                                 // Enable verbose debug output
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'aliouibnibrahim@gmail.com';                 // SMTP username
			$mail->Password = '';                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    // TCP port to connect to
	
			//Recipients
			$mail->setFrom('aliouibnibrahim@gmail.com', 'Aliou');
			// $mail->addAddress('aliouibnibrahim@yahoo.fr', 'Aliou Sall');     // Add a recipient
			$mail->addAddress($_SESSION['mail']);               // Name is optional
			$mail->addReplyTo('aliouibnibrahim@gmail.com', 'Information');
			// $mail->addCC('cc@example.com');
			// $mail->addBCC('bcc@example.com');
	
			//Attachments
			// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
			// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	
			//Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = 'Here is the subject';
			$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	
			$mail->send();
			echo 'Message has been sent';
		} catch (Exception $e) {
			echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		}
	}

	// session_destroy();
	// header("Refresh:1; url=Authentification.html");

// ?>