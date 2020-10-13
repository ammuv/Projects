<html>

<header>
    <title>Sign Up!</title>
	<link rel="stylesheet" href="CSS\style.css"/>
	<link href='https://fonts.googleapis.com/css?family=Ubuntu:500' rel='stylesheet' type='text/css'>
	<img src="CSS/SwachhGharLogo.jpg" style="height: 90px; float: left; margin-left: 150px;"><br>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 

  <script>
    $(document).ready(function(){
            $("#servant").show();
            $("#owner").hide();
        $("#1").click(function(){
            $("#1").css("border-color","black");
            $("#2").css("border-color","white");
            $("#1").css("border","3px solid black");
            
            $("#servant").hide();
            $("#owner").show();
        });
    $("#2").click(function(){
        $("#1").css("border-color","white");
        $("#2").css("border-color","black");
        $("#2").css("border","3px solid black");    
      $("#servant").show();
        $("#owner").hide();
    });
});

</script>

</header>


<body>



<div class="signup">
  <div class="signup-form">
      <div class="signup-header">
        <h1>SignUp</h1>
      </div><br><br>
        <input id ="2" type="button" value="House Maid" class="signup-button" style="border-color:black; border: 3px solid black;" />
        <input id="1" type="button" value="House Owner" class="signup-button" style="width: 110px;"  />
  </div>


    <div id="servant">
      <div class="signup-form">
          <form name="servantinput" id="s" method="post" action="storeservantdetails.php">
            <h3>Name:</h3>
            <input name="name" type="text" pattern="([A-Za-z]*|[' '])*" placeholder="Name" required/><br>
            <h3>Gender:</h3>
            <input type="radio" name="gender" value="male" checked><font color="white"> Male</font>
            <input type="radio" name="gender"  value="female"> <font color="white">Female</font> <br>
            <h3><br>Age:</h3>
            <input name="age" type="number"  placeholder="Age" min="18" max="99" required/><br>
            <h3>Email ID:</h3>
            <input name="emailid" type="email"  placeholder="Email ID" pattern="[A-Za-z0-9!#$%&'*+/=?^_`{|}~.-]+@[a-z0-9-]+(\.com)*"  required/><br>
            <h3>Phone Number:</h3>
            <input name="phonenumber" type="text" pattern="[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]" placeholder="Phone Number" required /><br>
            <h3>Address:</h3>
            <input name="address" type="text" placeholder="Address"  required/><br>
            <h3>City:</h3>
            <input name="city" type="text" placeholder="City" pattern="([A-Za-z]*|[' '])*" required/><br>
            <h3>Aadhar Number:</h3>
            <input name="aadhar" type="text" placeholder="Aadhar Number" pattern="[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]"  required/><br>
            <h3>Number of houses working at present:</h3>
            <input name="noofhouse" type="text" placeholder="Number of houses working at present" pattern="[0-9]"  required/><br>
            <h3>Work willing to do:</h3><br>
            <input type="checkbox" name="work_list[]" value="Sweeping"><label><font color="white">Sweeping</label></font>
            <input type="checkbox" name="work_list[]" value="Cooking"><label><font color="white">Cooking</label><br/></font>
            <input type="checkbox" name="work_list[]" value="Cleaning"><label><font color="white">Cleaning</label></font>
            <h3>Your Expectations towards Owner:</h3>
            <input name="expectations" type="text" placeholder="Your Expectations towards Owner"/><br>
            <h3>Your past experiences:</h3>
            <input name="experiences" type="text" placeholder="Your past experiences"  required/><br>
            <h3>Username:</h3>
            <input name="username" type="text" placeholder="Username"  required/><br>
            <h3>Password:</h3>
            <input name="pass" type="password" placeholder="Password"  required/>
            <h3>Confirm Password:</h3>
            <input name="cpass" type="password" placeholder="Confirm Password"  required/> 
            <br>
            <input type="submit" value="signup" class="signup-button" />
            <br><br>
           <a href="index.html" class="sign-up"><font style="padding-left: 310px;"> Already having an account? Login Here!</font></a>
          </form>
      </div>
    </div>

    <div id="owner">
      <div class="signup-form">
          <form name="ownerinput" id="o" method="post" action="storeownerdetails.php">
            <h3>Name:</h3>
            <input name="name" type="text" placeholder="Name" pattern="([A-Za-z]*|[' '])*" required/><br>
            <h3>Gender:</h3>
            <input type="radio" name="gender" value="male" checked><font color="white"> Male</font>
            <input type="radio" name="gender" value="female"> <font color="white">Female</font> <br>
            <h3><br>Age:</h3>
            <input name="age" type="number" placeholder="Age" min="18" max="99" required /><br>
            <h3>Email ID:</h3>
            <input name="emailid" type="email" placeholder="Email ID" pattern="[A-Za-z0-9!#$%&'*+/=?^_`{|}~.-]+@[a-z0-9-]+(\.com)*" required /><br>
            <h3>Phone Number:</h3>
            <input name="phonenumber" type="text" placeholder="Phone Number" pattern="[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]" required /><br>
            <h3>Address:</h3>
            <input name="address" type="text" placeholder="Address" required required /><br>
            <h3>City:</h3>
            <input name="city" type="text" placeholder="City" pattern="([A-Za-z]*|[' '])*" required/><br>
            <h3>Aadhar Number:</h3>
            <input name="aadhar" type="text" placeholder="Aadhar Number" pattern="[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]" required /><br>
            <h3>Your Expectations towards Workers:</h3>
            <input name="expectations" type="text" placeholder="Your Expectations towards Workers"  /><br>
            <h3>Username:</h3>
            <input name="username" type="text" placeholder="Username"  required/><br>
            <h3>Password:</h3>
            <input name="pass" type="password" placeholder="Password"  required/>
            <h3>Confirm Password:</h3>
            <input name="cpass" type="password" placeholder="Confirm Password" required/>
            <br>
            <input type="submit" value="signup" class="signup-button" />
            <br><br>
           <a href="index.html" class="sign-up"><font style="padding-left: 310px;"> Already having an account? Login Here!</font></a>
          </form>
        </div>
    </div>
</div>
</body>

</html> 
