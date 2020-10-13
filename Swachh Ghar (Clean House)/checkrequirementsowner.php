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

    <script>

        $(document).ready(function(){
            $("#city").hide();
            $("#work").hide();
            $("#button").hide();
        });


        function cityselect(res){

            if(res.checked){
                $("#city").show();
                $("#button").show();
            }

            else{
                $("#city").hide();
            }
        }


        function workselect(res){

            if(res.checked){
                $("#work").show();
                $("#button").show();    
            }

            else{
                $("#work").hide();
            }
        }     

        </script>

</header>

<style>
  body input[type="checkbox"]{
        height : 25px;
        width : 25px;
    }
    body select{
        height : 60px;
        width : 150px;
    }   
</style>

<body>
  
<br><br><br><br>
<div class="topnav" id="myTopnav">
  <a href="ownerpage.php">Home</a>
  <a href="viewprofile.php">View Profile</a>
  <a href="viewmaids.php">View Maids</a>
  <a href="checkrequirementsowner.php" class="active">Check Requirements</a>
  <a href="requirements.php">Post Requirements</a>
  <a href="logout.php">Logout</a>
</div>

<div class="background">
   <div class="login">
      <div class="login-form">
      <form name="servant"  method="post" action="searchmaids.php">
        <h1><font color="white" size="10" face="Garamond"> Search Maids</font></h1><br>
        <input id="c" type="checkbox" name="work_list[]" value="city" onchange="cityselect(this);"><label><font size="5" color="white" face="Garamond">By City</font></label>
        <input id="w" type="checkbox" name="work_list[]" value="Cleaning" onchange="workselect(this);"><label><font size="5" color="white" face="Garamond">By Work</font></label> 

        <div id="city">
          <h3><font color="white" size="6" face="Garamond"> Enter City Name:</font></h3>
          <input name="city" type="text" pattern="([A-Za-z]*|[' '])*" placeholder="City Name" required/><br>
        </div>
          
        <div id="work">
            <h3><font color="white" size="6" face="Garamond">Select your option</font></h3><br> 
            <input id="s" type="checkbox" name="work_lis[]" value="Sweeping""><label><font size="5" color="white" face="Garamond">Sweeping</font></label>
            <input id="co" type="checkbox" name="work_lis[]" value="Cooking""><label><font size="5" color="white" face="Garamond">Cooking</font></label><br/>
            <input id="cl" type="checkbox" name="work_lis[]" value="Cleaning""><label><font size="5" color="white" face="Garamond">Cleaning</font></label> 
        </div>
            <br><br>
            <input name="flag" type="hidden" value="0">
            <input id="button" name="submit" type="submit" value="Search">
        <br>
     </form>
     </div>
    </div>

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

$sql = "select a.MID, b.Name, a.SweepingSal, a.CookingSal, a.CleaningSal, b.City from request a join HouseMaid b on a.MID = b.MID where a.MID>0";
$getResults= sqlsrv_query($conn, $sql);

if(sqlsrv_has_rows($getResults)  != false){  
?>

  <br><h1><center><font color="white" face="Garamond" size="12"> List of Maids posted for jobs</font></center></h1>
      <br><br>
    <form method="post" action="getmaidinfo.php">
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
              <td height="30"><button type="submit" name="button" value="<?php echo $result['MID']; ?>">Check Info</button></td>
             </tr>     
        <?php }
        //sqlsrv_free_stmt($getResults);
        ?>
        </table>
        </form>
        <br><br>
        <?php }

        else{
          echo "No maids found!";
        }
?>
</body>

</html>



