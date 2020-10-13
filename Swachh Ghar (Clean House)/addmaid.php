<?php
session_start();
if(isset($_SESSION['name'])){
  $name=$_SESSION['name'];
  $id=$_SESSION['id'];
}
else{
  header("Location: errorpage.php");
}



$maidid = $_POST['maidid'];
$sweeping = $_POST["sweep"];
$cooking = $_POST["cook"];
$cleaning = $_POST["clean"];


if($sweeping == '')
	$sweeping = 0;

if($cooking == '')
	$cooking = 0;

if($cleaning == '')
	$cleaning = 0;

if( ($sweeping == '') && ($cooking == '') && ($cleaning == '')){
	 echo "<script type='text/javascript'>alert('Please mention the amount to be paid for the maid!');</script>";
     echo "<script type='text/javascript'>setTimeout(\"location.href = 'viewmaids.php';\",1);</script>"; 
     exit;
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

	$sql = "select * from HouseMaid where MID = $maidid";
	$getResults = sqlsrv_query($conn, $sql);

	if(sqlsrv_has_rows($getResults)  != false){
		$tsql= "insert into HouseOwnerMaid(OID,MID,CookingSal,SweepingSal,CleaningSal) values ($id,$maidid,$cooking,$sweeping,$cleaning)";	
		echo "<script type='text/javascript'>alert('Maid added Successfully!');</script>";
		echo "<script type='text/javascript'>setTimeout(\"location.href = 'viewmaids.php';\",1);</script>";
		sqlsrv_query($conn, $tsql);  
	}
	else{
		echo "<script type='text/javascript'>alert('Invalid Maid ID! Please try again.');</script>";
		echo "<script type='text/javascript'>setTimeout(\"location.href = 'viewmaids.php';\",1);</script>";
	}
?>


