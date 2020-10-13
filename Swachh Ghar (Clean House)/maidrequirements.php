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
    <title>Post Requirements</title>
    <link rel="stylesheet" href="CSS\style.css"/>
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:500' rel='stylesheet' type='text/css'>
    <img src="CSS/SwachhGharLogo.jpg" style="height: 90px; float: left; margin-left: 150px;"><br>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</header>

<style type="text/css">
    body input[type="checkbox"]{
        height : 20px;
        width : 20px;
    }   
</style>

<body>
<br><br><br><br>

<div class="topnav" id="myTopnav">
  <a href="servantpage.php">Home</a>
  <a href="viewservantprofile.php">View Profile</a>
  <a href="viewowners.php">View Owners</a>
  <a href="checkrequirementsmaid.php">Check Requirements</a>
  <a href="maidrequirements.php"  class="active">Post Requirements</a>
  <a href="logout.php">Logout</a>
</div>

<html>


<header>
    <link rel="stylesheet" href="CSS\style.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 

  <script>

        $(document).ready(function(){
            $("#cook").hide();
            $("#sweep").hide();
            $("#clean").hide();
            $("#button").hide();
        });


function cookchange(res){

    if(res.checked){
        $("#cook").show();
        $("#button").show();
    }

    else{
        $("#cook").hide();
    }
}

function sweepchange(res){

    if(res.checked){
        $("#sweep").show();
        $("#button").show();
    }

    else{
        $("#sweep").hide();
    }
}

function cleanchange(res){

    if(res.checked){
        $("#clean").show();
        $("#button").show();    
    }

    else{
        $("#clean").hide();
    }
}     

</script>

</header>

<body>
<div class="background">
    <div class="login">
      <div class="login-form">
        <form name="servant" action="postrequirementsmaid.php" method="post">
            <h1><font color="white" size="10" face="Garamond">What are you looking for?</font></h1><br>
            <input id="s" type="checkbox" name="work_list[]" value="Sweeping" onchange="sweepchange(this);"><label><font size="5" color="white">Sweeping</font></label>
            <input id="co" type="checkbox" name="work_list[]" value="Cooking" onchange="cookchange(this);"><label><font size="5" color="white">Cooking</font></label><br/>
            <input id="cl" type="checkbox" name="work_list[]" value="Cleaning" onchange="cleanchange(this);"><label><font size="5" color="white">Cleaning</font></label> 

            <div id="sweep">
                <input name="sweep" type="number" placeholder="Expected Sweeping Salary"/><br>
            </div>
            <div id="cook">
                <input name="cook" type="number" placeholder="Expected Cooking Salary"/><br>
            </div>
            <div id="clean">
                <input name="clean" type="number" placeholder="Expected Cleaning Salary"/><br>
            </div>
            <br><br>
            <input id="button" type="submit" value="Post">

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

$sql = "select * from Request where MID=$id";
$getResults= sqlsrv_query($conn, $sql);


if(sqlsrv_has_rows($getResults)  != false){

?>

      <br><h1><center><font color="white" face="Garamond" size="12">Requirements Posted</font></center></h1>
      <br><br>
    <form method="post" action="deletemaidrequirement.php">
      <table style="width:70%", align="center", class="Maids" height="15">
            <tr>
              <th><center>Sweeping Salary</center></th> 
              <th><center>Cooking Salary</center></th>
              <th><center>Cleaning Salary</center></th>
              <th><center>Delete Requirement</center></th>
            </tr>

<?php

  while ($result = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) { ?>
      <tr>
              <td height="30"> <?php echo $result['SweepingSal']; ?> </td>
              <td height="30"> <?php echo $result['CookingSal']; ?>  </td>
              <td height="30"><?php echo $result['CleaningSal']; ?>  </td>
              <td height="30"><button type="submit" name="button" value="<?php echo $result['RID']; ?>">Delete</button></td>
             </tr>     
        <?php }
        //sqlsrv_free_stmt($getResults);
        ?>
        </table>
        </form>

<br><br>
<?php
  }
  else{?>
     <br><h1><center><font color="white" face="Garamond" size="10">No posted requirements</font></center></h1> <br><br>
  <?php
  }
?>

</div>
</body>
</html>


