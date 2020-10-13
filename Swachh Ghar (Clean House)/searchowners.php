<?php
session_start();
if(isset($_SESSION['name'])){
  $name=$_SESSION['name'];
  $id=$_SESSION['id'];
}
else{
  header("Location: errorpage.php");
}

?>

<html>

<header>
  <link rel="stylesheet" href="CSS\style.css"/>
  <link href='https://fonts.googleapis.com/css?family=Ubuntu:500' rel='stylesheet' type='text/css'>
  <img src="CSS/SwachhGharLogo.jpg" style="height: 90px; float: left; margin-left: 150px;"><br>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</header>

<body>
  
<br><br><br><br>
<div class="topnav" id="myTopnav">
  <a href="servantpage.php" >Home</a>
  <a href="viewservantprofile.php">View Profile</a>
  <a href="viewowners.php">View Owners</a>
  <a href="checkrequirementsmaid.php" class="active">Check Requirements</a>
  <a href="maidrequirements.php">Post Requirements</a>
  <a href="logout.php">Logout</a>
</div>


<?php

$flag = $_POST['flag'];


  if($flag=='0'){
      $city='no';
      $sweeping = 'no';
      $cleaning = 'no';
      $cooking = 'no';

			 $city = $_POST['city'];
			  
          if(!empty($_POST['work_lis'])){
			        foreach($_POST['work_lis'] as $selected){
			          if($selected == 'Sweeping')
			            $sweeping = 'yes';
			          else if($selected == 'Cleaning')
			            $cleaning = 'yes';
			          else if($selected == 'Cooking')
			            $cooking = 'yes';
			        }
            }

			  



			if($city == '')
			  $sql  = "select * from Request a join HouseOwner b on a.OID = b.OID where b.City is not null and ";
			    
			else
			  $sql  = "select * from Request a join HouseOwner b on a.OID = b.OID where b.City = '$city' and ";


			if($sweeping == 'yes')
			  $sql = $sql . "a.SweepingSal > 0 and ";
			else
			  $sql = $sql . "(a.SweepingSal is not null or a.SweepingSal is null)  and ";


			if($cleaning == 'yes')
			  $sql = $sql . "a.CleaningSal > 0 and ";
			else
			  $sql = $sql . "(a.CleaningSal is not null or a.CleaningSal is null) and ";


			if($cooking == 'yes')
			  $sql = $sql . "a.CookingSal > 0 ";
			else
			  $sql = $sql . "(a.CookingSal is not null or a.CookingSal is null)";
	
			$_SESSION['sql'] = $sql;  
	}

	else{
		$sql = $_SESSION['sql'];
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
$getResults= sqlsrv_query($conn, $sql);
if(sqlsrv_has_rows($getResults)  != false){

?>
  
<div class="background">
      <br><br>
    <form method="post" action="searchownerinfo.php">
      <table style="width:70%", align="center", class="Maids" height="15">
            <tr>
              <th ><center>Name</center></th>
              <th><center>Sweeping Salary</center></th> 
              <th><center>Cooking Salary</center></th>
              <th><center>Cleaning Salary</center></th>
              <th><center>City</center></th>
              <th><center>View Profile</center></th>
            </tr>

<?php

  while ($result = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) { ?>
      <tr>
              <td height="30"> <?php echo $result['Name']; ?>  </td>
              <td height="30"> <?php echo $result['SweepingSal']; ?> </td>
              <td height="30"> <?php echo $result['CookingSal']; ?>  </td>
              <td height="30"><?php echo $result['CleaningSal']; ?>  </td>
              <td height="30"><?php echo $result['City']; ?>  </td>
              <td height="30"><button type="submit" name="button" value="<?php echo $result['OID']; ?>">Check Info</button></td>
             </tr>     
        <?php }
        //sqlsrv_free_stmt($getResults);
        ?>
        </table>
        </form>

        <br><br>

        <div class="login" style="background : none;">
              <div class="login-form">
                <button onClick="parent.location='checkrequirementsmaid.php'" type="button" class="btn btn-default">Back</button>
              </div>
            </div>
        </div>


  <?php }

  else{?>
  <div class="background">
    <div class="login" style="background : none;">
        <div class="login-form">
            <br><br><h1><center><font color="white" face="Garamond" size="15"><b> Owners not found! </b></font></center></h1><br>
            <button onClick="parent.location='checkrequirementsmaid.php'" type="button" class="btn btn-default">Back</button><br><br><br>
          </div>
      </div>
  </div>

  <?php
  }

?>

     </body>
  </html>

