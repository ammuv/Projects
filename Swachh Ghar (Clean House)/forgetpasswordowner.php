<html>

<header>
	<title>Swachh Ghar</title>
	<link rel="stylesheet" href="CSS\style.css"/>
	<link href='https://fonts.googleapis.com/css?family=Ubuntu:500' rel='stylesheet' type='text/css'>
	<img src="CSS/SwachhGharLogo.jpg" style="height: 90px; float: left; margin-left: 150px;"><br><br><br>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</header>


<body>
	<br><br>
	<div class="background">
		<div class="login" style="background:none;">
  			<div class="login-form">
  				<form action="mailtoowner.php" method="post">
				<h1><font color="white" size="10" face="Garamond">Please enter your username to reset your password:</font></h1><br>
				<input name="username" type="text" placeholder="Username" required /><br>
				<br>
		    	<input type="submit" value="Reset" class="login-button" />
		    	<input type="button" onClick="parent.location='index.html'" value="Back" class="login-button" />
			</div>
		</div>

	</div>


</body>


