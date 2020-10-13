			
<?php
	

require './PHPMailer-master/PHPMailerAutoload.php';

			$username = $_POST['username'];

			$serverName = "myserver-2018.database.windows.net";
			$connectionOptions = array(
			    "Database" => "SwachhGhar",
			    "Uid" => "sampledb",
			    "PWD" => "Arunvishal13"
			);
			$conn = sqlsrv_connect($serverName, $connectionOptions);
			if( $conn === false ) {
			     die( print_r( sqlsrv_errors(), true));
			}

			$sql= "select * from HouseOwner where Username = '$username'";
			$getResults=sqlsrv_query($conn, $sql);

			while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
				$name = $row['Name'];
				$password =$row['Password'];
				$emailid = $row['Email'];
				//echo $emailid;
				send_mail($name,$password,$emailid);
			}
			echo "<script type='text/javascript'>alert('We have sent you the password to your mail account! Please look into it!');</script>";
			echo "<script type='text/javascript'>setTimeout(\"location.href = 'index.html';\",1);</script>";


function send_mail($name,$pass,$email){
	$mail = new PHPMailer;
	$mail->IsSMTP();
	$mail->SMTPAuth     = true;
	$mail->SMTPSecure   = "tls";
	$mail->Host         = "smtp.gmail.com";
	$mail->Port         = 587;
	$mail->Username     = "swachhgharr@gmail.com";
	$mail->Password     = "digitalindia";
	$mail->setFrom("swachhgharr@gmail.com","Swachh Ghar");
	$mail->addAddress($email,$name);
	$mail->isHTML(true);
	$mail->Subject = 'Password forget request';
 	$mail->Body = 'Hi '.$name.' ! It seems like you have forgotten your password. Your password is '.$pass.'. Sign in and enjoy! ';
 	if (!$mail->send()) {
		echo "Oops ! There was a problem in sending the mail! Please try again ! " . $mail->ErrorInfo;
	} else {
		echo "We successfully received your mail ! Will contact you shortly !";
	}
 } 


