<?php
session_start();
if(isset($_SESSION['name'])){
  $name=$_SESSION['name'];
  $id=$_SESSION['id'];
}
else{
  header("Location: errorpage.php");
}


	$name =  $_POST["name"];
	$gender =  $_POST["gender"];
	$age =  $_POST["age"];
	$emailid =  $_POST["emailid"];
	$phonenumber =  $_POST["phonenumber"];
	$address =  $_POST["address"];
	$city =  $_POST["city"];
	$username =  $_POST["username"];
	$expectations = $_POST["expectations"];
	$username = $_POST["username"];
	$aadhar = $_POST["aadhar"];


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

	$tsql= "update HouseMaid set Name = '$name',Email = '$emailid',Address = '$address',City = '$city',Username = '$username',Expectations = '$expectations', Age = $age,Phone = $phonenumber, Aadhar = $aadhar where MID = $id"; 

	sqlsrv_query($conn, $tsql);


	echo "<script type='text/javascript'>alert('Your details successfully updated!');</script>";
	echo "<script type='text/javascript'>setTimeout(\"location.href = 'viewservantprofile.php';\",1);</script>";

?>
