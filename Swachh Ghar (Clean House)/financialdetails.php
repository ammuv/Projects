<?php
session_start();
$name=$_SESSION['name'];
$id=$_SESSION['id'];
?>

<html>

<header>
  <title>Financial Details </title>
  <link rel="stylesheet" href="CSS\style.css"/>
  <link href='https://fonts.googleapis.com/css?family=Ubuntu:500' rel='stylesheet' type='text/css'>
  <img src="CSS/SwachhGharLogo.jpg" style="height: 90px; float: left; margin-left: 150px;"><br>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</header>



<body>

<br><br><br><br>
<div class="topnav" id="myTopnav">
  <a href="ownerpage.php">Home</a>
  <a href="viewprofile.php" >View Profile</a>
  <a href="viewmaids.php" >View Maids</a>
  <a href="checkrequirementsowner.php"  class="active">Check Requirements</a>
  <a href="requirements.php">Post Requirements</a>
  <a href="financialdetails.php">Financial Details</a>
  <a href="index.html">Logout</a>
</div>



<?php
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
$tsql= "SELECT * FROM HouseOwnerMaid where oid = $id";
echo "<script type='text/javascript'>alert('$tsql');</script>";
$getResults= sqlsrv_query($conn, $tsql);

if ($getResults == FALSE)
    echo (sqlsrv_errors());
 $row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC); ?>
	 <?php
        $sql= "select b.MID,b.Name,a.SweepingSal,a.CookingSal,a.CleaningSal from HouseOwnerMaid a join HouseMaid b on a.MID=b.MID where a.OID= $id";
        echo "<script type='text/javascript'>alert('$sql');</script>";
        $results = sqlsrv_query($conn,$sql);
      ?>
   <div class="background">
      <h2><center><font size="13" color="white" face="Garamond">List of Maids and Salaries!</font></center></h2>
      <br><br>
    
      <table style="width:70%", align="center", class="Maids" height="15">
            <tr>
              <th ><center>Name</center></th>
              <th><center>Sweeping Salary</center></th> 
              <th><center>Cooking Salary</center></th>
              <th><center>Cleaning Salary</center></th>
            </tr>

      <?php while ($result = sqlsrv_fetch_array($results, SQLSRV_FETCH_ASSOC)) { ?>
            <tr>
          	  <td height="30"> <?php echo $result['Name']; ?>  </td>
          	  <td height="30"> <?php echo $result['SweepingSal']; ?> </td>
          	  <td height="30"> <?php echo $result['CookingSal']; ?>  </td>
          	  <td height="30"><?php echo $result['CleaningSal']; ?>  </td>
             </tr>     
        <?php }
        //sqlsrv_free_stmt($getResults);
        ?>
        </table>
        
        <h2><center><font size="13" color="white" face="Garamond">Total Expenditure</font></center></h2>

        <?php
        	$sql= "select b.MID,b.Name,sum(a.SweepingSal) as sum1,sum(a.CookingSal) as sum2,sum(a.CleaningSal) as sum3 from HouseOwnerMaid a join HouseMaid b on a.MID=b.MID where a.OID= $id";
        	echo "<script type='text/javascript'>alert('$sql');</script>";
        	$results = sqlsrv_query($conn,$sql);
        	?>
        	      <table style="width:70%", align="center", class="Maids" height="15">
            <tr>
              <th ><center>Name</center></th>
              <th><center>Sweeping Salary</center></th> 
              <th><center>Cooking Salary</center></th>
              <th><center>Cleaning Salary</center></th>
            </tr>

        	<br><br>
        	<?php
      	 while ($result = sqlsrv_fetch_array($results, SQLSRV_FETCH_ASSOC)) { ?>
            <tr>
          	  <td height="30"> <?php echo $result['MID']; ?>  </td>
          	  <td height="30"> <?php echo $result['Name']; ?> </td>
          	  <td height="30"> <?php echo $result['sum1']; ?>  </td>
          	  <td height="30"><?php echo $result['sum2']; ?>  </td>
             </tr>     
        <?php }
        //sqlsrv_free_stmt($getResults);
        ?>
        </table>
        
      

        <br><br>
  


