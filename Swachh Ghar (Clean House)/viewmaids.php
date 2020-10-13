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
  <title>View Maids </title>
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
  <a href="ownerpage.php">Home</a>
  <a href="viewprofile.php">View Profile</a>
  <a href="viewmaids.php" class="active">View Maids</a>
  <a href="checkrequirementsowner.php">Check Requirements</a>
  <a href="requirements.php">Post Requirements</a>
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
$tsql= "SELECT * FROM HouseOwnerMaid where oid = $id";
$getResults= sqlsrv_query($conn, $tsql);

if ($getResults == FALSE)
    echo (sqlsrv_errors());
 $row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC); ?>
	 <?php
        $sql= "select b.MID,b.Name,a.SweepingSal,a.CookingSal,a.CleaningSal from HouseOwnerMaid a join HouseMaid b on a.MID=b.MID where a.OID= $id";
        
        $results = sqlsrv_query($conn,$sql);
      ?>
  
   <div class="background">
      <h2><center><font size="13" color="white" face="Garamond">Maids in your home!</font></center></h2>
      <br><br>
    <form method="post" action="checkmaidinfo.php">
      <table style="width:70%", align="center", class="Maids" height="15">
            <tr>
              <th ><center>Name</center></th>
              <th><center>Sweeping Salary</center></th> 
              <th><center>Cooking Salary</center></th>
              <th><center>Cleaning Salary</center></th>
              <th><center>View Profile</center></th>
            </tr>

      <?php while ($result = sqlsrv_fetch_array($results, SQLSRV_FETCH_ASSOC)) { ?>
            <tr>
          	  <td height="30"> <?php echo $result['Name']; ?>  </td>
          	  <td height="30"> <?php echo $result['SweepingSal']; ?> </td>
          	  <td height="30"> <?php echo $result['CookingSal']; ?>  </td>
          	  <td height="30"><?php echo $result['CleaningSal']; ?>  </td>
              <td height="30"><button type="submit" name="button" value="<?php echo $result['MID']; ?>">Check Info</button></td>
             </tr>     
        <?php }
        //sqlsrv_free_stmt($getResults);
        ?>
        </table>
        </form>
        <br><br>
        <div class="buttontable">
        <p align="center">
          <button id = "2" class="button">Add Maid</button>
          <button id = "1" class="button">Delete Maid</button></p>
        </div>
    

<div id="remove">
 <form method="post" action="deletemaid.php"> 
  <table style="width:70%", align="center", class="Maids">
              <tr>
                <th><center>MID</center></th>
                <th><center>Name</center></th> 
                <th><center>Remove Maid</center></th>
              </tr>

        <?php 
          $sql= "select b.MID,b.Name,a.SweepingSal,a.CookingSal,a.CleaningSal from HouseOwnerMaid a join HouseMaid b on a.MID=b.MID where a.OID= $id";
      
          $results = sqlsrv_query($conn,$sql);

             while ($result = sqlsrv_fetch_array($results, SQLSRV_FETCH_ASSOC)) { ?>
                  <tr>
                    <td height="30"> <?php echo $result['MID']; ?>  </td>
                    <td height="30"> <?php echo $result['Name']; ?> </td>
                    <td height="30"><input type="checkbox" name="work_list[]" value="<?php echo $result['MID']; ?>"/></td>
                   </tr>     
            <?php }
        ?>
  </table>
  <br><br>

  <div class="buttontable">
    <p align="center">  
    <button type="submit" class="button" name="confirm">Confirm</button></p>
  </div>
</form>
</div>

<div class="login" style="background : none;">
  <div class="login-form">
    <div id="add">
      <form method="post" action="addmaid.php">
          <h3><br>Enter Maid ID:</h3>
          <input name="maidid" type="number"  placeholder="Enter Maid ID" /><br>
          <h3>Sweeping Salary:</h3>
          <input name="sweep" type="number" placeholder="Sweeping Salary"/><br>
          <h3>Cleaning Salary:</h3>
          <input name="clean" type="number" placeholder="Sweeping Salary"/><br>
          <h3>Cooking Salary:</h3>
          <input name="cook" type="number" placeholder="Sweeping Salary"/><br>
          
          <input type="submit" value="Approve"></button>
        </form>
    </div>
  </div>
</div>
</div>
<br><br>
</div>
</body>