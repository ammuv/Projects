<?php
session_start();
if(isset($_SESSION['name'])){
  $name=$_SESSION['name'];
  $id=$_SESSION['id'];
}
else{
  header("Location: errorpage.php");
}



$serverName = "myserver-2018.database.windows.net";
$connectionOptions = array(
    "Database" => "SwachhGhar",
    "Uid" => "sampledb",
    "PWD" => "Arunvishal13"
);
//Establishes the connection
$conn = sqlsrv_connect($serverName, $connectionOptions);
if( $conn === false ) {
     die( print_r( sqlsrv_errors(), true));
}


if(!empty($_POST['work_list'])){  
	foreach($_POST['work_list'] as $value){
		$tsql= "delete FROM HouseOwnerMaid where oid = $id and MID = $value";
		echo "<script type='text/javascript'>alert('Maid deleted Successfully!');</script>";
		echo "<script type='text/javascript'>setTimeout(\"location.href = 'viewmaids.php';\",1);</script>";
		sqlsrv_query($conn, $tsql);  
	}
}

else{
		echo "<script type='text/javascript'>alert('Please select maids to be deleted!');</script>";
		echo "<script type='text/javascript'>setTimeout(\"location.href = 'viewmaids.php';\",1);</script>";
}
?>




