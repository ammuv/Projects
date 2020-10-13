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
  <a href="home.php">Home</a>
  <a href="viewprofile.php"  class="active">View Profile</a>
  <a href="viewmaids.php">View Maids</a>
  <a href="checkrequirementsowner.php">Check Requirements</a>
  <a href="requirements.php">Post Requirements</a>
  <a href="help.php">Help</a>
  <a href="logout.php">Logout</a>
</div>


    <div class="login">
        <div class="login-form">
          <form action="updateownerpassword.php" method="post">
              <h3>Old Password:</h3>
              <input name="oldpass" type="password" placeholder="Old Password" required/><br>
              <h3>New Password:</h3>
              <input name="newpass" type="password" placeholder="New Password" required /><br>
              <h3>Re-Enter New Password:</h3>
              <input name="reenternewpass" type="password" placeholder="Re-Enter New Password" required/><br><br><br>
              <input type="submit" value="Update Password" class="signup-button" style="width: 200px" />
        </div>
    </div>    




