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
	<title>Homepage</title>
	<link rel="stylesheet" href="CSS\style.css"/>
	<link href='https://fonts.googleapis.com/css?family=Ubuntu:500' rel='stylesheet' type='text/css'>
	<img src="CSS/SwachhGharLogo.jpg" style="height: 90px; float: left; margin-left: 150px;"><br>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</header>

<body style="background-image: url('CSS/white.png');">
	
<br><br><br><br>
<div class="topnav" id="myTopnav">
  <a href="ownerpage.php" class="active">Home</a>
  <a href="viewprofile.php">View Profile</a>
  <a href="viewmaids.php">View Maids</a>
  <a href="checkrequirementsowner.php">Check Requirements</a>
  <a href="requirements.php">Post Requirements</a>
  <a href="logout.php">Logout</a>
</div>


<div class="w3-display-container w3-animate-opacity">
  <img src="CSS/clean1.jpg" alt="boat" style="width:100%;min-height:350px;max-height:600px;">
</div>

<!-- Team Container -->
<div class="w3-container w3-padding-64 w3-center" id="team">
<h2>OUR TEAM</h2>
<p>Meet the team - Tremendous Three:</p>

<div class="w3-row"><br>

<div class="w3-third">
  <img src="CSS/arun.jpg" alt="Boss" style="width:45%" class="w3-circle w3-hover-opacity">
  <h3>Arunvishal Saminathan</h3>
  <p>Front End</p>
  </div>

<div class="w3-third">
  <img src="CSS/vaish.jpg" alt="Boss" style="width:47%" class="w3-circle w3-hover-opacity">
  <h3>S Vaishali</h3>
  <p>Back End</p>
  </div>

<div class="w3-third">
  <img src="CSS/yash.jpg" alt="Boss" style="width:50%" class="w3-circle w3-hover-opacity">
  <h3>Yashwanth Ramamurthi</h3>
  <p>Support</p>
  </div>

</div>
</div>

<!-- Work Row -->
<div class="w3-row-padding w3-padding-64 w3-theme-l1" id="work">

<div class="w3-third">
<h2>Description</h2>
<p>Swachh Ghar is a multi purpose web application to connect house owners and house helps. It serves as a search portal for house owners who need house helps and vice versa. Swachh Ghar also help manage the transactions between a house owner and a house help, thus making life simpler for everyone!
</p>
</div>

<div class="w3-third w3-center">
<div class="w3-card w3-white" style="width: 300px">
  <img src="CSS/owner.jpg"  style="height: 300px; width: 300px">
  <div class="w3-container" align="w3-center">
  <h3>House Owner</h3>
  <h4><b>Difficulties</b></h4>
  <p>Finding genuine maids directly</p>
  <p>Attendance tracking</p>
  <p>Debt tracking</p>
  <p>Account maintenance</p>
  </div>
  </div>
</div>

<div class="w3-third w3-center">
<div class="w3-card w3-white" style="width: 300px">
  <img src="CSS/maid2.jpg"  style="height: 300px; width: 300px">
  <div class="w3-container" align="w3-center">
  <h3>House Maid </h3>
  <h4><b>Difficulties </b></h4>
  <p>Finding suitable jobs</p>
  <p>Attendance tracking</p>
  <p>Debt tracking</p>
  <p>Financial discipline</p>
  </div>
  </div>
</div>
</div>


<!-- Pricing Row -->
<div class="w3-row-padding w3-center w3-padding-64" id="pricing">
    <h2>User Advantages</h2>
    <p>House owner and maid take aways!</p><br>

    <div class="w3-half w3-margin-bottom">
      <ul class="w3-ul w3-border w3-hover-shadow">
        <li class="w3-theme">
          <p class="w3-xlarge">House Owner </p>
        </li>
        <li class="w3-padding-16"> Get to know your maids</li>
        <li class="w3-padding-16"> Direct maid search</li>
        <li class="w3-padding-16"> Track attendance and debts</li>
        <li class="w3-padding-16"> Manage your finance</li>
        <li class="w3-padding-16">
          Less work more help
        </li>
        <li class="w3-theme-l5 w3-padding-24">

        </li>
      </ul>
    </div>

    <div class="w3-half w3-margin-bottom">
      <ul class="w3-ul w3-border w3-hover-shadow">
        <li class="w3-theme">
          <p class="w3-xlarge">House Maid</p>
        </li>
        <li class="w3-padding-16"> Get to know your bosses</li>
        <li class="w3-padding-16"> Direct job search</li>
        <li class="w3-padding-16"> Keep track of attendance and debts</li>
        <li class="w3-padding-16"> Manage your finance</li>
        <li class="w3-padding-16">
          More work less worry
        </li>
        <li class="w3-theme-l5 w3-padding-24">
         
        </li>
      </ul>
    </div>
</div>

<!-- Contact Container -->
<div class="w3-container w3-padding-64 w3-theme-l5" id="contact">
  <div class="w3-row">
    <div class="w3-col m5">
    <div class="w3-padding-16"><span class="w3-xlarge w3-border-teal w3-bottombar">Contact Us</span></div>
      <h3>Tremendous Three (MSc 2k14)</h3>
      <p>For any queries on Swachh Ghar, P.S Do give your valuable feedback!</p>
      <p><i class="fa fa-map-marker w3-text-teal w3-xlarge"></i>PSG College of Technology, Coimbatore</p>
      <p><i class="fa fa-phone w3-text-teal w3-xlarge"></i>+91 8015433927</p>
      <p><i class="fa fa-envelope-o w3-text-teal w3-xlarge"></i>swachhgharr@gmail.com</p>
    </div>
    <div class="w3-col m7">
      <form class="w3-container w3-card-4 w3-padding-16 w3-white" method="post" action="ownerqueries.php">
      <div class="w3-section">      
        <label>Name</label>
        <input class="w3-input" type="text" name="Name" required>
      </div>
      <div class="w3-section">      
        <label>Email</label>
        <input class="w3-input" type="text" name="Email" required>
      </div>
      <div class="w3-section">      
        <label>Message</label>
        <input class="w3-input" type="text" name="Message" required>
      </div>  
      <button type="submit" class="w3-button w3-right w3-theme">Send</button>
      </form>
    </div>
  </div>
</div>




</body>


