
<?php

require './PHPMailer-master/PHPMailerAutoload.php';

	$name =  $_POST["name"];
	$gender =  $_POST["gender"];
	$age =  $_POST["age"];
	$emailid =  $_POST["emailid"];
	$phonenumber =  $_POST["phonenumber"];
	$address =  $_POST["address"];
	$city =  $_POST["city"];
	$username =  $_POST["username"];
	$password =  $_POST["pass"];
	$expectations = $_POST["expectations"];
	$username = $_POST["username"];
	$password = $_POST["pass"];
	$aadhar = $_POST["aadhar"];
	$cpass = $_POST["cpass"];
	

	if($password == $cpass){
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

			$sql = "select Username from HouseOwner";
			$getResults = sqlsrv_query($conn, $sql);

			while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
				if($username == $row['Username']){
					echo "<script type='text/javascript'>alert('Username already existed! Please choose different username!');</script>";
					echo "<script type='text/javascript'>setTimeout(\"location.href = 'signup.php';\",1);</script>";
					exit;
						
				}

			}			


			$sql= "insert into HouseOwner(Name,Age,Username,Password,Email,Phone,Address,City,Aadhar,Expectations,Gender) values('$name',$age,'$username','$password','$emailid','$phonenumber','$address','$city','$aadhar','$expectations','$gender')";

			sqlsrv_query($conn, $sql);
			send_mail();
			session_start();
			$_SESSION['name'] = $name;
			$sql= "select OID from HouseOwner where username='$username' and password='$password'";

			$getResults=sqlsrv_query($conn, $sql);

			while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
				$_SESSION['id'] =$row['OID'];
			}
			echo "<script type='text/javascript'>setTimeout(\"location.href = 'ownerpage.php';\",1);</script>";
	}

	else{
			echo "<script type='text/javascript'>alert('Password not matching!');</script>";
			echo "<script type='text/javascript'>setTimeout(\"location.href = 'signup.php';\",1);</script>";
	}

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
	$mail->addAddress($_POST["emailid"],$_POST["name"]);
	$mail->isHTML(true);
	$mail->Subject = 'Greetings from Swachh Garr!';
 	$mail->Body = 'Hi '.$_POST["name"].' ! Thanks for joining with us! Hope you will have a good experience with us! Thank you!';
 	if (!$mail->send()) {
		echo "Oops ! There was a problem in sending the mail! Please try again ! " . $mail->ErrorInfo;
	} else {
		echo "We successfully received your mail ! Will contact you shortly !";
	}
 } 

?>

