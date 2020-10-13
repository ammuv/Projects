<?php


	require './PHPMailer-master/PHPMailerAutoload.php';


		send_mail();

		function send_mail(){
			$mail = new PHPMailer;
			$mail->IsSMTP();
			$mail->SMTPAuth     = true;
			$mail->SMTPSecure   = "tls";
			$mail->Host         = "smtp.gmail.com";
			$mail->Port         = 587;
			$mail->Username     = "swachhgharr@gmail.com";
			$mail->Password     = "digitalindia";
			$mail->setFrom("swachhgharr@gmail.com","Swachh Ghar");
			$mail->addAddress('swachhgharr@gmail.com', 'Swachh');
			$mail->isHTML(true);
			$mail->Subject = 'Message from '.$_POST['Name'].'';
		 	$mail->Body = 'Name : '.$_POST['Name'].' Email : '.$_POST['Email'].' Message: '.$_POST['Message'].' ';
		 	if (!$mail->send()) {
				echo "Oops ! There was a problem in sending the mail! Please try again ! " . $mail->ErrorInfo;
			} else {
		//		echo "We successfully received your mail ! Will contact you shortly !";
			}
		 }

		 echo "<script type='text/javascript'>alert('We have successfully received your message. Will contact you shortly!');</script>";
		 echo "<script type='text/javascript'>setTimeout(\"location.href = 'ownerpage.php';\",1);</script>"; 

	?>

