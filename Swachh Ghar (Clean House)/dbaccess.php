<?php
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
$tsql= "SELECT * FROM temp where id =100";

$getResults= sqlsrv_query($conn, $tsql);

if(!empty($_POST['work_lis'])){  

	

if(sqlsrv_has_rows($getResults)  == false)
	echo "Records not found!";

else
	echo "Not emptyyy";


echo "<script type='text/javascript'>alert('$getResults');</script>";

if ($getResults == FALSE)
    echo (sqlsrv_errors());
$sql = "insert into temp(id,name) values (6,'Kishore')";
//sqlsrv_query ($conn ,$sql);
while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
 echo ($row['name']);
}

sqlsrv_free_stmt($getResults);
?>