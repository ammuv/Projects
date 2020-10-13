<?php
session_start();
if(isset($_SESSION['name'])){
  $name=$_SESSION['name'];
  $id=$_SESSION['id'];
}
else{
  header("Location: errorpage.php");
}


$value = $_POST['button'];

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

$sql = "delete from Request where RID=$value";
$getResults= sqlsrv_query($conn, $sql);

	echo "<script type='text/javascript'>alert('Requirement deleted successfully!');</script>";
	echo "<script type='text/javascript'>setTimeout(\"location.href = 'maidrequirements.php';\",1);</script>";

?>



