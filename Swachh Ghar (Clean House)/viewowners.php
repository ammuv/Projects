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
  <title>View Owners </title>
  <link rel="stylesheet" href="CSS\style.css"/>
  <link href='https://fonts.googleapis.com/css?family=Ubuntu:500' rel='stylesheet' type='text/css'>
  <img src="CSS/SwachhGharLogo.jpg" style="height: 90px; float: left; margin-left: 150px;"><br>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <script>
    $(document).ready(function(){
            $("#add").hide();
            $("#remove").hide();
        $("#1").click(function(){
            $("#add").hide();
            $("#remove").show();
        });
    $("#2").click(function(){
        $("#add").show();
        $("#remove").hide();
    });
});

</script>


</header>

<body>
  
<br><br><br><br>

<div class="topnav" id="myTopnav">
  <a href="servantpage.php">Home</a>
  <a href="viewservantprofile.php">View Profile</a>
  <a href="viewowners.php"  class="active">View Owners</a>
  <a href="checkrequirementsmaid.php">Check Requirements</a>
  <a href="maidrequirements.php">Post Requirements</a>
  <a href="logout.php">Logout</a>
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
$tsql= "SELECT * FROM HouseOwnerMaid where MID = $id";
$getResults= sqlsrv_query($conn, $tsql);

if ($getResults == FALSE)
    echo (sqlsrv_errors());
 $row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC); ?>
   <?php
        $sql= "select a.OID,b.Name,a.SweepingSal,a.CookingSal,a.CleaningSal from HouseOwnerMaid a join HouseOwner b on a.OID=b.OID where a.MID=$id
";
        echo "<script type='text/javascript'>alert('$sql');</script>";
        $results = sqlsrv_query($conn,$sql);

  if(sqlsrv_has_rows($getResults)  != false){
      ?>
   <div class="background">
      <h2><center><font size="13" color="white" face="Garamond">Your Owners!</font></center></h2>
      <br><br>
    <form method="post" action="checkownerinfo.php">
      <table style="width:70%", align="center", class="Maids" height="15">
            <tr>
              <th ><center>Owner ID</center></th>
              <th ><center>Name</center></th>
              <th><center>Sweeping Salary</center></th> 
              <th><center>Cooking Salary</center></th>
              <th><center>Cleaning Salary</center></th>
              <th><center>View Profile</center></th>
            </tr>

      <?php while ($result = sqlsrv_fetch_array($results, SQLSRV_FETCH_ASSOC)) { ?>
            <tr>
              <td height="30"> <?php echo $result['OID']; ?>  </td>
              <td height="30"> <?php echo $result['Name']; ?>  </td>
              <td height="30"> <?php echo $result['SweepingSal']; ?> </td>
              <td height="30"> <?php echo $result['CookingSal']; ?>  </td>
              <td height="30"><?php echo $result['CleaningSal']; ?>  </td>
              <td height="30"><button type="submit" name="button" value="<?php echo $result['OID']; ?>">Check Info</button></td>
             </tr>     
        <?php }
        //sqlsrv_free_stmt($getResults);
        ?>
        </table>
      </form>
      <br><br>
      </div>
      

      <?php   }
        else{
      ?>
        <div class="background"><br><br>
            <h2><center><font size="13" color="white" face="Garamond">Its time to start working!</font></center></h2><br><br>
      <?php  }
        ?>
    </div>
  </body>
</html>

