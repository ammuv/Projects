<?php

	$username =  $_POST["username"];
	$password =  $_POST["pass"];
	
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
	$tsql= "SELECT * FROM HouseOwner where username = '$username' and password= '$password'";
	echo "<script type='text/javascript'>alert('$tsql');</script>";
	$getResults= sqlsrv_query($conn, $tsql);
	$count = 0;
	
		while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
			//echo $row['Name'];
			 $count =  1;
			 session_start();
			if(isset($row['Name'])){
				$_SESSION['name'] = $row['Name'];
				$_SESSION['id'] =$row['OID'];
			}
		} 
	
		if($count == 0){
				echo "<script type='text/javascript'>alert('Invalid Username or Password!');</script>";
				echo "<script type='text/javascript'>setTimeout(\"location.href = 'index.html';\",1);</script>";

		}

		else{
			echo "<script type='text/javascript'>alert('Welcome');</script>";
			echo "<script type='text/javascript'>setTimeout(\"location.href = 'ownerpage.php';\",1);</script>";
			}
?>