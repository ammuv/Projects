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
<title>Maid Information</title>
  <link rel="stylesheet" href="CSS\style.css"/>
  <link href='https://fonts.googleapis.com/css?family=Ubuntu:500' rel='stylesheet' type='text/css'>
  <img src="CSS/SwachhGharLogo.jpg" style="height: 90px; float: left; margin-left: 150px;"><br>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</header>


<style>

   body{padding-top:30px;}

.glyphicon {  margin-bottom: 10px;margin-right: 10px;}

small {
display: block;
line-height: 1.428571429;
color: #999;
}

.container{ 
  margin-left: 410px;
}

</style>


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


<h1><center><font color="white" face="Garamond" size="15"><b> Owner's Profile Details </b></font></center></h1>

<br><br>  
<?php

               $ownerid = $_POST['button'];

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

          $tsql= "SELECT * FROM HouseOwner where OID = $ownerid";
          $getResults= sqlsrv_query($conn, $tsql);

          if ($getResults == FALSE)
              echo (sqlsrv_errors());
           
          while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) { ?> 
                <div class="container">
                  <div class="row">
                      <div class="col-xs-12 col-sm-6 col-md-6">
                          <div class="well well-sm">
                              <div class="row">
                                  <div class="col-sm-6 col-md-4">
                                      <?php if($row['Gender']=="male"){ ?>
                                            <img src="CSS/male.png" style="height: 150px;" />
                                            <?php 
                                              }
                                                  else{ ?>
                                                    <img src="CSS/female.png" style="height: 150px;" />
                                                <?php } ?>
                                      
                                  </div>
                                  <div class="col-sm-6 col-md-8">
                                      <h4>
                                          <?php echo $row['Name']; ?></h4>
                                      <small><cite title="city"><?php echo $row['City']; ?> <i class="glyphicon glyphicon-map-marker">
                                      </i></cite></small>
                                      <p>
                                          <b> Username: </b> <?php echo $row['Username']; ?>
                                          <br/>    
                                          <i class="glyphicon glyphicon-envelope"></i><?php echo $row['Email']; ?>
                                          <br />
                                          <i class="glyphicon glyphicon-phone"></i><a><?php echo $row['Phone']; ?></a>
                                          <br />
                                          <i class="glyphicon glyphicon-gift"></i><?php echo $row['age']; ?>
                                          <br />
                                          <i class="glyphicon glyphicon-home"></i><?php echo $row['Address']; ?>
                                          <br />
                                          <i class="glyphicon glyphicon-file"></i><b>Aadhar:</b> <?php echo $row['Aadhar']; ?>
                                          <br/>
                                          <i class="glyphicon glyphicon-star"></i><b>Expectation: </b> <?php echo $row['Expectations']; ?>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <br>


          <?php } ?>

          <div class="login" style="background : none;">
              <div class="login-form">
                <form method = "post" action="searchowners.php">
                    <input name="flag" type="hidden" value="1">
                    <button type="submit" class="btn btn-default">Back</button>
                </form>
              </div>
            </div>
        </div>

?>


