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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  
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
  margin-left: 430px;
}



</style>
<body>
  
<br><br><br><br>

<div class="topnav" id="myTopnav">
  <a href="servantpage.php" >Home</a>
  <a href="viewservantprofile.php" class="active">View Profile</a>
  <a href="viewowners.php">View Owners</a>
  <a href="checkrequirementsmaid.php">Check Requirements</a>
  <a href="maidrequirements.php">Post Requirements</a>
  <a href="logout.php">Logout</a>
</div>

<div class="background">
<h1><center><font color="white" face="Garamond" size="15"><b> Your Profile </b></font></center></h1><br>

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

          $tsql= "SELECT * FROM HouseMaid where MID = $id";
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
                                          <b> ID: </b> <?php echo $row['MID']; ?><br />
                                          <b> Username: </b> <?php echo $row['Username']; ?>
                                          <br/>    
                                          <i class="glyphicon glyphicon-envelope"></i><?php echo $row['Email']; ?>
                                          <br />
                                          <i class="glyphicon glyphicon-phone"></i><a><?php echo $row['Phone']; ?></a>
                                          <br />
                                          <i class="glyphicon glyphicon-gift"></i><?php echo $row['Age']; ?>
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
            

            <div class="login" style="background : none;">
              <div class="login-form">
                <button onClick="parent.location='editservantprofile.php'" type="button" class="btn btn-default">Edit Profile</button>
              </div>
            </div>
          
          <?php } 
          sqlsrv_free_stmt($getResults);
      ?>
</div>
</body>
</html>



