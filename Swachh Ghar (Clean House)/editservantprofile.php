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
	<title>Edit Profile</title>
	<link rel="stylesheet" href="CSS\style.css"/>	

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <img src="CSS/SwachhGharLogo.jpg" style="height: 90px; float: left; margin-left: 150px;"><br>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</header>


<body>
  
<br><br><br><br>


<div class="topnav" id="myTopnav">
  <a href="servantpage.php" class="active">Home</a>
  <a href="viewservantprofile.php">View Profile</a>
  <a href="viewowners.php">View Owners</a>
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
						<div class="login">
						  <div class="login-form">
						  	<form action = "updateservantdetails.php" method="post">
				  				<h3><center><font size="13" color="white" face="Garamond">Your Information </font></center></h3><br>
				  				<input type="button" onClick="parent.location='changeservantpassword.php'" value="Change Password" class="signup-button" style="width: 200px;" />
								<h3>Name:</h3>
								<input name="name" type="text" value="<?php echo $row['Name']; ?>" /><br>
								<h3><br>Age:</h3>
							    <input name="age" type="number" value="<?php echo $row['Age'] ?>" /><br>
							    <h3>Email ID:</h3>
							    <input name="emailid" type="email" value="<?php echo $row['Email'] ?>" /><br>
							    <h3>Phone Number:</h3>
							    <input name="phonenumber" type="number" value="<?php echo $row['Phone'] ?>" /><br>
							    <h3>Address:</h3>
							    <input name="address" type="text" value="<?php echo $row['Address'] ?>" /><br>
							    <h3>City:</h3>
							    <input name="city" type="text" value="<?php echo $row['City'] ?>" /><br>
							    <h3>Aadhar Number:</h3>
							    <input name="aadhar" type="number" value="<?php echo $row['Aadhar'] ?>" /><br>
							    <h3>Your Expectations towards Workers:</h3>
							    <input name="expectations" type="text" value="<?php echo $row['Expectations'] ?>" /><br>
							    <h3>Username:</h3>
							    <input name="username" type="text" value="<?php echo $row['Username'] ?>" /><br><br>
							    <input type="submit" value="Update" class="signup-button" />
							</form>
							</div>
						</div>


					<?php } ?>

</body>
